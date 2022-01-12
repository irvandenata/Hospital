<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaHasil extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public function luaran()
    {
        return $this->belongsTo(Luaran::class);
    }
}
