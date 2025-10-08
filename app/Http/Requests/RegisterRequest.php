<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            // Perubahan di sini: Ditambahkan '|in:male,female'
            'gender' => 'required|string|max:20|in:Male,Female',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    // pada dasarnya massage di bawah ini bisa berupa <key> dot <value> dari validasi dia tas

    public function messages(): array
    {
        return [
            // Pesan kustom untuk aturan 'required' pada field 'name'
            'name.required' => 'Nama harus diisi.',
            // Pesan kustom untuk aturan 'unique' pada field 'email'
            'email.unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain.',
            // Pesan kustom untuk aturan 'in' pada field 'gender'
            'gender.in' => 'Pilihan gender salah. Hanya boleh diisi Male atau Female.',
            // Pesan kustom untuk aturan 'max' pada field 'photo'
            'photo.max' => 'Ukuran foto maksimal adalah 2MB.',
            // Pesan kustom untuk aturan 'confirmed' pada field 'password'
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];
    }

}
