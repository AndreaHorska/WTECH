<?php

namespace App\Http\Controllers;

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
            'first_name' => ['nullable', 'string', 'max:50'],
            'last_name' => ['nullable', 'string', 'max:50'],
            'email_address' => ['nullable', 'email', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'street' => ['nullable', 'string', 'max:50'],
            'house_number' => ['nullable', 'string', 'max:10'],
            'city' => ['nullable', 'string', 'max:40'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'state' => ['nullable', 'string', 'max:40'],
        ]);

        $user = auth()->user();
        
        $userInfo = $user->userInfo ?: new UserInfo();
        $userInfo->fill(collect($data)->only(['first_name', 'last_name', 'phone_number', 'email_address'])->toArray());
        $userInfo->save();

        if (!$user->user_info_id) {
            $user->update(['user_info_id' => $userInfo->id]);
        }

        $addressFields = ['street', 'house_number', 'city', 'postal_code', 'state'];
        $addressData = collect($data)->only($addressFields)->toArray();

        if (!empty($addressData)) {
            $address = $userInfo->addresses()->first();

            if ($address) {
                $address->update($addressData);
            } else {
                $newAddress = Address::create($addressData);
                $userInfo->addresses()->attach($newAddress->id);
            }
        }

        return back()->with('success', 'Changes saved.');
    }
}
