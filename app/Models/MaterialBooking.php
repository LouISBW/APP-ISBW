<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialBooking extends Model
{
    use HasFactory;

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
