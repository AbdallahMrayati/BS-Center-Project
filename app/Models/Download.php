<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Download extends Model
{
    protected $table = 'downloads';

    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'phone', 'company_name', 'course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
