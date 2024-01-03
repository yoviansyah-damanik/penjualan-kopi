<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Http;
use Throwable;

class OngkirHelper
{
    const BASEURL = 'https://api.rajaongkir.com';
    const TYPE = 'starter';
    const COURIER = 'tiki';
    const ORIGIN = 463;
    const DEFAULT_WEIGHT = 1;

    public static function provinces()
    {
        try {
            $response = Http::withoutVerifying()
                ->withHeader('key', env('RAJAONGKIR_KEY'))
                ->acceptJson()
                ->get(self::BASEURL . '/' . self::TYPE . '/province');

            return collect($response->json()['rajaongkir']);
        } catch (Exception $e) {
            return [
                'status' => [
                    'code' => 400,
                    'message' => $e->getMessage()
                ],
                'description' => __('Something went wrong!')
            ];
        } catch (Throwable $e) {
            return [
                'status' => [
                    'code' => 400,
                    'message' => $e->getMessage()
                ],
                'description' => __('Something went wrong!')
            ];
        }
    }

    public static function cities($province_id)
    {
        try {
            $response = Http::withoutVerifying()
                ->withHeader('key', env('RAJAONGKIR_KEY'))
                ->acceptJson()
                ->get(self::BASEURL . '/' . self::TYPE . '/city', ['province' => $province_id]);

            return collect($response->json()['rajaongkir']);
        } catch (Exception $e) {
            return [
                'status' => [
                    'code' => 400,
                    'message' => $e->getMessage()
                ],
                'description' => __('Something went wrong!')
            ];
        } catch (Throwable $e) {
            return [
                'status' => [
                    'code' => 400,
                    'message' => $e->getMessage()
                ],
                'description' => __('Something went wrong!')
            ];
        }
    }

    public static function cost($destination, $weight = self::DEFAULT_WEIGHT, $courier = self::COURIER, $origin = self::ORIGIN)
    {
        try {
            $weight = $weight > 0  ? $weight : self::DEFAULT_WEIGHT;

            $response = Http::withoutVerifying()
                ->withHeader('key', env('RAJAONGKIR_KEY'))
                ->acceptJson()
                ->post(self::BASEURL . '/' . self::TYPE . '/cost', [
                    'origin' => $origin,
                    'destination' => $destination,
                    'weight' => $weight,
                    'courier' => $courier,
                ]);

            return collect($response->json()['rajaongkir']);
        } catch (Exception $e) {
            return [
                'status' => [
                    'code' => 400,
                    'message' => $e->getMessage()
                ],
                'description' => __('Something went wrong!')
            ];
        } catch (Throwable $e) {
            return [
                'status' => [
                    'code' => 400,
                    'message' => $e->getMessage()
                ],
                'description' => __('Something went wrong!')
            ];
        }
    }

    public static function shipping_cost($destination, $weight = self::DEFAULT_WEIGHT, $courier = self::COURIER, $origin = self::ORIGIN)
    {
        $value = collect(static::cost($destination, $weight ?? self::DEFAULT_WEIGHT, $courier, $origin)['results'][0]['costs'])
            ->where('service', 'REG')->collapse()['cost'][0];

        return [
            'cost' => $value['value'],
            'estimation_day' => $value['etd']
        ];
    }
}
