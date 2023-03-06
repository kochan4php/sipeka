<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Pengguna;

use Illuminate\Foundation\Http\FormRequest;

class StoreMitraPerusahaanRequest extends FormRequest {
    private array $columnMitra = [
        'nama_perusahaan',
        'email_perusahaan',
        'password_perusahaan',
        'no_telepon_perusahaan',
        'foto_sampul_perusahaan',
        'logo_perusahaan',
        'deskripsi_perusahaan',
        'jenis_perusahaan',
        'kategori_perusahaan'
    ];

    private array $columnKantor = [
        'wilayah_kantor',
        'status_kantor',
        'no_telp_kantor',
        'alamat_kantor'
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array {
        return [
            'nama_perusahaan' => ['required', 'min:3', 'max:255'],
            'email_perusahaan' => ['required', 'email', 'min:5', 'max:255'],
            'password_perusahaan' => ['nullable'],
            'no_telepon_perusahaan' => ['required', 'min:4', 'max:100'],
            'foto_sampul_perusahaan' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:1024'],
            'logo_perusahaan' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:800'],
            'deskripsi_perusahaan' => ['nullable'],
            'jenis_perusahaan' => ['required'],
            'kategori_perusahaan' => ['required'],
        ];
    }

    public function validatedDataKantor(): array {
        return $this->only($this->columnKantor);
    }

    private function validatedData(): array {
        $validatedData = $this->only($this->columnMitra);

        $validatedData['deskripsi_perusahaan'] = !is_null($validatedData['deskripsi_perusahaan']) ?
            $validatedData['deskripsi_perusahaan'] : null;

        return $validatedData;
    }

    public function validatedDataPerusahaan(): array {
        $validatedData = $this->validatedData();

        if ($this->hasFile('foto_sampul_perusahaan')) {
            $file = $this->file('foto_sampul_perusahaan');
            $validatedData['foto_sampul_perusahaan'] = $file->storeAs('images/perusahaan/foto_sampul', 'prs-' . $file->hashName());
        } else {
            $validatedData['foto_sampul_perusahaan'] = null;
        }

        if ($this->hasFile('logo_perusahaan')) {
            $file = $this->file('logo_perusahaan');
            $validatedData['logo_perusahaan'] = $file->storeAs('images/perusahaan/logo', 'prs-' . $file->hashName());
        } else {
            $validatedData['logo_perusahaan'] = null;
        }

        return $validatedData;
    }
}
