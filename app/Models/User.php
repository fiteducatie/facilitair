<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Filament\Models\Contracts\FilamentUser;

class User extends Authenticatable implements HasMedia, FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, InteractsWithMedia;

    public function canAccessPanel(Panel $panel): bool
    {

        if ($panel->getId() === 'admin') {
            return $this->hasRole('admin');
        }

        return true;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    public function likes() {
        return $this->belongsToMany('App\Models\Pin', 'like_pin');
    }

    public function boards() {
        return $this->hasMany(Board::class);
    }

    public function favorites() {
        return $this->belongsToMany('App\Models\Pin', 'save_pin', 'user_id', 'pin_id');
    }

    public function pins() {
        return $this->hasMany('App\Models\Pin');
    }
}
