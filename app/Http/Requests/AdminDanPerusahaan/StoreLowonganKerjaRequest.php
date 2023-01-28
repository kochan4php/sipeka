<?php

namespace App\Http\Requests\AdminDanPerusahaan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreLowonganKerjaRequest extends FormRequest {
  private array $column = [
    'id_perusahaan',
    'judul_lowongan',
    'posisi',
    'estimasi_gaji',
    'id_jenis_pekerjaan',
    'deskripsi_lowongan',
    'tanggal_berakhir',
    'slug',
    'lokasi_kerja'
  ];

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize(): bool {
    return Gate::check('admin') || Gate::check('perusahaan');
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules(): array {
    return [
      'judul_lowongan' => ['required', 'min:10', 'max:255'],
      'posisi' => ['required', 'min:4', 'max:255'],
      'estimasi_gaji' => ['required', 'min:6', 'max:255'],
      'id_jenis_pekerjaan' => ['required'],
      'deskripsi_lowongan' => ['required'],
      'tanggal_berakhir' => ['required'],
      'lokasi_kerja' => ['required']
    ];
  }

  public function validatedData(): array {
    return $this->only($this->column);
  }
}
