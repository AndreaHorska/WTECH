<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\UserInfo;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

        $userInfo = $user->userInfo;
        $address = $userInfo?->addresses()->first();

        return view('user-account', compact('userInfo', 'address'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email_address' => ['required', 'email:rfc', 'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'street' => ['required', 'string', 'max:50'],
            'house_number' => ['required', 'string', 'max:10'],
            'city' => ['required', 'string', 'max:40'],
            'postal_code' => ['required', 'string', 'max:10'],
            'state' => ['required', 'string', 'max:40'],
        ]);

        $user = auth()->user();

        $userInfo = $user->userInfo;

        if (!$userInfo) {
            $userInfo = UserInfo::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone_number' => $data['phone_number'],
                'email_address' => $data['email_address'],
            ]);

            $user->update([
                'user_info_id' => $userInfo->id,
            ]);
        } else {
            $userInfo->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone_number' => $data['phone_number'],
                'email_address' => $data['email_address'],
            ]);
        }

        $addressData = [
            'street' => $data['street'],
            'house_number' => $data['house_number'],
            'city' => $data['city'],
            'postal_code' => $data['postal_code'],
            'state' => $data['state'],
        ];

        $address = $userInfo->addresses()->first();

        if ($address) {
            $address->update($addressData);
        } else {
            $address = Address::create($addressData);

            $userInfo->addresses()->attach($address->id);
        }

        return back()->with('success', 'Changes saved.');
    }
}
