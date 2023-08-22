<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPasswordRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Imports\UsersImport;
use App\Models\Audit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use TCG\Voyager\Models\Role;

class UserController extends Controller
{
    public function getAuthenticatedUser()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $user =
                User::with([
                    'delegation' => function ($query) {
                        $query->select('delegations.id', 'delegations.name');
                    },
                    'municipality' => function ($query) {
                        $query->select('municipalities.id', 'municipalities.city_name', 'municipalities.profile_photo_path');
                    }
                ])
                ->where('id', $id)
                ->first();
            return $user;
        } else return null;
    }

    public function getUsersInput()
    {
        return
            User::selectRaw('id AS code, CONCAT(users.first_name, " ", users.second_name, " ", users.first_last_name, " ", users.second_last_name) AS label')
            ->where('delegation_id', Auth::user()->delegation_id)
            ->orderBy('id', 'ASC')
            ->simplePaginate(50);
    }

    public function getUsers(Request $request): \Illuminate\Http\JsonResponse
    {
        $day = date('Y-m-d', strtotime($request->dateFilter));
        $users =
            User::with([
                'delegation' => function ($query) {
                    $query->select('delegations.id', 'delegations.name');
                },
                'municipality' => function ($query) {
                    $query->select('municipalities.id', 'municipalities.city_name', 'municipalities.profile_photo_path');
                },
                'role' => function ($query) {
                    $query->select('roles.id', 'roles.name', 'roles.display_name');
                }
            ])
            ->where(function ($query) use ($request, $day) {
                if ($request->search) $query->search($request->search);
                if ($request->delegations_model) {
                    $delegation = json_decode($request->delegations_model);
                    $query->where('users.delegation_id', $delegation->code);
                }
                if ($request->dateFilter) $query->whereBetween('users.created_at', [$day . " 00:00:00", $day . " 23:59:59"]);
            })

            ->orderBy('users.first_name')
            ->simplePaginate(50);

        return response()->json(['users' => $users, 'role' => auth()->user()->role->name]);
    }

    public function getRoles()
    {
        return Role::select('id AS code', 'display_name AS label')
            ->orderBy('id', 'ASC')
            ->simplePaginate(50);
    }

    public function store(UserStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        try {

            // REGISTRO DE UN NUEVO USUARIO
            $user = new User($request->all());
            $user->first_name = mb_strtoupper($request->first_name);
            $user->second_name = mb_strtoupper($request->second_name);
            $user->first_last_name = mb_strtoupper($request->first_last_name);
            $user->second_last_name = mb_strtoupper($request->second_last_name);
            $user->password = Hash::make($request->personal_id);
            $user->position = mb_strtoupper($request->position);
            $user->active = $request->active == true ? 'ACTIVO' : 'INACTIVO';
            $user->delegation_id = $request->delegation['code']; // DELEGACIÓN DEL USUARIO
            $user->municipality_id = $request->municipality['code']; // MUNICIPIO DEL USUARIO
            $user->role_id = $request->role['code']; // ROL DEL USUARIO
            $user->save();

            // REGISTRO DE ACTIVIDAD
            Audit::create([
                'action' => 'CREACIÓN DE USUARIO CON CÉDULA: ' . $user->personal_id,
                'module' => 'USUARIOS',
                'user_id' => auth()->user()->id,
            ]);

            // RELACIONES DEL USUARIO
            $user->delegation;
            $user->municipality;
            $user->role;

            // RESPUESTA AL USUARIO
            return response()->json([
                'msg' => 'Se guardó con éxito',
                'icon' => 'success',
                'user' => $user,
                'new' => true
            ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }

    // PENDIENTE AJUSTAR LA IMPLEMENTACIÓN DEL ARGUE MASIVO
    public function importUsers(Request $request)
    {
        // VALIDACIÓN DEL ENVÍO DEL ARCHIVO
        if ($request->hasFile('file')) {

            // OBTENER EL ARCHIVO DE LA SOLICITUD
            $file = $request->file('file');

            // CONTROL DE EXCEPCIONES
            try {

                // REGISTRO DE ACTIVIDAD
                Audit::create([
                    'action' => 'CREACIÓN MASIVA DE USUARIOS',
                    'module' => 'USUARIOS',
                    'user_id' => auth()->user()->id,
                ]);

                // IMPORTACIÓN DE DATOS
                Excel::import(new UsersImport, $file);

                // RESPUESTA AL USUARIO
                return response()->json([
                    'msg' => 'Los datos se cargaron correctamente.',
                    'icon' => 'success',
                ]);
            } catch (\Exception $exception) {
                // REGISTRO DE LOGS
                Log::error($exception->getMessage());
                return response()->json(['message' => $exception->getMessage(), 'icon' => 'error'], 500);
            }
        } else {
            return response()->json(['message' => 'El archivo no puede ser procesado.', 'icon' => 'error']);
        }
    }

    public function update(UserUpdateRequest $request, User $user): \Illuminate\Http\JsonResponse
    {
        // CONTROL DE EXCEPCIONES
        try {

            // REGISTRO DE ACTIVIDAD
            Audit::create([
                'action' => 'ACTUALIZACIÓN (INICIAL) DEL FUNCINARIO: ' . $user->first_name . ' ' . $user->first_last_name . ' CON ID => ' . $user->id,
                'description' => $user,
                'module' => 'USUARIOS',
                'user_id' => auth()->user()->id,
            ]);

            // ACTUALIZACIÓN DE CAMPOS
            $user->update([
                'personal_id' => mb_strtoupper($request->personal_id),
                'first_name' => mb_strtoupper($request->first_name),
                'second_name' => mb_strtoupper($request->second_name),
                'first_last_name' => mb_strtoupper($request->first_last_name),
                'second_last_name' => mb_strtoupper($request->second_last_name),
                'position' => mb_strtoupper($request->position),
                'phone_number' => $request->phone_number,
                'active' => $request->active == true ? 'ACTIVO' : 'INACTIVO',
                'email' => $request->email == null ? null : mb_strtolower($request->email),
                'password' => Hash::make($request->personal_id),
                'delegation_id' => $request->delegation['code'], // DELEGACIÓN DEL FUNCIONARIO
                'municipality_id' => $request->municipality['code'], // DELEGACIÓN DEL FUNCIONARIO
                'role_id' => $request->role['code'], // ROL DEL FUNCIONARIO
            ]);

            // REGISTRO DE ACTIVIDAD
            Audit::create([
                'action' => 'ACTUALIZACIÓN (FINAL) DEL USUARIO: ' . $user->first_name . ' ' . $user->first_last_name . ' CON ID => ' . $user->id,
                'description' => $user,
                'module' => 'USUARIOS',
                'user_id' => auth()->user()->id,
            ]);

            // RELACIONES DEL USUARIO
            $user->delegation;
            $user->municipality;
            $user->role;

            // RESPUESTA AL USUARIO
            return response()->json([
                'msg' => 'Se actualizó con éxito',
                'icon' => 'success',
                'user' => $user,
                'new' => false
            ]);
        } catch (\Exception $exception) {
            // REGISTRO DE LOGS
            Log::error($exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }

    public function updatePassword(UserPasswordRequest $request)
    {
        try {
            $user = User::where('id', $request->user_id)->first();
            if ($user) {
                $user->password = Hash::make($request->password);
                $user->update();
                flash()->success('Se actualizó con éxito la contraseña.');
                return redirect()->back();
            } else {
                flash()->error('Está intentando cambiarle la contraseña a un usuario que <b>NO</b> existe.');
                return redirect()->back();
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            flash()->error($exception->getMessage());
            return redirect()->back();
        }
    }

    public function photoUpload(User $user, Request $request)
    {
        try {
            // Validación del campo que contiene el archivo a cargar
            if ($request->hasfile('profile_photo_path')) // $request es lo que llega en la petición
                if ($request->profile_photo_path !== 'null') {
                    if ($request->profile_photo_path === null) $this->photo($request, $user, false); // Si está nulo no hay nada que eliminar
                    else $this->photo($request, $user, true); // Si NO está nulo hay que eliminar
                }

            // REGISTRO DE LA ACTIVIDAD
            Audit::create([
                'action' => 'ACTUALIZACIÓN DE LA FOTO DE PERFIL DEL USUARIO: ' . $user->first_name . ' ' . $user->first_last_name . ' CON ID => ' . $user->id,
                'module' => 'USUARIOS',
                'user_id' => auth()->user()->id,
            ]);

            // ACTUALIZACIÓN DE LA FOTO
            $user->update();

            // ENVÍO DE RELACIONES AL FRONTEND
            $user->delegation;
            $user->municipality;
            $user->role;

            // RESPUESTA PARA EL CLIENTE
            return response()->json(['msg' => 'Se actualizó con éxito', 'icon' => 'success', 'user' => $user, 'new' => false]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }

    public function photo($request, $user, $delete): void
    {
        // Almacenado del archivo localmente
        $profile_photo_path = Storage::disk('users')->put('', $request->file('profile_photo_path'));

        // Eliminación del archivo que está en local
        if ($delete) Storage::disk('users')->delete($user->profile_photo_path);

        //Actualización del path para el documento y su posterior descarga
        $user->update(['profile_photo_path' => $profile_photo_path]);
    }

    public function searchUser(Request $request)
    {
        if ($request->ajax()) {
            $users = User::search($request->input('term'))
                ->where('name', '!=', 'admin')
                ->whereNotNull('delegation_id')
                ->orderBy('name')
                ->paginate(50);
            $dataJson = array();
            foreach ($users as $user) $dataJson['results'][] = ['id' => $user->id, 'text' => $user->first_name . ' ' . $user->last_name];
            $dataJson['pagination'] = ['more' => $users->hasMorePages()];
            return response()->json($dataJson);
        }
    }

    public function usersSelectPassword(Request $request)
    {
        // VALIDACIÓN DEL TIPO DEL MEDIO DE SOLICITUD
        if ($request->ajax()) {
            // CONSULTA A USUARIOS CON RELACIONES
            $users = User::with(['delegation'])
                // CONSULTA EN EL MODELO
                ->search($request->input('term'))
                // CONSULTA DONDE X ROL TENGA ESA CONSIDENCIA
                ->whereHas('role', function ($query) use ($request) {
                    if ($request->leader) $query->where('name', 'LIKE', '%admin%');
                })
                ->where(function ($query) use ($request) {
                    if ($request->user_id !== null) $query->where('id', $request->user_id);
                })
                // NO PUEDE TENER NULO EL CORREO
                ->whereNotNull('email')
                // NO PUEDE TENER NULA LA DELEGACIÓN
                ->whereNotNull('delegation_id')
                // ORDENAMIENTO POR PRIMER NOMBRE
                ->orderBy('first_name')
                // PÁGINADO DE 50 REGISTROS
                ->paginate(50);

            // dd($users);

            // CONTRUCCIÓN DE RESPUESTA
            $dataJson = array();
            foreach ($users as $user)
                $dataJson['results'][] = [
                    'id' => $user->id,
                    'text' => $user->first_name . ' ' . $user->first_last_name . ' - ' . $user->delegation->name
                ];
            $dataJson['pagination'] = ['more' => $users->hasMorePages()];

            // ENVIO DE RESPUESTA AL CLIENTE
            return response()->json($dataJson);
        }
    }
}
