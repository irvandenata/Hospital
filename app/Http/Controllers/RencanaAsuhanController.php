<?php

namespace App\Http\Controllers;

use App\Http\Resources\RencanaAsuhanResource;
use App\Models\DataObjektif;
use App\Models\DataSubjektif;
use App\Models\Diagnosa;
use App\Models\Intervensi;
use App\Models\Luaran;
use App\Models\Penyebab;
use App\Models\RencanaAsuhan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RencanaAsuhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $assets = RencanaAsuhan::latest()->get();
            return DataTables::of($assets)
                ->addColumn('action', function ($asset) {
                    return '
                    <div class="row justify-content-center">

                    <a id="detail" class="btn btn-info text-white  mx-1 mb-1" onclick="detailItem(' . $asset->id . ')" >Detail</span></a>
                    <a class="btn btn-success text-white  mx-1 mb-1" onclick="editItem(' . $asset->id . ')">Edit</span></a>

                                <a id="delete" class="btn btn-danger text-white  mx-1 mb-1" onclick="deleteItem(' . $asset->id . ')" >Delete</span></a>

                                </div>';
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        $data['diagnosa'] = Diagnosa::get();
        $data['luaran'] = Luaran::get();
        $data['intervensi'] = Intervensi::get();
        return view('admin.asuh.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = RencanaAsuhan::where('id',$id)->first();

        return response()->json(new RencanaAsuhanResource($data));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
