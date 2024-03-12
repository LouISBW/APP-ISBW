<?php

namespace App\Models;

use App\Mail\UpdateRoomBookingMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class RoomBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'heure_debut',
        'heure_fin',
        'Nbre_participant',
        'salle1',
        'salle2',
        'salle3',
        'salle4',
        'salle5',
        'drink1',
        'drink2',
        'drink3',
        'autre',
        'remarques',
        'motif_refus',
        'user_id',
        'statut_id',
        'projecteur',
        'flip',
        'eat1',
        'eat2',
    ];

    protected static function booted()
    {
        static::created(function ($record) {
            Mail::to('info@isbw.be')->send(new \App\Mail\NewRoomBookingMail($record));
        });

        static::updated(function ($booking) {

            Mail::to($booking->user->email)->send(new UpdateRoomBookingMail($booking));
        });
    }

    protected $casts = [
        'salle1' => 'boolean',
        'salle2' => 'boolean',
        'salle3' => 'boolean',
        'salle4' => 'boolean',
        'drink1' => 'boolean',
        'drink2' => 'boolean',
        'drink3' => 'boolean',
        'projecteur' => 'boolean',
        'flip' => 'boolean',
        'eat1' => 'boolean',
        'eat2' => 'boolean',
        'date' => 'datetime',
        'heure_debut' => 'datetime',
        'heure_fin' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\user');
    }

    public function statut()
    {
        return $this->belongsTo('App\Models\Statut');

    }
}
