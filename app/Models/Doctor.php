<?php

namespace App\Models;

use App\Models\Hospital;
use App\Models\Specialist;
use App\Models\BookingTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'name',
        'photo',
        'about',
        'yoe',
        'specialist_id',
        'hospital_id',
        'gender'
    ];

    public function hospital()
    {
       return $this->belongsTo(Hospital::class);
    }

    public function specialist()
    {
       return $this->belongsTo(Specialist::class);
    }

    public function bookingTransactions()
    {
       return $this->hasMany(BookingTransaction::class);
    }

    public function getPhotoAttribute($value)
    {
        if (!$value) {
            return null;
        }

        return url(Storage::url($value));
    }

}
