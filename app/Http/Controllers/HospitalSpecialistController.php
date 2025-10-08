<?php

namespace App\Http\Controllers;

use App\Services\HospitalService;
use Illuminate\Http\Request;

class HospitalSpecialistController extends Controller
{
    //
    private $hospitalService;

    public function __construct(HospitalService $hospitalService)
    {
        $this->hospitalService = $hospitalService;
    }

    // fungsi menambahkan spesialis untuk rumah sakit
    public function attach(Request $request, int $hospitalId)
    {
        $request->validate([
            'specialist_id' => 'required|exists:specialists,id'
        ]);

        $this->hospitalService->attachSpecialist($hospitalId, $request->input('specialist_id'));

        return response()->json(['message' => 'Specialist berhasil dihubungkan']);
    }


    public function detach(int $hospitalId, int $specialistId){
        $this->hospitalService->detachSpecialist($hospitalId, $specialistId);
        return response()->json(['message' => 'Specialist berhasil dilepas']);
    }

}
