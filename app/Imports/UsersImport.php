<?php

namespace App\Imports;

use App\Models\Delegation;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Validators\ValidationException;

class UsersImport implements ToCollection, WithStartRow
{
    /**
     * @param array $rows
     *
     */
    public function collection(Collection $rows)
    {
        // SE INICIA UN BLOQUE TRY CATCH PARA MANEJAR LAS EXCEPCIONES
        try {

            // SE ITERAN TODAS LAS FILAS DE LA COLECCIÓN
            foreach ($rows as $row) {

                // BÚSQUEDA DEL FUNCIONARIO(A) POR CÉDULA
                $user = User::where('personal_id', $row[0])->first();

                // CASO QUE NO EXISTA
                if ($user == null) {
                    $newUser = new User();
                    $newUser->personal_id = $row[0]; // CÉDULA
                    $newUser->first_name = mb_strtoupper($row[1]); // PRIMER NOMBRE
                    $newUser->second_name = mb_strtoupper($row[2]);  // SEGUNDO NOMBRE
                    $newUser->first_last_name = mb_strtoupper($row[3]); // PRIMER APELLIDO
                    $newUser->second_last_name = mb_strtoupper($row[4]); // SEGUNDO APELLIDO
                    $newUser->email = $row[5]; // CORREO ELECTRÓNICO
                    $newUser->phone_number = $row[6]; // NÚMERO DE TELÉFONO
                    $newUser->delegation_id = Delegation::where('name', $row[7])->pluck('id')->first(); // DELEGACIÓN DEL FUNCIONARIO(A)
                    $newUser->position = mb_strtoupper($row[8]); // CARGO
                    $newUser->active = mb_strtoupper($row[9]); // ESTADO
                    $newUser->password = Hash::make($row[0]); // CONTRASEÑA
                    $newUser->role_id = 2; // ROL DEL FUNCIONARIO(A)
                    $newUser->save();
                }

                // EN CASO QUE SI EXISTA
                else {

                    // ACTUALIZACIÓN DE CAMPOS
                    $user->update([
                        'personal_id' => $row[0], // CÉDULA
                        'first_name' => mb_strtoupper($row[1]), // PRIMER NOMBRE
                        'second_name' => mb_strtoupper($row[2]), // SEGUNDO NOMBRE
                        'first_last_name' => mb_strtoupper($row[3]), // PRIMER APELLIDO
                        'second_last_name' => mb_strtoupper($row[4]), // SEGUNDO APELLIDO
                        'email' => $row[5] == null ? null : mb_strtolower($row[5]), // CORREO ELECTRÓNICO
                        'phone_number' => $row[6], // NÚMERO DE TELÉFONO
                        'delegation_id' => Delegation::where('name', $row[7])->pluck('id')->first(), // DELEGACIÓN DEL FUNCIONARIO(A)
                        'position' => mb_strtoupper($row[8]), // CARGO
                        'active' => mb_strtoupper($row[9]), // ESTADO
                        'password' => Hash::make($row[0]), // CONTRASEÑA
                        'role_id' => 2, // ROL DEL FUNCIONARIO(A)
                    ]);
                }
            }


            // RESPUESTA PARA EL USUARIO
            return response()->json([
                'msg' => 'Los datos se cargaron correctamente.',
                'icon' => 'success',
            ]);

        } catch (ValidationException $exception) {

            // CAPTURA LAS FALLAS DE LA EXCEPCIÓN
            $failures = $exception->failures();

            // INICIALIZA UN ARRAY VACÍO PARA ALMACENAR LOS MENSAJES DE ERROR
            $errorMessages = [];
            foreach ($failures as $failure) {
                // OBTIENES LA COLUMNA QUE FALLÓ
                $attribute = $failure->attribute();
                // OBTIENES LOS MENSAJES DE ERROR
                $errors = $failure->errors();
                // ALMACENA LOS MENSAJES DE ERROR EN EL ARRAY CON LA COLUMNA COMO CLAVE
                $errorMessages[$attribute] = $errors;
            }

            // REGISTRO DE LOGS
            Log::error($exception->getMessage());

            // RESPUESTA AL USUARIO
            return response()->json([
                'msg' => $exception->getMessage(),
                'icon' => 'error',
                'errors' => $errorMessages
            ], 422);
        } catch (\Exception $exception) {

            // REGISTRO DE LOGS
            Log::error($exception->getMessage());

            // RESPUESTA AL USUARIO
            return response()->json([
                'msg' => $exception->getMessage(),
                'icon' => 'error'
            ], 500);
        }
    }

    // FUNCIÓN PARA NO TENER EN CUENTA LOS ENCABEZADOS
    public function startRow(): int
    {
        return 2;
    }
}
