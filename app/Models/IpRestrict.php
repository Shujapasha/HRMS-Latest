<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpRestrict extends Model
{
 
    protected $table = 'hrm_ip_restricts';
    protected $fillable = [
        'ip',
        'created_by',
    ];
}
