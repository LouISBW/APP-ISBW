<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasAvatar
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

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
        'password' => 'hashed',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function department()
    {
        return $this->belongsToMany(Department::class);
    }

    public function materials(): HasMany
    {
        return $this->hasMany(MaterialBooking::class);
    }

    public function dlt(): hasMany
    {
        return $this->hasMany(Dlt::class);
    }

    public function derogations(): hasMany
    {
        return $this->hasMany(DerogationHoraire::class);
    }

    public function notedefrais(): hasMany
    {
        return $this->hasMany(NoteDeFrais::class);
    }

    public function ticketings(): HasMany
    {
        return $this->hasMany(Ticketing::class);
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }
}
