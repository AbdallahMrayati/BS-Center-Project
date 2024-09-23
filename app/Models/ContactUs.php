<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    protected $table = 'contact_forms';
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        'full_name',
        'country',
        'email',
        'phone_number',
        'company',
        'subject',
        'message'
    ];
}
