<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';  // Explicitly define the table name if it's different from the model's plural form

    protected $fillable = [
        'timestamp', 'tds', 'turbidity', 'ph_air', 'suhu_air', 'tinggi_air',
    ];

    public $timestamps = false;
}
