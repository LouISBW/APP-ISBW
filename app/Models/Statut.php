<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Statut extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function materials() : hasMany
    {
        return $this->hasMany(MaterialBooking::class, 'statut_id');
    }


    public function ticketings(): hasMany
    {
        return $this->hasMany(Ticketing::class, 'statut_id');

    }

    public function dlt(): hasMany
    {
        return  $this->hasMany(Dlt::class);
    }

    public function roombooking() : HasMany
    {
        return $this->hasMany(RoomBooking::class, 'statut_id');
    }
}
