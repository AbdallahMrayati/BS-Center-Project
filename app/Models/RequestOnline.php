<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestOnline extends Model
{
    protected $table = 'request_online';
    use HasFactory;

    protected $fillable = [
        'course_id',
        'category_id',
        'full_name',
        'email',
        'phone_number',
        'position',
        'company_name',
        'subject',
        'location',
        'date',
        'message'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
