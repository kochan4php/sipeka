<?php

namespace App\Http\Requests\AdminDanPerusahaan\Tahapan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePenilaianSeleksiRequest extends FormRequest {
  private array $column = ['nilai', 'keterangan', 'is_lanjut'];

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
      'nilai' => ['required', 'numeric', 'min:1', 'max:100'],
      'keterangan' => ['required'],
      'is_lanjut' => ['required']
    ];
  }

  public function validatedData(): array {
    return $this->only($this->column);
  }
}
