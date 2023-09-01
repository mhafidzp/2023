<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreKotaRequest;
use App\Models\Provinsi;
use App\Models\Kota;
use Yajra\DataTables\Facades\DataTables;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kota = Kota::with('provinsi');
        if (request()->ajax()) {

            return Datatables::eloquent($kota)
            ->addColumn('provinsi', function (Kota $kota) {
                return $kota->provinsi->nama;
            })
            ->addColumn('opsi', function (Kota $kota) {
                return '<a href="'.route('edit.kota', $kota->kode).'" class="btn btn-sm btn-success mx-1">Ubah</a>
                <form id="delete-id-'.$kota->kode.'" action="'.route('destroy.kota', $kota->kode).'" method="POST" style="display: inline-block;">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <button type="submit" class="btn btn-sm btn-danger btn_hapus" data-id="'.$kota->kode.'">Hapus</button>
                </form>';
            })
            ->rawColumns(['opsi','provinsi'])
            ->toJson();

        }

        return view('admin.kota.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinsi = Provinsi::all();

        return view('admin.kota.create', compact('provinsi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKotaRequest $request)
    {
        Kota::create($request->all());

        return redirect()->route('index.kota')->with('success', 'Data sukses tersimpan.');
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
        $kota = Kota::find($kode);
        $provinsi = Provinsi::all();

        return view('admin.kota.edit', compact('kota','provinsi'));
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
        $kota = Kota::find($id);

        $kota->kode = $request->kode;
        $kota->provinsi_kode = $request->provinsi_kode;
        $kota->nama = $request->nama;
        $kota->save();

        return redirect()->route('index.kota')->with('success', 'Data sukses tersimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kota = Kota::find($id);

        $kota->delete();

        return redirect()->route('index.kota')->with('success', 'Data Terhapus.');
    }

    public function select(Request $request)
    {
        $kota = Kota::select('kode as id','nama as text')->where('provinsi_kode', $request->provinsi_kode)->get();

        return response()->json(['success' => true, 'data' => $kota]);
    }

    public function cekKode(Request $request)
    {
        $isAvailable = true;

        $data = Kota::where('kode', $request->kode)->first();

        if($data){
            $isAvailable = false;
        }

        return json_encode(array(
            'valid' => $isAvailable,
        ));
    }
}
