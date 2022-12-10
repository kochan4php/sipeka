<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreRegistrasiAlumniRequest extends FormRequest
{
  private array $column = [
    'username',
    'email',
    'password',
    'nama',
    'nis',
    'jurusan',
    'angkatan',
    'jenis_kelamin'
  ];

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
      'username' => ['required', 'alpha_dash', 'unique:users', 'min:3', 'max:255'],
      'email' => ['required', 'email', 'unique:users', 'min:5', 'max:255'],
      'password' => ['required', Password::min(6)->mixedCase()->numbers()],
      'nama' => ['required', 'min:2', 'max:255'],
      'nis' => ['required', 'unique:siswa_alumni'],
      'jurusan' => ['required'],
      'angkatan' => ['required'],
    ];
  }

  public function validatedDataAlumni(): array
  {
    return $this->only($this->column);
  }
}
