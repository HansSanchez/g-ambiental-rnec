<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use TCG\Voyager\Models\Role;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'second_name' => ['string', 'max:255'],
            'first_last_name' => ['required', 'string', 'max:255'],
            'second_last_name' => ['string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // CREACIÓN DEL FUNCIONARIO(A)
        $user = new User();
        $user->first_name = strtoupper($data["first_name"]);
        $user->second_name = strtoupper($data["second_name"]);
        $user->first_last_name = strtoupper($data["first_last_name"]);
        $user->second_last_name = strtoupper($data["second_last_name"]);
        $user->email = strtolower($data["email"]);
        $user->password = Hash::make($data["password"]);
        $user->role_id = 2; // USUARIO POR DEFECRO
        $user->save();

        // REGISTRO DE LA ACCIÓN HECHA
        Audit::create([
            'action' => 'CREACIÓN DE USUARIO',
            'module' => 'REGISTRO',
            'user_id' => $user->id,
        ]);

        // RELACIÓN CON EL ROL
        $user->role;

        // RETORNO DEL FUNCIONARIO(A) CREADO
        return $user;

    }

    public function showRegistrationForm()
    {
        return view("auth/register");
    }
}
