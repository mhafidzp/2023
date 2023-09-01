<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreKecamatanRequest;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use Yajra\DataTables\Facades\DataTables;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kecamatan = Kecamatan::with(['kota']);

        if (request()->ajax()) {

            return Datatables::eloquent($kecamatan)
            ->addColumn('kota', function (Kecamatan $kecamatan) {
                return $kecamatan->kota->nama;
            })
            ->addColumn('provinsi', function (Kecamatan $kecamatan) {
                return $kecamatan->kota->provinsi->nama;
            })
            ->addColumn('opsi', function (Kecamatan $kecamatan) {
                return '<a href="'.route('edit.kecamatan', $kecamatan->kode).'" class="btn btn-sm btn-success mx-1">Ubah</a>
                <form id="delete-id-'.$kecamatan->kode.'" action="'.route('destroy.kecamatan', $kecamatan->kode).'" method="POST" style="display: inline-block;">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <button type="submit" class="btn btn-sm btn-danger btn_hapus" data-id="'.$kecamatan->kode.'">Hapus</button>
                </form>';
            })
            ->rawColumns(['opsi','kota','provinsi'])
            ->toJson();

        }

        return view('admin.kecamatan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinsi = Provinsi::all();

        return view('admin.kecamatan.create', compact('provinsi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKecamatanRequest $request)
    {
        Kecamatan::create($request->all());

        return redirect()->route('index.kecamatan')->with('success', 'Data sukses tersimpan.');
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
    public function edit($kode)
    {
        $kecamatan = Kecamatan::find($kode);
        $provinsi = Provinsi::all();

        return view('admin.kecamatan.edit', compact('kecamatan','provinsi'));
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
        $kecamatan = Kecamatan::find($id);

        $kecamatan->kode = $request->kode;
        $kecamatan->kota_kode = $request->kota_kode;
        $kecamatan->nama = $request->nama;
        $kecamatan->save();

        return redirect()->route('index.kecamatan')->with('success', 'Data sukses tersimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kecamatan = Kecamatan::find($id);

        $kecamatan->delete();

        return redirect()->route('index.kecamatan')->with('success', 'Data Terhapus.');
    }

    public function select(Request $request)
    {
        $kecamatan = Kecamatan::select('kode as id','nama as text')->where('kota_kode', $request->kota_kode)->get();

        return response()->json(['success' => true, 'data' => $kecamatan]);
    }
}
