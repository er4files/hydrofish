<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    protected $fillable = [
        'tds', 'turbidity', 'ph_air', 'suhu_air', 'tinggi_air', 'status_pakan'
    ];
}
