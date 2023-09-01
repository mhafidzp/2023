<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Hash;
use Session;

class AdminController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if(Auth::guard('admin')->attempt($request->only(['email', 'password'])))
        {
            return redirect('/admin/dashboard');
        }

        return redirect()->back()->with('fail','username atau password salah!');
    }

    public function logout()
    {
        Session::flush();
        Auth::guard('admin')->logout();

        return redirect('/admin/login');
    }

    public function formLogin()
    {
        return view('admin.login.index');
    }

    public function index()
    {
        //dd(Auth::guard('admin'));
        return view('admin.dashboard.index');
    }

    public function userAdmin()
    {
        $user = Admin::Query();
        if (request()->ajax()) {

            return Datatables::eloquent($user)
            ->addColumn('opsi', function (Admin $user) {
                return '<a href="'.route('edit.admin', $user->id).'" class="btn btn-sm btn-success mx-1">Ubah</a>
                <form id="delete-id-'.$user->id.'" action="'.route('destroy.admin', $user->id).'" method="POST" style="display: inline-block;">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <button type="submit" class="btn btn-sm btn-danger btn_hapus" data-id="'.$user->id.'">Hapus</button>
                </form>';
            })
            ->rawColumns(['opsi'])
            ->toJson();

        }

        return view('admin.user_admin.index');
    }

    public function create()
    {
        $role = Role::get();

        return view('admin.user_admin.create', compact('role'));
    }

    public function store(Request $request)
    {
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.user')->with('success', 'Data sukses tersimpan.');
    }

    public function edit($id)
    {
        $user = Admin::find($id);
        $role = Role::get();

        return view('admin.user_admin.edit', compact('user','role'));
    }

    public function update(Request $request, $id)
    {
        $user = Admin::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if($request->password){
            $user->password = Hash::make($user->password);
        }

        $user->save();

        return redirect()->route('admin.user')->with('success', 'Data sukses tersimpan.');
    }

    public function destroy($id)
    {
        Admin::where('id',$id)->delete();

        return redirect()->route('admin.user')->with('success', 'Data Terhapus.');
    }

    public function cekEmail(Request $request)
    {
        $isAvailable = true;

        $data = Admin::where('email', $request->email)->first();

        if($data){
            $isAvailable = false;
        }

        return json_encode(array(
            'valid' => $isAvailable,
        ));
    }
}
