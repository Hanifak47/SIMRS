<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingTransaction;
use Illuminate\Container\Attributes\Auth;
use App\Http\Resources\TransactionResource;
use App\Services\BookingTransactionService;
use App\Http\Requests\BookingTransactionRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
// ini dari sudut pandang USER SAAT MEMEsan jadwal konsultasi dokter
class MyOrderController extends Controller
{
    //

    private $bookingTransactionService;

    public function __construct(BookingTransactionService $bookingTransactionService)
    {
        $this->bookingTransactionService = $bookingTransactionService;
    }

    public function index()
    {

        // $user = Auth::user();
        // $userId = $user->id;
        $order = $this->bookingTransactionService->getAllForUser(auth()->id);
        return response()->json(TransactionResource::collection($order));
    }

    public function show(int $id)
    {
        try {
            $order = $this->bookingTransactionService->getById($id, auth()->id);
            return response()->json(new TransactionResource($order));
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Pesanan tidak ditemukan'], 404);
        }
    }

    public function store(BookingTransactionRequest $request)
    {
        $transaction = $this->service->create($request->validated());
        return response()->json(new TransactionResource($transaction), 201);
    }



}
