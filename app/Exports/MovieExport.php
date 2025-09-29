<?php

namespace App\Exports;

use App\Models\Movie;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class MovieExport implements FromCollection, WithMapping, WithHeadings
{
    private $key = 0;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Movie::all();
    }

    // menentukan isi th
    public function headings(): array
    {
        return ['No', 'Judul', 'Durasi', 'Genre', 'Sutradara', 'Usia Minimal', 'Poster', 'Sinopsis', 'Status'];
    }

    // mengisi td
    public function map($movie): array
    {
        return [
            ++$this->key,
            $movie->title,
            // 02:00 jadi 2 jam 0 menit
            Carbon::parse($movie->duration)->format('H') . " Jam, " . Carbon::parse($movie->duration)->format('i') . " Menit",
            $movie->genre,
            $movie->director,
            $movie->age_rating . "+",
            // poster berupa url public : asset()
            asset('storage') . '/' . $movie->poster,
            $movie->description,
            $movie->actived == 1 ? 'Aktif' : 'Non-Aktif',
        ];
    }
}
