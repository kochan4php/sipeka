<?php

namespace App\Http\Requests\Admin\Pengguna;

use Illuminate\Foundation\Http\FormRequest;

class StoreMitraPerusahaanRequest extends FormRequest
{
  private array $column = [
    'nama_perusahaan',
    'email_perusahaan',
    'password_perusahaan',
    'no_telepon_perusahaan',
    'alamat_perusahaan',
    'foto_sampul_perusahaan',
    'logo_perusahaan',
    'deskripsi_perusahaan',
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
      'nama_perusahaan' => ['required', 'min:3', 'max:255'],
      'email_perusahaan' => ['required', 'email', 'min:5', 'max:255'],
      'password_perusahaan' => ['required'],
      'no_telepon_perusahaan' => ['required', 'min:4', 'max:100'],
      'alamat_perusahaan' => ['required'],
      'foto_sampul_perusahaan' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:5120'],
      'logo_perusahaan' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:3072'],
      'deskripsi_perusahaan' => ['nullable'],
    ];
  }

  public function validatedMitraPerusahaanAttr(): array
  {
    $validatedData = $this->only($this->column);

    $validatedData['foto_sampul_perusahaan'] = !is_null($validatedData['foto_sampul_perusahaan']) ?
      $validatedData['foto_sampul_perusahaan'] : null;

    $validatedData['logo_perusahaan'] = !is_null($validatedData['logo_perusahaan']) ?
      $validatedData['logo_perusahaan'] : null;

    $validatedData['deskripsi_perusahaan'] = !is_null($validatedData['deskripsi_perusahaan']) ?
      $validatedData['deskripsi_perusahaan'] : null;

    return $validatedData;
  }
}
