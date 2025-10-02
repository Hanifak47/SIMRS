<?php // phpcs:ignore Generic.Files.LineEndings.InvalidEOLChar

namespace App\Repositories;

use App\Models\Specialist;

class SpecialistRepository
{

    /**
     * Mengambil semua spesialis dengan seleksi kolom,
     * urutan terbaru, relasi yang dimuat secara eager, dan paginasi.
     *
     * @param array $fields Kolom yang ingin diseleksi.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll(array $fields)
    {
        // Panggil model Specialist, seleksi kolom, urutkan berdasarkan yang terbaru,
        // muat relasi 'hospitals' dan 'doctors' secara eager, lalu paginasi 10 per halaman.
        return Specialist::select($fields)
            ->latest()
            ->with(['hospitals', 'doctors'])
            ->paginate(10);
    }

    public function getById(int $id, array $field)
    {

        // intinya adalah mendapatkan data specialist, beserta rumahsakit sesuai specialist tersebut beserta jumlah dokter untuk rumah sakit dan specialist tersebut
        return Specialist::select($field)
            ->with([
                'hospitals' => function ($q) use ($id) {
                    // Melakukan eager loading pada 'hospitals'
                    // dan sekaligus menghitung jumlah doctors yang terkait dengan specialist ini
                    $q->withCount([
                        'doctors as doctors_count' => function ($query) use ($id) {
                        // Batasan (constraint) pada penghitungan doctor: doctor harus terkait dengan specialist ini.
                        $query->where('specialist_id', $id);
                    }
                    ]);
                },
                'doctors' => function ($q) use ($id) {
                    // Melakukan eager loading pada 'doctors'
                    // dan membatasi doctors yang dimuat hanya yang terkait dengan specialist ini.
                    $q->where('specialist_id', $id)
                        // Eager loading relasi 'hospital' dari setiap doctor
                        // dengan hanya memilih kolom id, name, city, dan post_code
                        ->with('hospital:id,name,city,post_code');
                }
            ])
            // Mencari Specialist berdasarkan $id.
// Jika tidak ditemukan, akan melempar Exception (misalnya ModelNotFoundException)
            ->findOrFail($id);

    }

    // bubat data specialist
    public function create(array $data)
    {
        return Specialist::create($data);
    }


    /**
     * Mencari spesialis dan memperbarui datanya.
     *
     * @param int $id ID dari spesialis yang akan diperbarui
     * @param array $data Data yang akan diperbarui
     * @return \App\Models\Specialist
     */
    public function update(int $id, array $data)
    {
        $specialist = Specialist::findOrFail($id);
        $specialist->update($data);
        return $specialist;
    }

    // hapus data
    public function delete(int $id)
    {
        $specialist = Specialist::findOrFail($id);
        $specialist->delete();
    }
}