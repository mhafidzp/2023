<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = User::Query();
        if (request()->ajax()) {

            return Datatables::eloquent($user)
            ->addColumn('opsi', function (User $user) {
                return '<a href="'.route('edit.user', $user->id).'" class="btn btn-sm btn-success mx-1">Ubah</a>
                <form id="delete-id-'.$user->id.'" action="'.route('destroy.user', $user->id).'" method="POST" style="display: inline-block;">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <button type="submit" class="btn btn-sm btn-danger btn_hapus" data-id="'.$user->id.'">Hapus</button>
                </form>';
            })
            ->rawColumns(['opsi'])
            ->toJson();

        }

        return view('admin.user.index');
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(StoreUserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('index.user')->with('success', 'Data sukses tersimpan.');
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.user.edit',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password){
            $user->password = Hash::make($user->password);
        }

        $user->save();

        return redirect()->route('index.user')->with('success', 'Data sukses tersimpan.');
    }

    public function destroy($id)
    {
        User::where('id',$id)->delete();

        return redirect()->route('index.user')->with('success', 'Data Terhapus.');
    }

    public function cekEmail(Request $request)
    {
        $isAvailable = true;

        $data = User::where('email', $request->email)->first();

        if($data){
            $isAvailable = false;
        }

        return json_encode(array(
            'valid' => $isAvailable,
        ));
    }

    public function dashboard()
    {
        return view('user.dashboard.index');
    }
}
