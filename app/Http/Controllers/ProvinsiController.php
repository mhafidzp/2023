<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProvinsiRequest;
use App\Models\Provinsi;
use App\Models\Kota;
use Yajra\DataTables\Facades\DataTables;

class ProvinsiController extends Controller
{
    public function index()
    {
        // $provinsi = Provinsi::with('kota')->where('kode','112')->first();
        // $kota = Kota::with('provinsi')->where('kode','12421')->first();
        // dd($provinsi->kota[0]->nama);
        $provinsi = Provinsi::Query();

        if (request()->ajax()) {

            return Datatables::eloquent($provinsi)
            ->addColumn('opsi', function (Provinsi $provinsi) {
                return '<a href="'.route('edit.provinsi', $provinsi->kode).'" class="btn btn-sm btn-success mx-1">Ubah</a>
                <form id="delete-id-'.$provinsi->id.'" action="'.route('destroy.provinsi', $provinsi->id).'" method="POST" style="display: inline-block;">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <button type="submit" class="btn btn-sm btn-danger btn_hapus" data-id="'.$provinsi->id.'">Hapus</button>
                </form>';
            })
            ->rawColumns(['opsi'])
            ->toJson();

        }


        return view('admin.provinsi.index');
    }

    public function create()
    {
        return view('admin.provinsi.create');
    }

    public function store(StoreProvinsiRequest $request)
    {
        Provinsi::create($request->all());

        return redirect()->route('index.provinsi')->with('success', 'Data sukses tersimpan.');
    }

    public function edit($kode)
    {
        $provinsi = Provinsi::find($kode);

        return view('admin.provinsi.edit',compact('provinsi'));
    }

    public function update(Request $request)
    {
        Provinsi::where('id',$request->id)->update([
            'kode' => $request->kode,
            'nama' => $request->nama
        ]);

        return redirect()->route('index.provinsi')->with('success', 'Data sukses tersimpan.');
    }

    public function destroy($id)
    {
        Provinsi::where('id',$id)->delete();

        return redirect()->route('index.provinsi')->with('success', 'Data Terhapus.');
    }

    public function cekKode(Request $request)
    {
        $isAvailable = true;

        $data = Provinsi::where('kode', $request->kode)->first();

        if($data){
            $isAvailable = false;
        }

        return json_encode(array(
            'valid' => $isAvailable,
        ));
    }
}
