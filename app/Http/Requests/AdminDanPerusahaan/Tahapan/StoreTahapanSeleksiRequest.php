<?php

namespace App\Http\Requests\AdminDanPerusahaan\Tahapan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreTahapanSeleksiRequest extends FormRequest {
  private array $columm = ['urutan_tahapan_ke', 'judul_tahapan', 'ket_tahapan', 'tanggal_dimulai'];

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
      'urutan_tahapan_ke' => ['required'],
      'judul_tahapan' => ['required', 'min:5', 'max:200'],
      'ket_tahapan' => ['required'],
      'tanggal_dimulai' => ['required', 'date']
    ];
  }

  public function validatedData(): array {
    return $this->only($this->columm);
  }
}
