<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervensi extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public function RencanaAsuh()
    {
        return $this->belongsToMany(RencanaAsuhan::class);
    }

    public function observasis()
    {
        return $this->hasMany(Observasi::class);
    }
    public function kolaborasis()
    {
        return $this->hasMany(Kolaborasi::class);
    }
    public function terapeutiks()
    {
        return $this->hasMany(Terapeutik::class);
    }
    public function edukasis()
    {
        return $this->hasMany(Edukasi::class);
    }
}
