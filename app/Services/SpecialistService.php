<?php

namespace App\Services;

use App\Repositories\SpecialistRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SpecialistService
{
    private $specialistRepository; // phpcs:ignore Zend.NamingConventions.ValidVariableName.PrivateNoUnderscore

    public function __construct(SpecialistRepository $specialistRepository)
    {
        $this->specialistRepository = $specialistRepository;
    }

    public function getAll(array $fields = ['*'])
    {
        return $this->specialistRepository->getAll($fields);
    }

    public function getById(int $id, array $fields = ['*'])
    {
        return $this->specialistRepository->getById($id, $fields);
    }

    // bbuat data jika ada fotonya
    public function create(array $data)
    {
        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }
        return $this->specialistRepository->create($data);
    }

    // saat update maka perlu dihapus dulu fotonya baru ditimpa dengan foto yang baru

    public function update(int $id, array $data)
    {
        $fields = ['*'];
        $specialist = $this->specialistRepository->getById($id, $fields);
        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
            if (!empty($specialist->photo)) {
                $this->deletePhoto($specialist->photo);
            }
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }
        return $this->specialistRepository->update($id, $data);
    }

    // jika ada fotonya hapus fotonya
// lalu hapus
    public function delete(int $id)
    {
        $fields = ['*'];
        $specialist = $this->specialistRepository->getById($id, $fields);
        if ($specialist->photo) {
            $this->deletePhoto($specialist->photo);
        }
        return $this->specialistRepository->delete($id);
    }


    private function uploadPhoto(UploadedFile $photo): string
    {
        return $photo->store('specialists', 'public');
    }

    private function deletePhoto(string $photoPath)
    {
        $relativePath = 'specialists/' . basename($photoPath);
        if (Storage::disk('public')->exists($relativePath)) {
            // Jika ada, hapus file tersebut
            Storage::disk('public')->delete($relativePath);
        }
    }
}