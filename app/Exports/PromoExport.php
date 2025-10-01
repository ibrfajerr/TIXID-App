<?php

namespace App\Exports;

use App\Models\Promo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class PromoExport implements FromCollection, WithMapping, WithHeadings
{
    private $key = 0;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Promo::all();
    }

    public function headings(): array
    {
        return ['No', 'Kode promo', 'Total Potongan', 'Tipe'];
    }

    // mengisi td
    public function map($promo): array
    {
        return [
            ++$this->key,
            $promo->promo_code,
            $promo->type == 'precent' ? $promo->discount . "%" : 'Rp ' . $promo->discount,
            $promo->type,
        ];
    }
}
