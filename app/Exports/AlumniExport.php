<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AlumniExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles, WithEvents {
    use RegistersEventListeners;
    /**
     * @return SupportCollection
     */
    public function collection(): Collection {
        $columns = [
            'angkatan_tahun',
            'nama_jurusan',
            'nis',
            'nama_lengkap',
            'jenis_kelamin'
        ];

        return DB::table('get_all_siswa_alumni')
            ->select($columns)
            ->get();
    }

    public function headings(): array {
        return [
            [],  ['BKK SMKN 1 Kota Bekasi'], [], [
                'Nama',
                'NIS',
                'Jenis Kelamin',
                'Jurusan',
                'Angkatan'
            ]
        ];
    }

    public function columnWidths(): array {
        return [
            'A' => 40,
            'B' => 20,
            'C' => 10,
            'D' => 40,
            'E' => 40
        ];
    }

    public function styles(Worksheet $sheet) {
        //
    }
}
