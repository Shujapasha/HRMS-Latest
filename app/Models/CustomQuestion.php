<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomQuestion extends Model
{
    protected $table = 'hrm_custom_questions';
    protected $fillable = [
        'question',
        'is_required',
        'created_by',
    ];

    public static $is_required = [
        'yes' => 'Yes',
        'no' => 'No',
    ];
}
