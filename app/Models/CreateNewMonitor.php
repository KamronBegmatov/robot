<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateNewMonitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'monitor_type,
        name,
        url,
        interval'
    ];
}
