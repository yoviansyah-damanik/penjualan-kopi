<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = "INV/" . sprintf('%05d', (int) self::count() + 1) . "/" . Carbon::now()->format('m') . "/" . Carbon::now()->format('Y');
        });
    }

    protected function totalPaymentProductsOnly(): Attribute
    {
        return new Attribute(
            get: fn () => $this->details->sum(fn ($q) => $q->qty * ($q->price - $q->discount))
        );
    }

    protected function totalPayment(): Attribute
    {
        return new Attribute(
            get: fn () => $this->details->sum(fn ($q) => $q->qty * ($q->price - $q->discount)) + $this->shipping->cost + $this->unique_code
        );
    }

    protected function totalItem(): Attribute
    {
        return new Attribute(
            get: fn () => $this->details->sum('qty')
        );
    }

    protected function scopeStatus($query, $status): void
    {
        $query->where('status', $status);
    }

    protected function scopeLogged($query): void
    {
        $query->where('user_id', Auth::id());
    }

    public function details(): HasMany
    {
        return $this->hasMany(DetailTransaction::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function shipping(): HasOne
    {
        return $this->hasOne(Shipping::class);
    }

    public function delivery(): HasOne
    {
        return $this->hasOne(Delivery::class);
    }
}
