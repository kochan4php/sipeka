<?php

namespace App\Http\Requests\Admin\Pengguna;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreAlumniRequest extends FormRequest
{
  private array $column = [
    'jurusan',
    'angkatan',
    'nis',
    'nama',
    'jenis_kelamin',
    'tempat_lahir',
    'tanggal_lahir',
    'no_telp',
    'alamat_alumni',
    'foto_alumni',
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

  private function validatedData(): array
  {
    $validatedData = $this->only($this->column);

    $validatedData['tempat_lahir'] = !is_null($validatedData['tempat_lahir']) ?
      $validatedData['tempat_lahir'] : null;

    $validatedData['tanggal_lahir'] = !is_null($validatedData['tanggal_lahir']) ?
      Carbon::parse($validatedData['tanggal_lahir']) : null;

    $validatedData['no_telp'] = !is_null($validatedData['no_telp']) ?
      $validatedData['no_telp'] : null;

    $validatedData['alamat_alumni'] = !is_null($validatedData['alamat_alumni']) ?
      $validatedData['alamat_alumni'] : null;

    return $validatedData;
  }

  public function validatedDataAlumni(): array
  {
    $validatedData = $this->validatedData();

    if ($this->hasFile('foto_alumni')) {
      $file = $this->file('foto_alumni');
      $validatedData['foto_alumni'] = $file->storeAs('images/alumni', 'alumni-' . $file->hashName());
    } else $validatedData['foto_alumni'] = null;

    return $validatedData;
  }
}
