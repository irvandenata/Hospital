<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Luaran extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public function kriterias()
    {
        return $this->hasMany(KriteriaHasil::class);
    }
    public function rencanaAsuhs()
    {
        return $this->hasMany(RencanaAsuhan::class);
    }
}
