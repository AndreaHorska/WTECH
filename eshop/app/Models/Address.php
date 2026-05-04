<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'street',
        'house_number',
        'postal_code',
        'city',
        'state',
        'is_company',
        'company_name',
    ];

    public function userInfos()
    {
        return $this->belongsToMany(
            UserInfo::class,
            'address_user_info',
            'address_id',
            'user_info_id'
        );
    }
}
