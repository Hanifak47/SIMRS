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
            return response()->json([ // phpcs:ignore PEAR.Functions.FunctionCallSignature.ContentAfterOpenBracket
                'message' => 'Data rumah sakit tidak ada'
            ], 404); // phpcs:ignore PEAR.Functions.FunctionCallSignature.CloseBracketLine
        }
    }

    public function store(HospitalRequest $request)
    {
        $hospital = $this->hospitalServices->create($request->validated());

        return response()->json(new HospitalResource($hospital));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HospitalRequest $request, int $id)
    {
        try {
            // Menggunakan validated() untuk data yang sudah teruji
            $hospital = $this->hospitalServices->update($id, $request->validated());
            return response()->json(new HospitalResource($hospital));
        } catch (ModelNotFoundException $e) {
            return response()->json([ // phpcs:ignore PEAR.Functions.FunctionCallSignature.ContentAfterOpenBracket
                'message' => 'Rumah sakit tidak ditemukan',
            ], 404); // phpcs:ignore PEAR.Functions.FunctionCallSignature.CloseBracketLine
        }
    }

    /**
     * Remove the specified resource from storage (Soft/Hard Delete).
     */
    public function destroy(int $id)
    {
        try {
            $this->hospitalServices->delete($id);
            return response()->json([ // phpcs:ignore PEAR.Functions.FunctionCallSignature.ContentAfterOpenBracket
                'message' => 'Data rumah sakit berhasil dihapus'
            ]); // Status default 200 OK
        } catch (ModelNotFoundException $e) {
            return response()->json([ // phpcs:ignore PEAR.Functions.FunctionCallSignature.ContentAfterOpenBracket
                'message' => 'data rumah sakit tidak ditemukan',
            ], 404); // phpcs:ignore PEAR.Functions.FunctionCallSignature.CloseBracketLine
        }
    }
}
