<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
        $id = $this->route('doctor'); // Mengambil ID dokter dari rute

        return [
            // Name harus unik di tabel doctors, tapi diabaikan untuk ID dokter saat ini ($id)
            'name' => 'required|string|unique:doctors,name,' . $id,

            // Photo wajib jika method adalah POST (create), jika tidak (PUT/PATCH) sifatnya optional (sometimes)
            'photo' => $this->isMethod('post')
                ? 'required|image|max:2048'
                : 'sometimes|image|max:2048',

            // About wajib dan harus string
            'about' => 'required|string',

            // Year of Experience (yoe) wajib, harus integer, dan minimal 0
            'yoe' => 'required|integer|min:0',

            // specialist_id wajib dan harus ada di tabel specialists kolom id
            'specialist_id' => 'required|exists:specialists,id',

            // hospital_id wajib dan harus ada di tabel hospitals kolom id
            'hospital_id' => 'required|exists:hospitals,id',

            // gender wajib dan nilainya hanya boleh Male atau Female
            'gender' => 'required|in:Male,Female',
        ];
    }
}
