<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class UserExport implements FromCollection, WithMapping, WithHeadings
{
    private $key = 0;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::orderBy('role', 'ASC')->get();
    }

    // menentukan isi th
    public function headings(): array
    {
        return ['No', 'Nama', 'Email', 'Role', 'Tanggal Bergabung'];
    }

    // mengisi td
    public function map($user): array
    {
        return [
            ++$this->key,
            $user->name,
            $user->email,
            $user->role,
            $user->created_at,
        ];
    }
}
