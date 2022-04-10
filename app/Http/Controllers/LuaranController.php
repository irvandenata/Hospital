<?php

namespace App\Http\Controllers;

use App\Models\Luaran;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LuaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $assets = Luaran::latest()->get();
            return DataTables::of($assets)
                ->addColumn('action', function ($asset) {
                    return '
                    <div class="row justify-content-center">
                    <a class="btn btn-success text-white  mx-1 mb-1 btn-sm" onclick="editItem(' . $asset->id . ')">Edit</span></a>

                                <a id="delete" class="btn btn-danger btn-sm text-white  mx-1 mb-1" onclick="deleteItem(' . $asset->id . ')" >Delete</span></a>

                                </div>';
                })

                ->addColumn('detail', function ($asset) {
                    return '   <a id="detail" class="btn btn-warning btn-sm text-white  mx-1 mb-1" onclick="detailKriteria(' . $asset->id . ')" >Detail</span></a></div>';
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action', 'detail'])
                ->make(true);
        }

        $data['title'] = "Data Luaran";

        return view('admin.luaran.index', $data);
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
        $item = new Luaran();
        $item->luaran = $request->luaran;
        $item->kode = $request->kode;
        $item->kelompok = $request->kelompok;
        $item->save();
        return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Luaran $luaran)
    {
        return $luaran;
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
        // dd($request);
        $luaran = Luaran::where('id', $id)->first();
        $luaran->luaran = $request->luaran;
        $luaran->kode = $request->kode;
        $luaran->kelompok = $request->kelompok;
        $luaran->save();

        return $luaran;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Luaran $luaran)
    {
        $luaran->delete();
        return response()->json('success');
    }
}
