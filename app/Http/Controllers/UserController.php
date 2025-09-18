<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ambil semua data staff
        $staffs = User::all();
        return view('admin.staff.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email:dns',
            'password'=> 'required|min:8',
        ], [
            'name.required' => 'Nama wajib diisi!',
            'name.min' => 'Nama wajib diisi minimal 3 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email wajib diisi dengan nama yang valid',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password wajib diisi minimal 8 karakter',
        ]);

        // kirim data
        $createData = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff', // default role staff
        ]);

        // perpindahan halaman
        if ($createData) {
            return redirect()->route('admin.staffs.index')->with('success', 'Data staff berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan staff, silahkan coba lagi!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $staff = User::find($id);
        return view('admin.staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email:dns',
            'password'=> 'required|min:8',
        ], [
            'name.required' => 'Nama wajib di isi',
            'name.min' => 'Nama wajib diisi minimal 3 huruf',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email wajib diisi dengan data yang valid',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password wajib diisi minimal 8 karakter',
        ]);

        // kirim data
        $updateData = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> Hash::make($request->password),
        ]);

        // update data
        if ($updateData) {
            return redirect()->route('admin.staffs.index')->with('success', 'Berhasil mengubah data pengguna');
        } else {
            return redirect()->back()->with('failed', 'Gagal! Silahkan coba lagi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $deleteData = User::where('id',$id)->delete();
        if ($deleteData) {
            return redirect()->route('admin.staffs.index')->with('success', 'Data staff berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus staff, silahkan coba lagi!');
        }
    }

    public function signUp(Request $request)
    {
        // (Request $request) : class untuk mengambil value dari formulir validasi
        $request->validate([
            // 'name_input' -> 'tipe validasi'
            // required : wajib diisi, min : minimal karakter ( teks )
            "first_name" => "required|min:3",
            "last_name" => "required|min:3",

            // email:dns = emailnya valid, @gmail @company.com dsb
            "email" => "required|email:dns",
            "password" => "required|min:8",
        ], [
            // Pesan error costum
            // "nama_input.validasi" => "pesan"
            "first_name.required" => "Nama depan wajib diisi!",
            "first_name.min" => "Nama depan wajib diisi minimal 3 karakter",
            "last_name.required" => "Nama belakang wajib diisi!",
            "last_name.min" => "Nama belakang wajib diisi minimal 3 karakter",
            "email.required" => "Email wajib diisi",
            "email.email" => "Email wajib diisi dengan nama yang valid",
            "password.required" => "Password wajib diisi!",
            "password.min" => "Password wajib diisi minimal 8 karakter",
        ]);

        $createUser = User::create([
            // "nama_column" => $request->nama_input
            "name" => $request->first_name . " " . $request->last_name,
            "email" => $request->email,
            // Hash : enkripsi data ( mengubah menjadi karakter acak ) agar tidak ada yang bisa menebak isinya
            "password" => Hash::make($request->password),
            // pengguna tidak bisa memilih role ( akses ), jadi manual ditambahkan "user"
            "role" => "user"
        ]);

        if ($createUser) {
            // redirect() : memindahkan halaman
            // route() : nama routing yang dituju
            // with() : mengirimkan session, biasany untuk notifikasi
            return redirect()->route('login')->with('success', 'Silahkan login!');
        } else {
            // back : kembali ke halaman sebelumnya
            return redirect()->back()->with('error', 'Gagal! Silahkan coba lagi!');
        }
    }

    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi',
        ]);

        // mengambil data yang akan di autentikasi
        $data = $request->only(['email', 'password']);
        // Auth:: -> class laravel untuk penanganan authentichation
        // attempt() -> method class auth untuk mencocokan email-pw atau username-pw kalau cocok akan disimpan datanya ke session auth
        if (Auth::attempt($data)) {
            // jika berhasil login (attempt), dicek lagi role nya
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('success','Berhasil login');
            } elseif (Auth::user()->role == 'staff') {
                return redirect()->route('staff.dashboard')->with('success', 'Berhasil login');
            } else {
                return redirect()->route('home')->with('success','Berhasil login');
            }
        } else {
            return redirect()->back()->with('error', 'Gagal login, Pastikan email dan password sesuai');
        }
    }

    public function logout(Request $request)
    {
        // Auth::logout() -> menghapus sesi login / sesi auth
        Auth::logout();
        return redirect()->route('home')->with('logout','Berhasil logout! silahkan login kembali untuk akses lengkap');
    }
}
