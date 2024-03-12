<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeNf extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'codecompta',
    ];

    public function notedefrais(): hasMany
    {
        return $this->hasMany(NoteDeFrais::class);
    }
}
