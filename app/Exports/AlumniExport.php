<?php

namespace App\Exports;

use App\Models\SiswaAlumni;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AlumniExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles, WithEvents {
    use RegistersEventListeners, Exportable;

    /**
     * @return Collection
     */
    public function collection(): Collection {
        return  DB::table('get_all_siswa_alumni')
            ->select([
                'nama_lengkap',
                'nis',
                'jenis_kelamin',
                'keterangan',
                'angkatan_tahun'
            ])
            ->get();
    }

    /**
     * Set heading document format
     *
     * @return array
     */
    public function headings(): array {
        return [
            ['BKK SMKN 1 Kota Bekasi'],
            [
                'Nama',
                'NIS',
                'Jenis Kelamin',
                'Jurusan',
                'Angkatan'
            ]
        ];
    }

    /**
     * Set column width document format
     *
     * @return array
     */
    public function columnWidths(): array {
        return [
            'A' => 20,
            'B' => 15,
            'C' => 15,
            'D' => 30,
            'E' => 15
        ];
    }

    public function styles(Worksheet $sheet): void {
        $sheet->getStyle(2)
            ->getFont()
            ->setBold(true);
    }
}
