<?php // phpcs:ignore Generic.Files.LineEndings.InvalidEOLChar

namespace App\Repositories;

use App\Models\HospitalSpecialist; // Memastikan model di-import

class HospitalSpecialistRepository
{
    /**
     * Memeriksa apakah ada entri (record) yang menghubungkan
     * ID rumah sakit tertentu dengan ID spesialis tertentu.
     *
     * @param int $hospitalId ID Rumah Sakit
     * @param int $specialistId ID Spesialis
     * @return bool
     */
    public function existsForHospitalAndSpecialist(int $hospitalId, int $specialistId): bool
    {
        return HospitalSpecialist::where('hospital_id', $hospitalId)
            ->where('specialist_id', $specialistId)
            ->exists();
    }
}