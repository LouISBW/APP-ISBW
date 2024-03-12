<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'approver_id',
        'approver_id',
        'second_approver_id',
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }

    public function second_approver()
    {
        return $this->belongsTo(User::class, 'second_approver_id');
    }
}
