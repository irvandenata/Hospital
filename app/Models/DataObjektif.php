<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataObjektif extends Model
{
    use HasFactory;

    protected $guarded = [''];
    public function diagnosa()
    {
        return $this->belongsTo(Diagnosa::class);
    }
}
