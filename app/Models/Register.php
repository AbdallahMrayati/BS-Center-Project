<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Register extends Model
{
    protected $table = 'registration_forms';
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'timing_id',
        'full_name',
        'email',
        'phone_number',
        'position',
        'company_name',
        'city',
        'address',
        'instructor_name',
        'instructor_email',
        'instructor_phone_number',
        'instructor_position'
    ];

    public function timing()
    {
        return $this->belongsTo(Timing::class, 'timing_id', 'id');
    }
}
