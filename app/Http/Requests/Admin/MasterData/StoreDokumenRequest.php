<?php

namespace App\Http\Requests\Admin\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class StoreDokumenRequest extends FormRequest
{
  private array $column = ['id_jenis_dokumen', 'nama_dokumen'];

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules(): array
  {
    return [
      'id_jenis_dokumen' => ['required'],
      'nama_dokumen' => ['required']
    ];
  }

  public function validatedData(): array
  {
    return $this->only($this->column);
  }
}
