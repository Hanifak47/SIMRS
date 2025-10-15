<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // Atribut dasar (sesuai yang Anda pilih di Controller)
            'id' => $this->id,
            'name' => $this->name, // Nama dokter
            'photo' => $this->photo,
            'yoe' => $this->yoe,
            'specialist_id' => $this->specialist_id,
            'hospital_id' => $this->hospital_id,
            'updated_at' => $this->updated_at,

            // ATTRIBUTE HOSPITAL BARU:
            // Menggunakan whenLoaded() untuk memastikan relationship sudah di-eager load 
            // di Repository (seperti yang kita perbaiki sebelumnya).
            // Jika Anda memiliki HospitalResource, gunakan:
            // 'hospital' => $this->whenLoaded('hospital', new HospitalResource($this->hospital)),

            // Jika Anda belum memiliki HospitalResource, gunakan ini untuk mengirimkan objek penuh hospital:
            'hospital' => $this->whenLoaded('hospital'),
        ];
    }
}
