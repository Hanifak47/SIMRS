<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecialistRequest extends FormRequest
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

        // id ini perlu karena namanya ada validasi uniknya
        $id = $this->route('specialist');


        // jika ada data spesialis

        // nama = jantung, about = kronis diubah menjadi nama = jantung, about = ringan maka bisa karena ada $idnya, meskipun ada validasi uniknya
        // unique:specialist = nama wajib berbeda dari tabel spesialis, kecuali ubah nama boleh sama dengan data lama karena ada idnya
        // photo = jika pertama kali dibuat maka wajib diisi, jika tidak mungkin saat ubah atau lainnya maka boleh diisi boleh tidak
        return [
            'name' => 'required|string|unique:specialists,name,' . $id,
            'photo' => $this->isMethod('post') ? 'required|image|max:2048' : 'sometimes|image|max:2048',
            'about' => 'required|string',
            'price' => 'required|numeric|min:0',
        ];
    }
}
