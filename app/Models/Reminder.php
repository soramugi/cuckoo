<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'time',
        'day',
        'week',
        'title',
        'once',
        'description',
        'to',
        'compleded_at',
    ];
}
