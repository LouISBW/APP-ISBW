<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'approver_id',
        'approver_id',
        'second_approver_id',
    ];

    // Relation un à plusieurs (inverse) avec Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Relation plusieurs à plusieurs avec User

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
