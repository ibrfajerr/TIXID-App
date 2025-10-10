<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Movie;
use App\Models\Cinema;
use Illuminate\Cache\RetrievesMultipleKeys;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cinemas = Cinema::all();
        $movies = Movie::all();

        // with() : mengambil fungsi relasi dari model
        $schedules = Schedule::with(['cinema', 'movie'])->get();

        return view('staff.schedule.index', compact('cinemas', 'movies', 'schedules'));
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
        //
        $request->validate([
            'cinema_id' => 'required',
            'movie_id' => 'required',
            'price' => 'required|numeric',
            'hours.*' => 'required',
        ], [
            'cinema_id.required' => 'Bioskop harus dipilih',
            'movie_id.required' => 'Film harus dipilih',
            'price.required' => 'Harga harus diisi',
            'price.numeric' => 'Harga harus diisi berupa angka',
            'hours.*.required' => 'Jam harus diisi minimal satu data jam',
        ]);

        // ambil data yang sudah ada berdasarka bioskop dan film yang sudah ada
        $schedule = Schedule::where('cinema_id', $request->cinema_id)->where
        ('movie_id', $request->movie_id)->first();
        if ($schedule) {
            // ambil data jam yang sebelumnya
            $hours = $schedule['hours'];
        } else {
            // klw tdk ad data, jam dibuat kosong dlu
            $hours = [];
        }
        ;

        // gabungka jam sebelumnya dengan jam baru dr input ($request->hours)
        $mergeHours = array_merge($hours, $request->hours);
        // jika ad jam yg sama, hilangkan duplikat data
        // gunakan data jam ini untuk database
        $newHours = array_unique($mergeHours);

        $createData = Schedule::updateOrCreate([
            'cinema_id' => $request->cinema_id,
            'movie_id' => $request->movie_id,
        ], [
            'price' => $request->price,
            'hours' => $newHours,
        ]);

        if ($createData) {
            return redirect()->route('staff.schedules.index')->with('success', 'Berhasil menambahkan data jadwal');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data bioskop');
        }
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule, $id)
    {
        //
        $schedule = Schedule::where('id', $id)->with(['cinema', 'movie'])->first();
        return view('staff.schedule.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule, $id)
    {
        //
        $request->validate([
            'price' => 'required|numeric',
            'hours.*' => 'required|date_format:H:i',
        ], [
            'price.required' => 'Harga harus diisi',
            'price.numeric' => 'Harga harus diisi berupa angka',
            'hours.*.required' => 'Jam harus diisi minimal satu data jam',
            'hours.*.date_format' => 'Jam tayang harus diisi dengan format jam:menit'
        ]);

        $updateData = Schedule::where('id', $id)->update([
            'price' => $request->price,
            'hours' => $request->hours,
        ]);

        if ($updateData) {
            return redirect()->route('staff.schedules.index')->with('success', 'Berhasil mengubah data');
        } else {
            return redirect()->back()->with('error', 'Gagal! coba lagi');
        }
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule, $id)
    {
        //
        Schedule::where('id', $id)->delete();
        return redirect()->route('staff.schedules.index')->with('success', 'Berhasil menghapus data');
    }

    public function trash()
    {
        $scheduleTrash = Schedule::with(['cinema', 'movie'])->onlyTrashed()->get();
        return view('staff.schedule.trash', compact('scheduleTrash'));
    }

    public function restore($id)
    {
        $schedule = Schedule::onlyTrashed()->find($id);
        $schedule->restore();
        return redirect()->route('staff.schedules.index')->with('success', 'Berhasil memulihkan data!');
    }

    public function deletePermanent($id)
    {
        // menghapus data secara permanen
        $schedule = Schedule::onlyTrashed()->find($id);
        $schedule->forceDelete();
        return redirect()->back()->with('success', 'Berhasil menghapus data secara permanen!');
    }
}
