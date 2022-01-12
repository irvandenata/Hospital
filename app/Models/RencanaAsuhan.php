<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaAsuhan extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public function intervensis()
    {
        return $this->belongsToMany(Intervensi::class);
    }

    public function diagnosa()
    {
        return $this->belongsTo(Diagnosa::class);
    }
    public function luaran()
    {
        return $this->belongsTo(Luaran::class);
    }
}
