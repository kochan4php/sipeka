<?php

namespace App\Http\Requests\Admin\Pengguna;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StorePersonRequest extends FormRequest
{
  private array $column = [
    "nama",
    "password",
    "email",
    "jenis_kelamin",
    "no_telp",
    "tempat_lahir",
    "tanggal_lahir",
    "alamat",
    "foto_pelamar",
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
      "nama" => ['required', 'min:3', 'max:255'],
      "password" => ['required'],
      "email" => ['nullable'],
      "jenis_kelamin" => ['required'],
      "no_telp" => ['nullable'],
      "tempat_lahir" => ['nullable'],
      "tanggal_lahir" => ['nullable'],
      "alamat" => ['nullable'],
      "foto_pelamar" => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:3072'],
    ];
  }

  public function validatedPersonAttr(): array
  {
    $validatedData = $this->only($this->column);

    $validatedData['email'] = !is_null($validatedData['email']) ?
      $validatedData['email'] : null;

    $validatedData['tempat_lahir'] = !is_null($validatedData['tempat_lahir']) ?
      $validatedData['tempat_lahir'] : null;

    $validatedData['tanggal_lahir'] = !is_null($validatedData['tanggal_lahir']) ?
      Carbon::parse($validatedData['tanggal_lahir']) : null;

    $validatedData['no_telp'] = !is_null($validatedData['no_telp']) ?
      $validatedData['no_telp'] : null;

    $validatedData['alamat'] = !is_null($validatedData['alamat']) ?
      $validatedData['alamat'] : null;

    $validatedData['foto_pelamar'] = !is_null($validatedData['foto_pelamar']) ?
      $validatedData['foto_pelamar'] : null;

    return $validatedData;
  }
}
