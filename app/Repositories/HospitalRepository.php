<?php // phpcs:ignore Generic.Files.LineEndings.InvalidEOLChar

namespace App\Repositories;

use App\Models\Hospital;

class HospitalRepository
{
    public function getAll(array $fields = ['*'])
    {
        return Hospital::select($fields)->latest()->paginate(10);
    }

    public function getById(int $id, array $fields = ['*'])
    {
        return Hospital::select($fields)->with(['doctors.specialists', 'specialists'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Hospital::create($data);
    }

    public function update(int $id, array $data)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->update($data);

        return $hospital;
    }

    public function delete(int $id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->delete();
    }

}