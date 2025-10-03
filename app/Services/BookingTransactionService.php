<?php // phpcs:ignore Generic.Files.LineEndings.InvalidEOLChar

namespace App\Services;

use Illuminate\Http\UploadedFile;
use App\Models\BookingTransaction;
use App\Repositories\DoctorRepository;
use Dotenv\Exception\ValidationException;
use App\Repositories\BookingTransactionRepository;

class BookingTransactionService
{
    // dependency injectonnya
    private $bookingTransactionRepository; // phpcs:ignore Zend.NamingConventions.ValidVariableName.PrivateNoUnderscore
    private $doctorRepository; // phpcs:ignore Zend.NamingConventions.ValidVariableName.PrivateNoUnderscore

    public function __construct(
        BookingTransaction $bookingTransaction,
        DoctorRepository $doctorRepository
    ) { // phpcs:ignore Generic.Functions.OpeningFunctionBraceBsdAllman.BraceOnSameLine
        $this->bookingTransactionRepository = $bookingTransaction;
        $this->doctorRepository = $doctorRepository;
    }

    // manager services
    public function getAll()
    {
        return $this->bookingTransactionRepository->getAll();
    }

    public function getByIdForManager(int $id)
    {
        return $this->bookingTransactionRepository->getByIdForManager($id);
    }

    public function updateStatus(int $id, string $status)
    {
        if (!in_array($status, ['Approved', 'Rejected'])) {
            throw ValidationException::withMessages([
                'status' => ['Invalid status value.']
            ]);
        }

        return $this->bookingTransactionRepository->updateStatus($id, $status);
    }

    // customer services
    public function getAllForUser(int $userId)
    {
        return $this->bookingTransactionRepository->getAllForUser($userId);
    }

    public function getById(int $id, int $userId)
    {
        return $this->bookingTransactionRepository->getById($id, $userId);
    }

    public function create(array $data)
    {
        $data['user_id'] = auth()->id();

        // jika sudah di booking maka tidak bisa
        if ($this->bookingTransactionRepository->isTimeSlotTakenForDoctor($data['doctor_id'], $data['started_at'], $data['time_at'])) {
            throw ValidationException::withMessages([
                'time_at' => ['Waktu yang dipilih untuk dokter ini sudah terisi.']
            ]);
        }

        $doctor = $this->doctorRepository->getById($data['doctor_id']);

        $price = $doctor->specialist->price;
        // pajak
        $tax = (int) round($price * 0.11);
        $grand = $price + $tax;

        $data['sub_total'] = $price;
        $data['tax_total'] = $tax;
        // harga akhir perpaduan antara pajak degnan harga
        $data['grand_total'] = $grand;
        $data['status'] = 'Waiting';

        if (isset($data['proof']) && $data['proof'] instanceof UploadedFile) {
            $data['proof'] = $this->uploadProof($data['proof']);
        }
    }

    private function uploadProof(UploadedFile $file)
    {
        return $file->store('proofs', 'public');
    }

}