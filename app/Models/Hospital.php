<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
    //

    use SoftDeletes;

    protected $fillable = [
        'name',
        'photo',
        'about',
        'address',
        'city',
        'post_code',
        'phone',
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }


    // mengingat hosptal dan specialist menggunakan pivot table karena memang relasinya many to many
    //  maka untuk mengakses banyak specialist dari hospital diperlukan relasi ini
    public function specialists()
    {
        return $this->belongsToMany(Specialist::class, 'hospital_specialists');
    }

    public function getPhotoAttribute($value)
    {
        if (!$value) {
            return null; // No image available
        }

        return url(Storage::url($value));
    }
}
