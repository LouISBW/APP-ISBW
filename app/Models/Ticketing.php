<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Mail;

class Ticketing extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::created(function ($record) {
            Mail::to('sebastien.farese@isbw.be')->send(new \App\Mail\NewTicketMail($record));
        });

        static::updated(function ($booking) {

            Mail::to($booking->user->email)->send(new \App\Mail\UpdateTicketMail($booking));
        });
    }
    protected $fillable = [
        'user_id',
        'date_creation',
        'subject',
        'description',
        'statut_id',
        'attachment',
        'date_cloture',
        'type_demande',
        'assigned_to',
        'type_ticketing_id',
        'type_demande',

    ];

    public function statut() : BelongsTo
    {
        return $this->belongsTo(Statut::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function type_ticketing() : BelongsTo
    {
        return $this->belongsTo(TypeTicketing::class, 'type_ticketing_id');
    }
}
