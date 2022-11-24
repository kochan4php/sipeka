<?php

namespace App\Http\Requests\Admin\Pengguna;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlumniRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'jurusan' => ['required'],
      'angkatan' => ['required'],
      'nis' => ['required', 'min:3', 'max:18'],
      'nama' => ['required', 'min:3', 'max:255'],
      'jenis_kelamin' => ['required'],
      'tempat_lahir' => ['nullable'],
      'tanggal_lahir' => ['nullable', 'date'],
      'no_telp' => ['nullable'],
      'alamat_alumni' => ['nullable'],
      'foto_alumni' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:3072'],
    ];
  }
}
