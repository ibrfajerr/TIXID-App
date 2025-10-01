<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PromoExport;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $promos = Promo::all(); // eloquent
        return view('staff.promo.index', compact('promos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('staff.promo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi
        $request->validate([
            'discount' => 'required|numeric',
            'type' => 'required',
        ], [
            'discount.required' => 'Jumlah Promo harus diisi',
            'discount.numeric' => 'Jumlah promo wajib pakai angka',
            'type.required' => ' Promo harus diisi',
        ]);

        $promoCode = "PRM" . Str::random(5);
        // kirim data
        $createPromo = Promo::create([
            'promo_code'=> $promoCode,
            'discount' => $request->discount,
            'type' => $request->type,
            'actived'=> 1,
        ]);

        // redirect / perpindahan halaman
        if ($createPromo) {
            return redirect()->route('staff.promos.index')->with('success','Berhasil membuat data Promo');
        } else {
            return redirect()->back()->with('failed','Gagal membuat data Promo');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Promo $promo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $promo = Promo::find($id);
        return view('staff.promo.edit', compact('promo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'discount' => 'required|numeric',
            'type' => 'required',
        ], [
            'discount.required' => 'Jumlah Promo harus diisi',
            'discount.numeric' => 'Jumlah promo wajib pakai angka',
            'type.required' => ' Promo harus diisi',
        ]);

        // kirim data
        $findPromo = Promo::find($id);

        $updatePromo = Promo::where('id',$id)->update([
            'promo_code'=> $findPromo->promo_code,
            'discount' => $request->discount,
            'type' => $request->type,
            'actived'=> 1,
        ]);

        // redirect / perpindahan halaman
        if ($updatePromo) {
            return redirect()->route('staff.promos.index')->with('success','Berhasil mengubah data Promo');
        } else {
            return redirect()->back()->with('failed','Gagal mengubah data Promo');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $deleteData = Promo::where('id', $id)->delete();
        if ($deleteData) {
            return redirect()->route('staff.promos.index')->with('success','Berhasil menghapus data promo');
        } else {
            return redirect()->back()->with('failed','Gagal menghapus data promo');
        }
    }

    public function inactive($id)
    {
        $inactivePromo = Promo::where('id', $id)->update([
            'actived'=> 0
        ]);
        if ($inactivePromo) {
            return redirect()->route('staff.promos.index')->with('success','Berhasil non-aktifkan promo');
        } else {
            return redirect()->back()->with('failed','Gagal non-aktifkan promo');
        }
    }

    public function export()
    {
        // nama file yang akan diunduh
        $fileName = 'data-promo.xlsx';
        // proses unduh
        return Excel::download(new PromoExport, $fileName);
    }
}
