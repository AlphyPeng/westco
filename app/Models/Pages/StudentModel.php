<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'contact_no',
        'membership_id',
        'program_name',
        'training_status',
        'start_of_training',
        'date_completed',
        'training_expiration'
    ];
}
