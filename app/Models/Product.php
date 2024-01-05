<?php

namespace App\Models;

use App\Enums\TransactionStatusType;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $guarded = ['id'];
    public $incrementing = false;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $date_now = Carbon::now()->format('mY');

            $last_id = (int)substr(self::where('id', 'like', "PRO" . $date_now . "%")
                ->orderBy('id', 'desc')->first()?->id ?? 0, -4);

            $model->id = "PRO" . $date_now . sprintf('%04d', ($last_id + 1));
        });
    }

    protected function successfulTransactionCount(): Attribute
    {
        return new Attribute(
            get: fn () => $this->transactions()->status(TransactionStatusType::Completed)->count()
        );
    }

    protected function excerpt(): Attribute
    {
        return new Attribute(
            get: fn () => Str::limit(strip_tags($this->description), 100)
        );
    }

    protected function mainImagePath(): Attribute
    {
        return new Attribute(
            get: fn () => filter_var($this->main_image, FILTER_VALIDATE_URL) ? $this->main_image : asset($this->main_image)
        );
    }

    protected function additionalImagePaths(): Attribute
    {
        return new Attribute(
            get: fn () => collect(explode(';', $this->additional_images))
                ->map(fn ($q) => filter_var($q, FILTER_VALIDATE_URL) ? $q : asset($q))
        );
    }

    protected function categoryName(): Attribute
    {
        return new Attribute(
            get: fn () => $this->category ? $this->category->name : __('Uncategorized')
        );
    }

    public function scopeReady($query): void
    {
        $query->where('is_ready', true);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(DetailTransaction::class);
    }

    public function transactions(): HasManyThrough
    {
        return $this->hasManyThrough(Transaction::class, DetailTransaction::class, 'product_id', 'id', 'id', 'transaction_id');
    }
}
