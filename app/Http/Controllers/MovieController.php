<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::all(); // eloquent
        return view('admin.movie.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.movie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title'=> 'required',
            'durtion'=> 'reqired',
            'genre'=> 'required',
            'director'=> 'required',
            'age_rating'=> 'required|numeric',
            // mimes => bentuk file yang diizinkan untuk diupload
            'poster'=> 'required|mimes:jpg,jpeg,png,webp,svg',
            'description'=> 'required|min:10',
        ], [
            'title.required'=> 'Judul film wajib diisi',
            'duration.required'=> 'Durasi film wajib diisi',
            'genre.required'=> 'Genre film wajib diisi',
            'director.required'=> 'Director film wajib diisi',
            'age_rating.required'=> 'Rating usia wajib diisi',
            'age_rating.numeric'=> 'Rating usia harus berupa angka',
            'poster.required'=> 'Poster film wajib diupload',
            'poster.mimes'=> 'Format poster harus berupa jpg, jpeg, png, webp, atau svg',
            'description.required'=> 'Sinopsis film wajib diisi',
            'description.min'=> 'Sinopsis film harus diisi minimal 10 karakter',
        ]);

        // ambil file yang di upload -> $request->file('nama_input)
        $gambar = $request->file('poster');
        // buat nama baru di filenya, agar menghindari nama fil yang sama
        // nama file eyang diinginkan = <random>-poster.<ekstensi file>
        // getClientOriginalExtension() -> mengambil ekstensi file aslinya
        $namaGambar = Str::random(5) . "-poster." . $gambar->getClientOriginalExtension();
        // simpan file yang diupload ke dalam folder public/storage/posters
        // storeAs('nama_folder', 'nama_file', 'disk') : format menyimpan file
        $path = $gambar->storeAs('poster', $namaGambar, 'public');

        $createData = Movie::create([
            'title'=> $request->title,
            'duration'=> $request->duration,
            'genre'=> $request->genre,
            'director'=> $request->director,
            'age_rating'=> $request->age_rating,
            'poster'=> $path, // path berisi lokasi file yang disimpan
            'description'=> $request->description,
            'actived'=> 1,
        ]);

        if ($createData) {
            return redirect()->route('admin.movies.index')->with('success', 'Data film berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Data film gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $movie = Movie::find($id);
        return view('admin.movie.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title'=> 'required',
            'durtion'=> 'reqired',
            'genre'=> 'required',
            'director'=> 'required',
            'age_rating'=> 'required|numeric',
            // mimes => bentuk file yang diizinkan untuk diupload
            'poster'=> 'mimes:jpg,jpeg,png,webp,svg',
            'description'=> 'required|min:10',
        ], [
            'title.required'=> 'Judul film wajib diisi',
            'duration.required'=> 'Durasi film wajib diisi',
            'genre.required'=> 'Genre film wajib diisi',
            'director.required'=> 'Director film wajib diisi',
            'age_rating.required'=> 'Rating usia wajib diisi',
            'age_rating.numeric'=> 'Rating usia harus berupa angka',
            'poster.mimes'=> 'Format poster harus berupa jpg, jpeg, png, webp, atau svg',
            'description.required'=> 'Sinopsis film wajib diisi',
            'description.min'=> 'Sinopsis film harus diisi minimal 10 karakter',
        ]);

        // data sebelumnya
        $movie = Movie::find($id);
        if ($request->file('poster')) {
            // storage_path() : cek apakah ada file sebelumnya di folder app/public/storage
            $fileSebelumnya = storage_path('app/public/' .  $movie['poster']);
            if (file_exists($fileSebelumnya)) {
                // hapus file sebelumnya
                unlink($fileSebelumnya);
            }

            // ambil file yang di upload -> $request->file('nama_input)
            $gambar = $request->file('poster');
            // buat nama baru di filenya, agar menghindari nama fil yang sama
            // nama file eyang diinginkan = <random>-poster.<ekstensi file>
            // getClientOriginalExtension() -> mengambil ekstensi file aslinya
            $namaGambar = Str::random(5) . "-poster." . $gambar->getClientOriginalExtension();
            // simpan file yang diupload ke dalam folder public/storage/posters
            // storeAs('nama_folder', 'nama_file', 'disk') : format menyimpan file
            $path = $gambar->storeAs('poster', $namaGambar, 'public');
        }


        $updateData = Movie::where('id', $id)->update([
            'title'=> $request->title,
            'duration'=> $request->duration,
            'genre'=> $request->genre,
            'director'=> $request->director,
            'age_rating'=> $request->age_rating,
            // ?? sebelum ?? (if) setelah ?? (else)
            // kalau ada $path (poster baru), ambil sata baru. kalau tdiak ada, ambil data dri $movie sebelumnya
            'poster'=> $path ?? $movie['poster'], // path berisi lokasi file yang disimpan
            'description'=> $request->description,
            'actived'=> 1,
        ]);

        if ($updateData) {
            return redirect()->route('admin.movies.index')->with('success', 'Data film berhasil diubah');
        } else {
            return redirect()->back()->with('error', 'Data film gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // menghapus data
        $deleteData = Movie::where('id', $id)->delete();
        if ($deleteData) {
            return redirect()->route('admin.movies.index')->with('success','Berhasil menghapus data film');
        } else {
            return redirect()->back()->with('failed','Gagal menghapus data film');
        }
    }

    public function home()
    {
        // where ('field', 'value') -> mencari data
        // get() -> mengambil semua data dari hasil filter
        $movie = Movie::where('actived', 1)->get();
        return view('home', compact('movie'));
    }

    public function inactive($id)
    {
        $inactiveMovie = Movie::where('id', $id)->update([
            'actived'=> 0
        ]);
        if ($inactiveMovie) {
            return redirect()->route('admin.movies.index')->with('success','Berhasil non-aktifkan film');
        } else {
            return redirect()->back()->with('failed','Gagal non-aktifkan film');
        }
    }
}
