<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected function totalPrice(): Attribute
    {
        return new Attribute(
            get: fn () => $this->amount * $this->product->price
        );
    }

    protected function isProductReady(): Attribute
    {
        return new Attribute(
            get: fn () => $this->product->is_ready ? true : false
        );
    }

    public function scopeProductReady($query): void
    {
        $query->whereHas('product', fn ($q) => $q->ready());
    }


    public function scopeLogged($query): void
    {
        $query->where('user_id', Auth::id());
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
