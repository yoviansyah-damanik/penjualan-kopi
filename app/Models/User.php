<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Trait\UuidTrait;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, UuidTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function imagePath(): Attribute
    {
        return new Attribute(
            // get: fn () => $this->image ?? asset('branding-assets/images/avatar/avatar-' . rand(1, 5) . '.png')
            get: fn () => $this->image ? asset($this->image) : asset('branding-assets/images/avatar/avatar-1.png')
        );
    }

    protected function roleName(): Attribute
    {
        return new Attribute(
            get: fn () => $this->roles[0]->name
        );
    }

    protected function isAdministrator(): Attribute
    {
        return new Attribute(
            get: fn () => $this->role_name == 'Administrator'
        );
    }

    public function scopeReady($query): void
    {
        $query->whereHas('product', fn ($q) => $q->where('is_ready', true));
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
