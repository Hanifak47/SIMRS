<?php

namespace App\Http\Resources;

use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HospitalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'photo' => $this->photo,
            'about' => $this->address,
            'address' => $this->address,
            'city' => $this->city,
            'post_code' => $this->post_code, // phpcs:ignore Zend.NamingConventions.ValidVariableName.NotCamelCaps
            'phone' => $this->phone,

            // hitung doktor dan specialist dari rs ini
            'doctor_count' => $this->doctor->count(),
            'specialist_count' => $this->specialist->count(),

            // tampilkan list doctor dan specialist dari rs ini
            'doctors' => DoctorResource::collection($this->whenLoaded('doctors')),
            'specialists' => SpecialistResource::collection($this->whenLoaded('specialists')),
        ];
    }
}
