<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonnelsEncadrement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nbKm1sem',
        'nbKm2sem',
        'nbKm1trim',
        'nbKm2trim',
        'nbKm3trim',
        'nbKm4trim',
        'modeFincancement',
        'regimeHoraireTp',
        'regimeHebdo',
        'fonction',
        'dateSortie',
        'dateEntree',
        'prenom',
        'nom',
        'civilite',
        'dateNaissance',
    ];
}
