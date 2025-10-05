<?php // phpcs:ignore Generic.Files.LineEndings.InvalidEOLChar

namespace App\Services;

use App\Repositories\DoctorRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Repositories\HospitalSpecialistRepository;
use Dotenv\Exception\ValidationException;

class DoctorService
{
    private $doctorRepository; // phpcs:ignore Zend.NamingConventions.ValidVariableName.PrivateNoUnderscore

    private $hospitalSpecialistRepository; // phpcs:ignore Zend.NamingConventions.ValidVariableName.PrivateNoUnderscore

    // dependency injectionnya
    public function __construct(
        DoctorRepository $doctorRepository,
        HospitalSpecialistRepository $hospitalSpecialistRepository
    ) {
        $this->doctorRepository = $doctorRepository;
        $this->hospitalSpecialistRepository = $hospitalSpecialistRepository;
    }

    public function getAll(array $fields)
    {
        return $this->doctorRepository->getAll($fields);
    }

    public function getById(int $id, array $fields = ['*'])
    {
        return $this->doctorRepository->getById($id, $fields);
    }

    public function create(array $data)
    {
        // saat membuat dokter maka pastikan bahwa memang ada rumah sakitnya dan meamng ada spesialisasinya
        // ini untuk menangani inject langsung di html demi keamnanan
        if (
            !$this->hospitalSpecialistRepository->existsForHospitalAndSpecialist(
                $data['hospital_id'],
                $data['specialist_id']
            )
        ) {
            throw ValidationException::withMessages([
                'specialist_id' => ['Specialist yang dipilih tidak tersedia di rumah sakit']
            ]);
        }

        // proses pembuatan
        // jika memang ada fotonya

        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }

        return $this->doctorRepository->create($data);
    }



    public function update(int $id, array $data)
    {
        // saat membuat dokter maka pastikan bahwa memang ada rumah sakitnya dan meamng ada spesialisasinya
        // ini untuk menangani inject langsung di html demi keamnanan
        if (
            !$this->hospitalSpecialistRepository->existsForHospitalAndSpecialist(
                $data['hospital_id'],
                $data['specialist_id']
            )
        ) {
            throw ValidationException::withMessages([
                'specialist_id' => ['Specialist yang dipilih tidak tersedia di rumah sakit']
            ]);
        }

        $doctor = $this->doctorRepository->getById($id);

        // /jika unggah foto
        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
            // jika foto sebelumnya ada, maka hapus dulu
            if (!empty($doctor->photo)) {
                $this->deletePhoto($doctor->photo);
            }
            // ini baru foto nya diunggah foto yg baru di simpan di folder tujuan
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }

        return $this->doctorRepository->update($id, $data);
    }



    public function delete(int $id)
    {
        $doctor = $this->doctorRepository->getById($id);
        // jika ada fotonya maka hapus
        if ($doctor->photo) {
            $this->deletePhoto($doctor->photo);
        }
        return $this->doctorRepository->delete($id);
    }


    // Method untuk mengunggah (upload) foto
    private function uploadPhoto(UploadedFile $photo)
    {
        return $photo->store('doctors', 'public');
    }

    // Method untuk menghapus foto
    private function deletePhoto(string $photoPath)
    {
        $relativePath = 'doctor/' . basename($photoPath);
        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }
    }

    public function filterBySpecialAndHospital(int $hospitalId, int $specialistId) // phpcs:ignore Generic.Files.LineLength.TooLong
    {
        return $this->doctorRepository->filterBySpecialistAndHospital($hospitalId, $specialistId);
    }

    public function getAvailableSlots(int $doctorId)
    {
        $doctor = $this->doctorRepository->getById($doctorId);

        // hanya bisa booking untuk h-1 untul h-3
        $dates = collect([
            now()->addDays(1)->startOfDay(), //jika tgl bookinnya adalah besok
            now()->addDays(2)->startOfDay(), // besok lusa
            now()->addDays(3)->startOfDay(), // besok lusa + 1
        ]);

        // waktu pesanan yg tersedia
        $timeSlots = ['10:30', '11:30', '13:30', '14:30', '15:30', '16:30'];

        $availability = [];

        foreach ($dates as $date) {

            $daterstr = $date->toDateString();
            $availability = [$daterstr] = [];

            foreach ($timeSlots as $timeSlot) {
                // cek di db apakah ada transaksi di waktu dan t
                $isTaken = $doctor->bookingTransactions()
                    ->whereDate('started_at', $daterstr)
                    ->whereTime('time_at', $timeSlot)
                    ->exists();

                if (!$isTaken) {
                    $availability[$daterstr][] = $timeSlot;
                }
            }

            return $availability;
        }

    }
}