<?php

namespace App\Http\Requests\AdminDanPerusahaan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreLowonganKerjaRequest extends FormRequest {
  private array $column = ['judul_lowongan', 'deskripsi_lowongan', 'tanggal_dimulai', 'tanggal_berakhir'];

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
      'deskripsi_lowongan' => ['required'],
      'tanggal_dimulai' => ['required'],
      'tanggal_berakhir' => ['required']
    ];
  }

  public function validatedData(): array {
    return $this->only($this->column);
  }
}
