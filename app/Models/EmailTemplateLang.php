<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplateLang extends Model
{
    protected $table = 'hrm_email_template_langs';
    protected $fillable = [
        'parent_id',
        'lang',
        'subject',
        'content',
    ];
}
