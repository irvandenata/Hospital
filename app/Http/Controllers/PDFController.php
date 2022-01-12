<?php

namespace App\Http\Controllers;

use App\Http\Resources\RencanaAsuhanResource;
use App\Models\RencanaAsuhan;
use Illuminate\Http\Request;
use PDF;
class PDFController extends Controller
{
    public function generatePDF($id)
    {
      $item = new RencanaAsuhanResource(RencanaAsuhan::where('id',$id)->first());
        $data['item'] = response()->json($item);
        $pdf = PDF::loadView('PDF', $data)->setPaper('a4', 'potrait');;
        return $pdf->download($item->penanggung_jawab.'.pdf');
    }
     public function preview($id)
    {

      $item = new RencanaAsuhanResource(RencanaAsuhan::where('id',$id)->first());
        $data['item'] = response()->json($item);

        return view('PDF')->with('item',$data['item']);
    }
}
