<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailTransaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected function total(): Attribute
    {
        return new Attribute(
            get: fn () => $this->qty * $this->final_price
        );
    }

    protected function finalPrice(): Attribute
    {
        return new Attribute(
            get: fn () => $this->price - $this->discount
        );
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class)
            ->withTrashed();
    }
}
