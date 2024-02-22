<?php

namespace App\Models;

use App\Mail\NewRoomBookingMail;
use App\Mail\UpdateRoomBookingMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Mail;

class MaterialBooking extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::created(function ($record) {
            Mail::to('sebastien.farese@isbw.be')->send(new \App\Mail\NewMaterialBookingMail($record));
        });

        static::updated(function ($booking) {

            Mail::to($booking->user->email)->send(new \App\Mail\UpdateMaterialBookingMail($booking));
        });
    }

    protected $fillable = [
        'date_depart',
        'date_retour',
        'rollup1',
        'rollup2',
        'rollup3',
        'beach1',
        'beach2',
        'beach3',
        'projecteur',
        'hp',
        'piedhp',
        'multiprise',
        'portable',
        'motif_refus',
        'user_id',
        'statut_id',
        'heure_depart',
        'installation',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function statut() : BelongsTo
    {
        return $this->belongsTo(Statut::class);
    }


}
