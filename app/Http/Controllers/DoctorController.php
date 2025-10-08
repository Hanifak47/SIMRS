<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DoctorService;
use App\Http\Requests\DoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Http\Requests\SpecialistHospitalDoctorRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DoctorController extends Controller
{
    //
    private $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    public function index()
    {
        $fields = ['id', 'name', 'photo', 'yoe', 'specialist_id', 'hospital_id'];
        $doctor = $this->doctorService->getAll($fields);
        return response()->json(DoctorResource::collection($doctor));
    }

    public function show(int $id)
    {
        try {
            $doctor = $this->doctorService->getById($id);
            return response()->json(new DoctorResource($doctor));
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Dokter tidak ditemukan'], 404);
        }
    }

    public function store(DoctorRequest $request)
    {
        $doctor = $this->doctorService->create($request->validated());
        return response()->json(new DoctorResource($doctor), 201);
    }

    public function update(DoctorRequest $request, int $id)
    {
        try {
            $doctor = $this->doctorService->update($id, $request->validated());
            return response()->json(new DoctorResource($doctor));
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }
    }

    public function destroy(int $id)
    {

        // dd("saya tampan");

        try {
            $this->doctorService->delete($id);
            return response()->json(['message' => 'Doctor deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }
    }

    // contoh validasi langsung tanpa class request
    // public function filterBySpecialistAndHospital(Request $request)
    // {
    //     $validated = $request->validate([
    //         'hospital_id' => 'required|integer|exists:hospitals,id',
    //         'specialist_id' => 'required|integer|exists:specialists,id'
    //     ]);

    //     $doctors = $this->doctorService->filterBySpecialAndHospital(
    //         $validated['hospital_id'],
    //         $validated['specialist_id'],
    //     );

    //     return DoctorResource::collection($doctors);
    // }


    public function filterBySpecialistAndHospital(SpecialistHospitalDoctorRequest $request)
    {
        $validated = $request->validated();

        $doctors = $this->doctorService->filterBySpecialAndHospital(
            $validated['hospital_id'],
            $validated['specialist_id'],
        );

        return DoctorResource::collection($doctors);
    }

    public function availableSlots(int $doctorId)
    {
        try {
            $availability = $this->doctorService->getAvailableSlots($doctorId);
            // jika datanya tida pure tabel maka bungkus sperti ini
            return response()->json(['data' => $availability]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }
    }

}
