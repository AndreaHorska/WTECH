<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'user_info_id',
        'street',
        'house_number',
        'postal_code',
        'city',
        'state',
        'is_company',
        'company_name',
    ];

    public function userInfo()
    {
        return $this->belongsTo(UserInfo::class);
    }

}
