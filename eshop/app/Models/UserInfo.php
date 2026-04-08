<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'user_info';

    protected $fillable = [
        'first_name',
        'last_name',
        'email_address',
        'phone_number',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}