<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentVendor extends Model
{
    use HasFactory, Sluggable;
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
            $model->id = 'PV' . sprintf('%04d', (int) (self::count() > 0 ? substr(self::latest()->first()->id, -4) : 0) + 1);
        });
    }

    protected function imagePath(): Attribute
    {
        return new Attribute(
            get: fn () => filter_var($this->main_image, FILTER_VALIDATE_URL) ? $this->image : asset($this->image)
        );
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
