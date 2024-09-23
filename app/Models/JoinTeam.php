<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JoinTeam extends Model
{
    protected $table = 'join_team';
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'cv',
        'speciality',
        'country'
    ];
}
