<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dlt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'month',
        'nbr_dlt',
        'statut_id',
        'verifkey',
    ];

    public function statut() : BelongsTo
    {
        return $this->belongsTo(Statut::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
