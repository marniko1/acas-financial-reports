<?php

namespace AcasReports\Services;

use AcasReports\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AddUser
{
	public function execute(array $attributes, bool $is_ajax = false)
	{


		$validator = Validator::make($attributes, [
			'name' => 'required|max:255',
            'username' => 'required|unique:users,username|max:255',
            'email' => 'required|unique:users,email|email|max:255',
            'password' => 'required|min:5|max:255|confirmed',
        ]);

        if ($validator->fails()) {

            if ($is_ajax) {
                return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
            }

            return redirect('/dashboard')
                        ->withErrors($validator)
                        ->withInput();
        }


        $attributes['password'] = Hash::make($attributes['password']);

		$user = User::create($attributes);

        if ($is_ajax) {
            return response()->json(['success'=>'New user has been added.']);
        }
	}
}