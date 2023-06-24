<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use App\Http\Requests\StoreKelurahanRequest;
use Yajra\DataTables\Facades\DataTables;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelurahan = Kelurahan::with(['kecamatan']);
        if (request()->ajax()) {

            return Datatables::eloquent($kelurahan)
            ->addColumn('kecamatan', function (Kelurahan $kelurahan) {
                return $kelurahan->kecamatan->nama;
            })
            ->addColumn('kota', function (Kelurahan $kelurahan) {
                return $kelurahan->kecamatan->kota->nama;
            })
            ->addColumn('provinsi', function (Kelurahan $kelurahan) {
                return $kelurahan->kecamatan->kota->provinsi->nama;
            })
            ->addColumn('opsi', function (Kelurahan $kelurahan) {
                return '<a href="'.route('edit.kelurahan', $kelurahan->kode).'" class="btn btn-sm btn-success mx-1">Ubah</a>
                <form id="delete-id-'.$kelurahan->kode.'" action="'.route('destroy.kelurahan', $kelurahan->kode).'" method="POST" style="display: inline-block;">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <button type="submit" class="btn btn-sm btn-danger btn_hapus" data-id="'.$kelurahan->kode.'">Hapus</button>
                </form>';
            })
            ->rawColumns(['opsi','kecamatan','kota','provinsi'])
            ->toJson();

        }

        return view('admin.kelurahan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinsi = Provinsi::all();

        return view('admin.kelurahan.create', compact('provinsi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKelurahanRequest $request)
    {
        Kelurahan::create($request->all());

        return redirect()->route('index.kelurahan')->with('success', 'Data sukses tersimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function show(Kelurahan $kelurahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function edit($kode)
    {
        $kelurahan = Kelurahan::find($kode);
        $provinsi = Provinsi::all();

        return view('admin.kelurahan.edit', compact('kelurahan','provinsi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kelurahan = Kelurahan::find($id);

        $kelurahan->kode = $request->kode;
        $kelurahan->kecamatan_kode = $request->kecamatan_kode;
        $kelurahan->nama = $request->nama;
        $kelurahan->save();

        return redirect()->route('index.kelurahan')->with('success', 'Data sukses tersimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelurahan = Kelurahan::find($id);

        $kelurahan->delete();

        return redirect()->route('index.kelurahan')->with('success', 'Data Terhapus.');
    }
}
