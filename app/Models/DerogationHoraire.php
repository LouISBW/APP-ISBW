<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Mail;

class DerogationHoraire extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status_id',
        'service_id',
        'date_derogation',

        'de_lundi',
        'fin_lundi',
        'de_mardi',
        'fin_mardi',
        'de_mercredi',
        'fin_mercredi',
        'de_jeudi',
        'fin_jeudi',
        'de_vendredi',
        'fin_vendredi',

        'p_de_lundi',
        'p_fin_lundi',
        'p_de_mardi',
        'p_fin_mardi',
        'p_de_mercredi',
        'p_fin_mercredi',
        'p_de_jeudi',
        'p_fin_jeudi',
        'p_de_vendredi',
        'p_fin_vendredi',

        'motif_refus',
        'motif_demande',
    ];

    protected static function booted()
    {
        static::created(function ($record) {
            $service = $record->user->services->first();
            $ApproverId = $service->approver_id;
            $SecondApproverId = $service->second_approver_id;

            $ApproverMail = User::where('id', $ApproverId)->value('email');
            $SecondApproverEmail = User::where('id', $SecondApproverId)->value('email');

            Mail::to($record->user->email)->send(new \App\Mail\NewDerogationMail($record));
            Mail::to($ApproverMail)->send(new \App\Mail\ApprovalDerogationMail($record));
            Mail::to($SecondApproverEmail)->send(new \App\Mail\SecondApprovalDerogationMail($record));
        });
        static::updated(function ($record) {

            Mail::to($record->user->email)->send(new \App\Mail\UpdateDerogationMail($record));
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
}
