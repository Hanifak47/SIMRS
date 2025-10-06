<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SpecialistService;
use App\Http\Requests\SpecialistRequest;
use App\Http\Resources\SpecialistResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SpecialistController extends Controller
{

    private $specialistService; // phpcs:ignore Zend.NamingConventions.ValidVariableName.PrivateNoUnderscore

    public function __construct(SpecialistService $specialistService)
    {
        $this->specialistService = $specialistService;
    }

    // method ini beri nama persis sperti dengan php artisan route:list
    public function index()
    {
        $fields = ['id', 'name', 'photo', 'price'];
        $specialist = $this->specialistService->getAll($fields);
        //    krn datanya banyak maka pakai collection
        return response()->json(SpecialistResource::collection($specialist));
    }

    public function show(int $id)
    {
        try {
            $specialist = $this->specialistService->getById($id);
            //    krn datanya tunggal maka hanya gunakan new
            return response()->json(new SpecialistService($specialist));
        } catch (ModelNotFoundException $e) {
            return response()->json([ // phpcs:ignore PEAR.Functions.FunctionCallSignature.ContentAfterOpenBracket
                'message' => 'Specialist tidak ditemukan'
            ], 404); // phpcs:ignore PEAR.Functions.FunctionCallSignature.CloseBracketLine
        }
    }


    // jgn lupa php artisan make:request SpecialistRequest
    // untuk validasi dari store ini maka lihat pada file specialistrequest
    public function store(SpecialistRequest $request)
    {
        // validasinya di specialistrequest
        $specialist = $this->specialistService->create($request->validated());
        // berhasil di create
        return response()->json(new SpecialistResource($specialist), 201);
    }


    // update ini juga divalidasi di request
    public function update(SpecialistRequest $request, int $id)
    {
        try {
            $specialist = $this->specialistService->update($id, $request->validated());
            return response()->json(new SpecialistResource($specialist));
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Specialist tidak ditemukan',
            ], 404);
        }
    }
}
