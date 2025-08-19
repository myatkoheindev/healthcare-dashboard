<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    //
    protected $fillable = [
        'medical_image',
        'ocr_text',
        'medical_entity',
    ];

    // protected $casts = [
    //     'medical_entity' => 'array',
    // ];
}
