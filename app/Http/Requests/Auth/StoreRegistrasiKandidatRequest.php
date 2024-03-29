<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreRegistrasiKandidatRequest extends FormRequest {
    private array $column = [
        'username',
        'email',
        'password',
        'nama',
        'no_telp',
        'jenis_kelamin'
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array {
        return [
            'username' => ['required', 'alpha_dash', 'unique:users', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'unique:users', 'min:5', 'max:255'],
            'password' => ['required', Password::min(6)->mixedCase()->numbers()],
            'nama' => ['required', 'min:2', 'max:255'],
            'no_telp' => ['required', 'numeric']
        ];
    }

    public function validatedDataKandidat(): array {
        return $this->only($this->column);
    }
}
