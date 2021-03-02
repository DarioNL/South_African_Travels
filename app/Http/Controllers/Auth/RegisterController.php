<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            'house_number' => 'required',
            'phone' => 'required',
            'password' => ['required', 'confirmed'],
            'email' => [
                Rule::unique('users', 'email'),
                Rule::unique('admins', 'email')
            ],
        ]);

        User::create([
            'first_name' => $request->post('first_name'),
            'last_name' => $request->post('last_name'),
            'address' => $request->post('address'),
            'house_number' => $request->post('house_number'),
            'city' => $request->post('city'),
            'zipcode' => $request->post('zipcode'),
            'phone' => $request->post('phone'),
            'email' => $request->post('email'),
            'password' => bcrypt($request->post('password')),
        ]);

        $usr = Auth::guard('web')->attempt(['email' => $request->post('email'), 'password' => $request->post('password')]);
        if ($usr) {
            $user = Auth::guard()->user();
            $user->last_login = date('Y-m-d H:i:s');
            $user->save();
            return redirect()->to('/');
        }
    }

}
