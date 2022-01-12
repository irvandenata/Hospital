<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public function rencanaAsuhs()
    {
        return $this->hasMany(RencanaAsuhan::class);
    }

    public function objektifs()
    {
        return $this->hasMany(DataObjektif::class);
    }
    public function subjektifs()
    {
        return $this->hasMany(DataSubjektif::class);
    }
    public function penyebabs()
    {
        return $this->hasMany(Penyebab::class);
    }
}
