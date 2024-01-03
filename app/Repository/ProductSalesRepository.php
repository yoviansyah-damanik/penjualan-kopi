<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Enums\TransactionStatusType;

interface ProductSalesInterface
{
    public static function getAllWithPopularProducts($type = 'annual', $month, $year);
    public static function getAllWithHighestIncome($type = 'annual', $month, $year);
    public static function getAll($type = 'annual', $month, $year);
}

class ProductSalesRepository implements ProductSalesInterface
{
    const POPULAR_PRODUCTS_LIMIT = 3;
    const HIGHEST_INCOME_PRODUCTS_LIMIT = 3;

    private $year;
    private $month;
    private $type = 'annual';
    private $results;

    public function __construct(...$params)
    {
        $this->type = $params[0];
        $this->month = $params[1];
        $this->year = $params[2];
        $this->getData();
    }

    protected function getData()
    {
        $type = $this->type;
        $month = $this->month;
        $year = $this->year;

        if ($type != 'annual') {
            $start_date = Carbon::createFromFormat('m-Y', $month . '-' . $year)
                ->startOfMonth();

            $end_date = Carbon::createFromFormat('m-Y', $month . '-' . $year)
                ->endOfMonth();
        } else {
            $start_date = Carbon::createFromFormat('Y', $year)
                ->startOfYear();

            $end_date = Carbon::createFromFormat('Y', $year)
                ->endOfYear();
        }

        $all_transactions = DB::table('detail_transactions')
            ->join('transactions', 'detail_transactions.transaction_id', '=', 'transactions.id')
            ->selectRaw('product_id, transactions.date, qty, qty*(price-discount) as total_sales_income, qty*cost as total_cost, transactions.status')
            ->whereBetween('transactions.date', [$start_date, $end_date])
            ->where('transactions.status', TransactionStatusType::Completed)
            ->get();

        $products = Product::select('id', 'main_image', 'name')
            ->with('category:id,name')
            ->with('details')
            ->get()
            ->map(function ($product) use ($all_transactions, $year) {
                $exist = $all_transactions
                    ->filter(fn ($q) => $q->product_id == $product->id);

                return collect([
                    'id' => $product->id,
                    'image' => $product->main_image_path,
                    'category_name' => $product->category_name,
                    'name' => $product->name,
                    'results' => collect(range(1, 12))
                        ->map(function ($_month) use ($exist, $year) {
                            $start_of_month = Carbon::createFromFormat('mY', $_month . $year)->startOfMonth();
                            $end_of_month = Carbon::createFromFormat('mY', $_month . $year)->endOfMonth();

                            return collect([
                                'month_id' => $_month,
                                'month_name' => Carbon::createFromFormat('m', $_month)->translatedFormat('F'),
                                'month_name_abb' => Carbon::createFromFormat('m', $_month)->translatedFormat('M'),
                                'start_of_month' => $start_of_month,
                                'end_of_month' => $end_of_month,
                                'results' => collect(range(Carbon::createFromFormat('mY', $_month . $year)->startOfMonth()->day, Carbon::createFromFormat('mY', $_month . $year)->endOfMonth()->day))
                                    ->map(function ($day) use ($_month, $year, $exist,) {
                                        $now = Carbon::createFromFormat('d-m-Y',  $day . '-' . $_month . '-' . $year)
                                            ->format('Y-m-d');

                                        $exist_ = $exist->where('date', $now);

                                        return [
                                            'day_id' => $day,
                                            'day_name' => Carbon::createFromFormat('d-m-Y', $day . '-' . $_month . '-' . $year)->translatedFormat('l'),
                                            'sold' => $exist_->sum('qty'),
                                            'sales_income' =>  $exist_->sum('total_sales_income'),
                                            'cost' =>  $exist_->sum('total_cost'),
                                        ];
                                    }),
                            ]);
                        })
                ]);
            });

        if ($type != 'annual')
            $products = $products->map(function ($q) use ($month) {
                return [
                    ...$q->except('results'),
                    'results' => $q['results']
                        ->filter(fn ($r) => $r['month_id'] == $month)
                        ->values()
                ];
            });

        $products = $products->map(function ($q) {
            return [
                ...collect($q)->except('results'),
                'results' => collect($q['results'])
                    ->map(function ($r) {
                        return [
                            ...$r,
                            'total' => [
                                'sold' => collect($r['results'])
                                    ->sum('sold'),
                                'sales_income' => collect($r['results'])
                                    ->sum('sales_income'),
                                'cost' => collect($r['results'])
                                    ->sum('cost'),
                                'net' => collect($r['results'])
                                    ->sum(fn ($s) => $s['sales_income'] - $s['cost'])
                            ]
                        ];
                    }),
                'total' => [
                    'sold' => collect($q['results'])
                        ->sum(function ($r) {
                            return collect($r['results'])->sum('sold');
                        }),
                    'sales_income' => collect($q['results'])
                        ->sum(function ($r) {
                            return collect($r['results'])->sum('sales_income');
                        }),
                    'cost' => collect($q['results'])
                        ->sum(function ($r) {
                            return collect($r['results'])->sum('cost');
                        }),
                    'net' => collect($q['results'])
                        ->sum(function ($r) {
                            return collect($r['results'])
                                ->sum(fn ($s) => $s['sales_income'] - $s['cost']);
                        })
                ]
            ];
        });

        $total_sales = [
            'sold' => $products->sum('total.sold'),
            'sales_income' => $products->sum('total.sales_income'),
            'cost' => $products->sum('total.cost'),
            'net' => $products->sum('total.net')
        ];

        $this->results = collect([
            'results' => $products,
            'total_sales' => $total_sales,
        ]);
    }

