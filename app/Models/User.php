<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider_id',
        'provider_avatar',
        'provider_name',
    ];

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

    /**
     * Returns user role.
     * @return bool
     */
    public function isAdmin() : bool
    {
        if($this->admin == null) {
            return false;
        }
        return $this->admin;
    }

    /**
     * The relation that returns the tabletops which the user owns.
     * @return HasMany
     */
    public function owns_tabletops() : HasMany
    {
        return $this->hasMany(Tabletop::class, 'owner_user_id');
    }

    /**
     * The relation that returns all the tabletops which the user belongs.
     * @return BelongsToMany
     */
    public function tabletops() : BelongsToMany
    {
        return $this->belongsToMany(related:Tabletop::class)->withTimestamps();
    }
}
