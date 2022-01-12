<?php

namespace App\Http\Controllers;

use App\Models\DataObjektif;
use App\Models\DataSubjektif;
use App\Models\Intervensi;
use App\Models\KriteriaHasil;
use App\Models\Penyebab;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getPenyebab ($id){

    $item= Penyebab::where('diagnosa_id',$id)->get();
    return response()->json($item);
    }
     public function getObj ($id){

    $item= DataObjektif::where('diagnosa_id',$id)->get();
    return response()->json($item);
    }
      public function getSbj($id){

    $item= DataSubjektif::where('diagnosa_id',$id)->get();
    return response()->json($item);
    }


     public function getKriteria($id){

    $item= KriteriaHasil::where('luaran_id',$id)->get();
    return response()->json($item);
    }
    public function getIntervensi($id){
        $item = Intervensi::where('id',$id)->first();
    $kolaborasi= $item->kolaborasis;
    $terapeutik= $item->terapeutiks;
    $edukasi= $item->edukasis;
    $observasi= $item->observasis;
    return response()->json(['observasi'=>$observasi,'terapeutik'=>$terapeutik,'edukasi'=>$edukasi,'kolaborasi'=>$kolaborasi,'nama'=>$item->intervensi_keperawatan,"kode"=>$item->kode,"pengertian"=>$item->pengertian,"id"=>$item->id]);
    }
}
