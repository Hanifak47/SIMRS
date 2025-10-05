<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HospitalService;
use App\Http\Requests\HospitalRequest;
use App\Http\Resources\HospitalResource;
use App\Http\Resources\SpecialistResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HospitalController extends Controller
{
    //
    private $hospitalServices; // phpcs:ignore Zend.NamingConventions.ValidVariableName.PrivateNoUnderscore

    public function __construct(HospitalService $hospitalService)
    {
        $this->hospitalServices = $hospitalService;
    }

    public function index()
    {
        $fields = ['id', 'name', 'city', 'photo', 'phone'];
        $hospitals = $this->hospitalServices->getAll($fields);
        return response()->json(SpecialistResource::collection($hospitals));
    }

    public function show(int $id)
    {
        try {
            $hospital = $this->hospitalServices->getById($id);
            return response()->json(new HospitalResource($hospital));
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Data rumah sakit tidak ada'
            ], 404);
        }
    }

    public function store(HospitalRequest $request)
    {
        $hospital = $this->hospitalServices->create($request->validate());

        return response()->josn(new HospitalResource($hospital));
    }
}
