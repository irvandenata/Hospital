<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kolaborasi extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public function intervensi()
    {
        return $this->belongsTo(Intervensi::class);
    }
}
