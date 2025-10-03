<?php // phpcs:ignore Generic.Files.LineEndings.InvalidEOLChar

namespace App\Services;

use App\Repositories\HospitalRepository;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class HospitalService
{

    private $hospitalRepository; // phpcs:ignore Zend.NamingConventions.ValidVariableName.PrivateNoUnderscore

    public function __construct(HospitalRepository $hospitalRepository)
    {
        $this->hospitalRepository = $hospitalRepository;
    }

    public function getAll(array $fields = ['*'])
    {
        return $this->hospitalRepository->getAll($fields);
    }

    public function getById(int $id, array $fields = ['*'])
    {
        return $this->hospitalRepository->getById($id, $fields);
    }


    public function create(array $data)
    {
        // Cek apakah ada key 'photo' dan memastikan nilainya adalah objek file yang di-upload
        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
            // Ganti objek UploadedFile dengan path/nama file yang dikembalikan oleh uploadPhoto()
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }

        // Lanjutkan ke HospitalRepository untuk menyimpan data (termasuk path foto)
        return $this->hospitalRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        $fields = ['*'];

        // 1. Ambil data rumah sakit yang sudah ada
        $hospital = $this->hospitalRepository->getById($id, $fields);

        // 2. Cek jika ada foto baru yang di-upload
        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {

            // 2a. Cek apakah rumah sakit memiliki foto lama
            if (!empty($hospital->photo)) {
                // Hapus foto lama sebelum menyimpan yang baru
                $this->deletePhoto($hospital->photo);
            }

            // 2b. Upload foto yang baru
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }

        // 3. Panggil method update() dari repository untuk menyimpan perubahan
        return $this->hospitalRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        // Tentukan field yang ingin diambil (di sini semua field)
        $fields = ['*'];

        // 1. Ambil data rumah sakit dari database berdasarkan ID
        $hospital = $this->hospitalRepository->getById($id, $fields);

        // 2. Periksa apakah data rumah sakit memiliki foto
        if ($hospital->photo) {
            // Jika ada, panggil method internal untuk menghapus file foto dari storage
            $this->deletePhoto($hospital->photo);
        }

        // 3. Panggil method delete() dari repository untuk menghapus record dari database
        return $this->hospitalRepository->delete($id);
    }


    private function uploadPhoto(UploadedFile $photo)
    {
        // Menyimpan file ke disk 'public' di dalam folder 'hospitals'
        return $photo->store('hospitals', 'public');
    }

    private function deletePhoto(string $photoPath)
    {
        // Mengambil nama file dari path dan membentuk path relatif
        $relativePath = 'hospitals/' . basename($photoPath);

        // Memeriksa dan menghapus file jika ada
        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }
    }

    // menambahkan ke pivot table hospital_specialist jika memang tidak ada
    public function attachSpecialist(int $hospitalId, int $specialistId)
    {
        // 1. Ambil data Rumah Sakit (hanya kolom 'id' yang diperlukan untuk relasi).
        $hospital = $this->hospitalRepository->getById($hospitalId, ['id']);

        // 2. Kaitkan (attach) Specialist ke Hospital menggunakan relasi many-to-many.
        // syncWithoutDetaching memastikan Spesialis ditambahkan jika belum ada,
        // dan TIDAK menghapus Spesialis lain yang sudah terhubung.
        $hospital->specialists()->syncWithoutDetaching($specialistId);
    }

    
    // menghapus pivot tabel jika ada, jika tidaka ada ya tidak apa apa
    public function detachSpecialist(int $hospitalId, int $specialistId)
    {
        // 1. Ambil data Rumah Sakit (hanya kolom 'id' yang diperlukan).
        $hospital = $this->hospitalRepository->getById($hospitalId, ['id']);

        // 2. Lepaskan (detach) Spesialis dari Hospital.
        // detach() akan menghapus entri dari tabel pivot yang menghubungkan keduanya.
        $hospital->specialists()->detach($specialistId);
    }

}