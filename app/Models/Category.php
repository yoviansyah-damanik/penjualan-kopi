<?php

namespace App\Models;

use App\Helpers\StringHelper;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
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
            $model->id = 'CA' . sprintf('%04d', (int) (self::count() > 0 ? substr(self::latest()->first()->id, -4) : 0) + 1);
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
