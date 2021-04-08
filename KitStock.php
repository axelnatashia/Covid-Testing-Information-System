<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KitStock extends Model
{
    protected $fillable = [
        'code',
        'name',
        'stock'
    ];

    public function patient_test() {
        return $this->hasMany('App\PatientTest');
    }
}
