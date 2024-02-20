<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Mail;

class NoteDeFrais extends Model
{
    use HasFactory;
    protected $fillable = [
        'month',
        'montant',
        'user_id',
        'statut_id',
        'type_nfs_id',
        'justificatif',
        'motif_refus',
    ];

    protected static function booted()
    {
        static::created(function ($record) {
            Mail::to($record->user->email)->send(new \App\Mail\NewNoteDeFraisMail($record));
            Mail::to('sebastien.farese@isbw.be')->send(new \App\Mail\ApprovalNoteDeFraisMail($record));
            Mail::to('infocom@isbw.be')->send(new \App\Mail\SecondApprovalNoteDeFraisMail($record));
        });

    }

    public function statut() : BelongsTo
    {
        return $this->belongsTo(Statut::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function type_nfs() : BelongsTo
    {
        return $this->belongsTo(TypeNf::class);
    }

}