    protected function getPopularProducts()
    {
        $products = $this->results;

        $max_sold = $products['results']->sortByDesc('total.sold')
            ->first()['total']['sold'];

        $popular_products = $products['results']
            ->where('total.sold', '!=', 0)
            ->where('total.sold', $max_sold)
            ->take(self::POPULAR_PRODUCTS_LIMIT)
            ->values();

        return
            collect([
                ...$products,
                'popular_products' => $popular_products
            ]);
    }

    protected function getHighestIncomeProducts()
    {
        $products = $this->results;

        $highest_income_products = $products['results']
            ->where('total.net', '!=', 0)
            ->take(self::HIGHEST_INCOME_PRODUCTS_LIMIT)
            ->sortByDesc('total.net')
            ->values();

        $results = collect(range(1, 12))
            ->map(function ($month) use ($products) {
                return [
                    'month_id' => $month,
                    'month_name' => Carbon::createFromFormat('m', $month)->translatedFormat('F'),
                    // 'results' => collect(range(Carbon::createFromFormat('m-Y', $month . '-' . $year)->startOfMonth()->day, Carbon::createFromFormat('mY', $month . $year)->endOfMonth()->day))
                    //     ->map(),
                    'total' => [
                        'sold' => $products['results']->sum(fn ($q) => $q['results']->where('month_id', $month)->sum('total.sold')),
                        'sales_income' => $products['results']->sum(fn ($q) => $q['results']->where('month_id', $month)->sum('total.sales_income')),
                        'cost' => $products['results']->sum(fn ($q) => $q['results']->where('month_id', $month)->sum('total.cost')),
                        'net' => $products['results']->sum(fn ($q) => $q['results']->where('month_id', $month)->sum('total.net'))
                    ]
                ];
            });

        $sorted_by_net = $results
            ->sortByDesc('total.net')
            ->where('total.net', '!=', 0)
            ->take(self::HIGHEST_INCOME_PRODUCTS_LIMIT)
            ->values();

        $month_of_the_year = $sorted_by_net
            ->first();

        return collect([
            ...$products,
            'highest_income_products' => [
                'products' => $highest_income_products,
                'recap' => [
                    'results' => $results,
                    'sorted_by_net' => $sorted_by_net,
                    'month_of_the_year' => $month_of_the_year
                ]
            ]
        ]);
    }

    public static function getAllWithPopularProducts($type = 'annual', $month, $year)
    {
        $popular_products = (new self($type, $month, $year))->getPopularProducts();

        return $popular_products;
    }

    public static function getAllWithHighestIncome($type = 'annual', $month, $year)
    {
        $highest_income_products = (new self($type, $month, $year))->getHighestIncomeProducts();

        return $highest_income_products;
    }

    public static function getAll($type = 'annual', $month, $year)
    {
        $instance = new static();
        $products = $instance->getData($type, $month, $year);
        $popular_products = $instance->getPopularProducts(collect($products));
        $highest_income_products = $instance->getHighestIncomeProducts(collect($products));

        return [
            $popular_products,
            $highest_income_products
        ];
    }
}
