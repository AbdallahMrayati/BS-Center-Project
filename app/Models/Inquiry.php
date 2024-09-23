<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inquiry extends Model
{
    protected $table = 'inquiry_forms';
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'course_id',
        'full_name',
        'email',
        'phone_number',
        'company',
        'city',
        'message'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
