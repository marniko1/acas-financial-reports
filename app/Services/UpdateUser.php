<?php

namespace AcasReports\Services;

use AcasReports\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UpdateUser
{
	public function execute(array $attributes, $id, bool $is_ajax = false)
	{

		$validator = Validator::make($attributes, [
			'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username,' . $id . ',id',
            'email' => 'required|email|max:255|unique:users,email,' . $id . ',id',
            'password' => 'required|min:5|max:255|confirmed',
        ]);
        unset($attributes['password_confirmation']);

        if ($validator->fails()) {

            if ($is_ajax) {
                return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
            }

            return redirect('/dashboard')
                        ->withErrors($validator)
                        ->withInput();
        }


        $old_password = User::where('id',$id)->pluck('password');

        if ($old_password != $attributes['password']) {
            $attributes['password'] = Hash::make($attributes['password']);
        }


		$user = User::where('id',$id)->update($attributes);

        if ($is_ajax) {
            return response()->json(['success'=>'User data updated.']);
        }
	}
}