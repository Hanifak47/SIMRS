<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\BookingTransaction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BookingTransactionController extends Controller
{
    //
    private $bookingTransactionService;

    public function __construct(BookingTransaction $bookingTransactionService)
    {
        $this->bookingTransactionService = $bookingTransactionService;
    }

    public function index()
    {
        // $transaction = $this->bookingTransactionService->
        $transaction = $this->bookingTransactionService->getAll();
        return response()->json(TransactionResource::collection($transaction));
    }

    public function show(int $id)
    {
        try {
            $transaction = $this->bookingTransactionService->getByIdForManager($id);
            return response()->json(new TransactionResource($transaction));
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }
    }

    public function updateStatus(Request $request, int $id)
    {
        // Validasi data request
        $validated = $request->validate([ // phpcs:ignore PEAR.Functions.FunctionCallSignature.ContentAfterOpenBracket
            'status' => 'required|in:Approved,Rejected',
        ]);

        try {
            // Panggil service untuk mengupdate status transaksi
            $transaction = $this->bookingTransactionService->updateStatus($id, $validated['status']);

            // Kembalikan respons sukses
            return response()->json([ // phpcs:ignore PEAR.Functions.FunctionCallSignature.ContentAfterOpenBracket
                'message' => 'Status transaksi sudah diperbarui',
                'data' => new TransactionResource($transaction),
            ]);
        } catch (ModelNotFoundException $e) {
            // Tangkap jika transaksi tidak ditemukan
            return response()->json(['message' => 'Transaction not found'], 404);
        }
    }

}
