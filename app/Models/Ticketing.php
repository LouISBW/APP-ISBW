<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticketing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_creation',
        'subject',
        'description',
        'statut_id',
        'attachment',
        'date_cloture',
        
    ];

    public function statut() : BelongsTo
    {
        return $this->belongsTo(Statut::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function typeticket() : BelongsTo
    {
        return $this->belongsTo(TypeTicketing::class);
    }
}
