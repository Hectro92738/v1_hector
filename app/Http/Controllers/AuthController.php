<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\XxhrEstructuraUteq;
use App\Models\Mando;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('modal-email');
        $password = $request->input('modal-password');

        $user = XxhrEstructuraUteq::where('EMAIL', $email)
            ->where('ESTATUS', 'A')
            ->first();

        if ($user) {
            $token = Str::random(40);
            if ($user->PASSWORD == '0') {
                // El empleado debe cambiar su contraseña
                if ($password == $user->EMP_NUM) {
                    // El empleado inicia sesión con EMP_NUM
                    Auth::login($user); // Autentica al usuario
                    return response()->json([
                        'success' => true,
                        'token' => $token,
                        'email' => $user->EMAIL,
                        'name' => 'Bienvenid(@) ' . $user->EMP_NAME,
                        'numEmp' => $user->EMP_NUM,
                        'changePassword' => true,
                    ]);
                }
            } else {
                // El empleado ya ha cambiado su contraseña
                if (Hash::check($password, $user->PASSWORD)) {
                    // El empleado inicia sesión con PASSWORD
                    Auth::login($user); // Autentica al usuario
                    return response()->json([
                        'success' => true,
                        'token' => $token,
                        'email' => $user->EMAIL,
                        'name' => 'Bienvenid(@) ' . $user->EMP_NAME,
                        'numEmp' => $user->EMP_NUM,
                        'changePassword' => false, // Indicar que no es necesario cambiar la contraseña
                    ]);
                }
            }
        }
        return response()->json([
            'success' => false,
            'msj'    => 'Datos Incorrectos',
        ]);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function eupdatePassword(Request $request)
    {
        // Validar los datos recibidos
        $email = $request->input('correo');
        $password = $request->input('password');

        // Buscar el usuario por su correo
        $user = XxhrEstructuraUteq::where('EMAIL', $email)->first();

        // Si no se encuentra el usuario, retornar un error
        if (!$user) {
            return response()->json([
                'status' => 400,
                'msj'    => 'Email no existe',
            ]);
        }
        // Generar el hash de la nueva contraseña
        $hashedPassword = Hash::make($password);
        // Actualizar la contraseña del usuario con el hash generado
        $user->password = $hashedPassword;
        $user->save();
        return response()->json([
            'status' => 200,
            'msj'    => 'Tu contraseña a sido actualizada correctamente',
        ]);
    }
    public function eupdatePasswordSecion(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------

            // Validar los datos recibidos
            $email = $request->input('correo');
            $password = $request->input('password');

            // Buscar el usuario por su correo
            $user = XxhrEstructuraUteq::where('EMAIL', $email)->first();

            // Si no se encuentra el usuario, retornar un error
            if (!$user) {
                return response()->json([
                    'status' => 400,
                    'msj'    => 'Email no existe',
                ]);
            }
            // Generar el hash de la nueva contraseña
            $hashedPassword = Hash::make($password);
            // Actualizar la contraseña del usuario con el hash generado
            $user->password = $hashedPassword;
            $user->save();
            return response()->json([
                'status' => 200,
                'msj'    => 'Tu contraseña ha sido generada con exíto, ahora ya puedes inisiar sesión con ella',
            ]);
            //--------------------------------------------------------
        } else {
            return response()->json([
                'status' => 700,
                'msj'    => 'Sesión invalida',
            ]);
        }
    }
    public function getName(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            // Validar los datos recibidos
            $email = $request->input('correo');

            // Buscar el usuario por su correo
            $user = XxhrEstructuraUteq::where('EMAIL', $email)->first();

            // Si no se encuentra el usuario, retornar un error
            if (!$user) {
                return response()->json([
                    'status' => 400,
                    'msj'    => 'Email no existe',
                ]);
            }
            return response()->json([
                'status' => 200,
                'nombre' => $user->EMP_NAME,
            ]);         //--------------------------------------------------------
        } else {
            return response()->json([
                'status' => 700,
                'msj'    => 'Sesión invalida',
            ]);
        }
    }
    public function verificaEmailExiste(Request $request)
    {
        // Validar los datos recibidos
        $email = $request->input('email');

        // Buscar el usuario por su correo
        $user = XxhrEstructuraUteq::where('EMAIL', $email)->first();

        // Si no se encuentra el Email, retornar un error
        if (!$user) {
            return response()->json([
                'status' => 400,
                'msj'    => 'El correo no existe',
            ]);
        }
        return response()->json([
            'status' => 200,
            'msj'    => 'URL eviado',
        ]);         //--------------------------------------------------------

    }
    public function get_Menu(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;

        if ($storedToken && $token === $storedToken) {
            $numEmp = $request->input('numEmp');

            // Buscar el usuario por EMP_NUM
            $user = XxhrEstructuraUteq::where('EMP_NUM', $numEmp)->first();

            if ($user) {
                $POS_TIPO_DESC = $user->POS_TIPO_DESC;
                $NOM_NAME_1 = $user->NOM_NAME_1;

                return response()->json([
                    'status' => 200,
                    'POS_TIPO_DESC' => $POS_TIPO_DESC,
                    'NOM_NAME_1' => $NOM_NAME_1,
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'msj' => 'Usuario no encontrado - menu',
                ]);
            }
        } else {
            return response()->json([
                'status' => 700,
                'msj' => 'Sesión inválida',
            ]);
        }
    }
    public function informacionpersonal(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            $numEmp = $request->input('numEmp');
            /*SUBSTRING JOB NAME*/
            $obj = XxhrEstructuraUteq::where('EMP_NUM', $numEmp)->value('JOB_NAME');
            $jobName=substr($obj,strpos($obj,'.')+1);
            // Buscar el usuario por EMP_NUM
            $user = XxhrEstructuraUteq::where('EMP_NUM', $numEmp)->first();

            if ($user) {
                $POS_NAME = $user->POS_NAME;
                $EMP_NAME = $user->EMP_NAME;
                $EMAIL = $user->EMAIL;
                $EMP_CURP = $user->EMP_CURP;
                $EMP_IMSS = $user->EMP_IMSS;
                $EMP_BIRTHDATE = $user->EMP_BIRTHDATE;
                $ESTATUS= $user->ESTATUS;
                $POS_TIPO_DESC = $user->POS_TIPO_DESC;
                $NOM_NAME_1 = $user->NOM_NAME_1;
                $DIRE = $user->DIRE;
                $DEPT = $user->DEPT;
                $ORGANIZACION = $user->ORGANIZACION;
                $POS_STATUS= $user->POS_STATUS;
                $JOB_NAME = $user->JOB_NAME;
                $NOM_ID_1 = $user->NOM_ID_1;
                $POS_REF = $user->POS_REF;
                $CATE_FED_ORIGINAL = $user->CATE_FED_ORIGINAL;
                $CAT_FED = $user->CAT_FED;
                $SDO_FED= $user->SDO_FED;
                $GPO_FED = $user->GPO_FED;
                $HRS_FED = $user->HRS_FED;
                $EMP_RFC = $user->EMP_RFC;
                $EMP_SEX = $user->EMP_SEX;
                $EMP_AGE = $user->EMP_AGE;
                $EMP_PRI_CON= $user->EMP_PRI_CON;
                $EMP_ACT_CON= $user->EMP_ACT_CON;
                $ASG_INI = $user->ASG_INI;
                $ASG_FIN = $user->ASG_FIN;
                $ASG_NUM = $user->ASG_NUM;
                $ASG_SIN = $user->ASG_SIN;
                $SINDICALIZADO_N_S = $user->SINDICALIZADO_N_S;
                $TIPO_CONTRATO= $user->TIPO_CONTRATO;
                $ASG_SDO = $user->ASG_SDO;
                $ASG_SDO_FEC = $user->ASG_SDO_FEC;
                $ASG_HOR = $user->ASG_HOR;
                $BASE_NAME_1 = $user->BASE_NAME_1;
                $ASG_REF = $user->ASG_REF;
                $QUINQUENIO = $user->QUINQUENIO;
                $MARITAL_ESTATUS = $user->MARITAL_ESTATUS;
                $ESTATUS = $user->ESTATUS;

                

                return response()->json([
                    'status' => 200,
                    'POS_NAME' => $POS_NAME,
                    'EMP_NAME' => $EMP_NAME,
                    'EMAIL' => $EMAIL,
                    'EMP_CURP' => $EMP_CURP,
                    'EMP_IMSS' => $EMP_IMSS,
                    'EMP_BIRTHDATE' => $EMP_BIRTHDATE,
                    'EMP_BIRTHDATE' => $user->EMP_BIRTHDATE,
                    'ESTATUS'=> $user->ESTATUS,
                    'POS_TIPO_DESC' => $user->POS_TIPO_DESC,
                    'NOM_NAME_1' => $user->NOM_NAME_1,
                    'DIRE' => $user->DIRE,
                    'DEPT' => $user->DEPT,
                    'ORGANIZACION' => $user->ORGANIZACION,
                    'POS_STATUS'=> $user->POS_STATUS,
                    'JOB_NAME'=> $user->JOB_NAME,
                    'NOM_ID_1' => $user->NOM_ID_1,
                    'POS_REF' => $user->POS_REF,
                    'CATE_FED_ORIGINAL' => $user->CATE_FED_ORIGINAL,
                    'CAT_FED' => $user->CAT_FED,
                    'SDO_FED'=> $user->SDO_FED,
                    'GPO_FED' => $user->GPO_FED,
                    'HRS_FED' => $user->HRS_FED,
                    'EMP_RFC' => $user->EMP_RFC,
                    'EMP_SEX'=> $user->EMP_SEX,
                    'EMP_AGE' => $user->EMP_AGE,
                    'EMP_PRI_CON'=> $user->EMP_PRI_CON,
                    'ASG_INI' => $user->ASG_INI,
                    'ASG_FIN' => $user->ASG_FIN,
                    'ASG_NUM' => $user->ASG_NUM,
                    'ASG_SIN' => $user->ASG_SIN,
                    'SINDICALIZADO_N_S' => $user->SINDICALIZADO_N_S,
                    'TIPO_CONTRATO'=> $user->TIPO_CONTRATO,
                    'ASG_SDO' => $user->ASG_SDO,
                    'ASG_SDO_FEC' => $user->ASG_SDO_FEC,
                    'ASG_HOR' => $user->ASG_HOR,
                    'BASE_NAME_1' => $user->BASE_NAME_1,
                    'ASG_REF' => $user->ASG_REF,
                    'QUINQUENIO' => $user->QUINQUENIO,
                    'MARITAL_ESTATUS' => $user->MARITAL_ESTATUS,
                    'ESTATUS' => $user->ESTATUS,
                    'JOBNAME'=>$jobName,
                    'EMP_ACT_CON'=>$EMP_ACT_CON,

                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'msj' => 'Usuario no encontrado - menu',
                ]);
            }
            //--------------------------------------------------------
        } else {
            return response()->json([
                'status' => 700,
                'msj' => 'Sesión inválida',
            ]);
        }
    }
    public function getAll_Empleados(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            $jobNamePrefixes = ["A05", "B05", "C05", "C10", "D05", "E05", "E10", "C15"];

            $empleadosFiltrados = XxhrEstructuraUteq::where(
                function ($query) use ($jobNamePrefixes) {
                    foreach ($jobNamePrefixes as $prefix) {
                        $query->orWhere(
                            function ($query) use ($prefix) {
                                $query->where('JOB_NAME', 'like', $prefix . '.%');
                            }
                        );
                    }
                }
            )->get([
                'EMP_NUM',
                'EMP_NAME',
                XxhrEstructuraUteq::raw("SUBSTRING_INDEX(JOB_NAME, '.', 1) as JobNamePrefix")
            ]);

            $empleados = XxhrEstructuraUteq::all([
                'EMP_NUM',
                'EMP_NAME',
                'EMP_RFC',
                'ORGANIZACION',
                'JOB_NAME',
                'EMP_IMSS',
                'EMP_BIRTHDATE',
                'TIPO_CONTRATO',
                'ESTATUS',
                'DIRE',
                'DEPT',
                XxhrEstructuraUteq::raw("SUBSTRING_INDEX(JOB_NAME, '.', 1) as JobNamePrefix")
            ]);

            if ($empleados->isEmpty()) {
                return response()->json([
                    'status' => 404,
                    'msj' => 'No se encontraron empleados',
                ]);
            }

            return response()->json([
                'status' => 200,
                'empleados' => $empleados,
                'x' => $empleadosFiltrados,
                'msj' => 'empleados encontrados',
            ]);
            //--------------------------------------------------------
        } else {
            return response()->json([
                'status' => 700,
                'msj' => 'Sesión inválida',
            ]);
        }
    }
    public function get_Total_Empleados(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            $totalEmpleados = XxhrEstructuraUteq::where('ESTATUS', 'A')->count();

            return response()->json([
                'status' => 200,
                'totalEmpleados' => $totalEmpleados,
                'msj' => 'Total de empleados obtenido correctamente.',
            ]);
            //--------------------------------------------------------
        } else {
            return response()->json([
                'status' => 700,
                'msj' => 'Sesión inválida',
            ]);
        }
    }
    public function conocer_tipousuarios(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            $numEmp = $request->input('numEmp');
            if ($numEmp == "") {
                return response()->json([
                    'status' => 400,
                    'msj' => 'Selecciona un Empleado'
                ]);
            }
            // Crear un array $tipo_menus
            $tipo_menus = [9];

            // Obtiene el JOB_NAME
            $jobName = XxhrEstructuraUteq::where('EMP_NUM', $numEmp)->value('JOB_NAME');
            $jobNumber = substr($jobName, 0, strpos($jobName, '.'));
            $mandoExists = Mando::where('NUM_MANDO', $jobNumber)->exists();

            if ($mandoExists) {
                $tipo_menus[] = 60;
            }
            // Obtiene los campos NOM_NAME_1, TIPO_CONTRATO y SINDICALIZADO_N_S
            $ubicacion = XxhrEstructuraUteq::where('EMP_NUM', $numEmp)
                ->select('DIRE', 'DEPT', 'ORGANIZACION')
                ->first();

            // Obtiene los campos NOM_NAME_1, TIPO_CONTRATO y SINDICALIZADO_N_S
            $employeeInfo = XxhrEstructuraUteq::where('EMP_NUM', $numEmp)
                ->select('NOM_NAME_1', 'TIPO_CONTRATO', 'SINDICALIZADO_N_S')
                ->first();

            if (
                $employeeInfo->NOM_NAME_1 == "UTEQ" &&
                $employeeInfo->SINDICALIZADO_N_S == "SI" &&
                $employeeInfo->TIPO_CONTRATO == "BASE"
            ) {
                $tipo_menus[] = 59;
            }

            if (
                $employeeInfo->NOM_NAME_1 == "UTEQ" &&
                $employeeInfo->SINDICALIZADO_N_S == "NO"
            ) {
                $tipo_menus[] = 36;
            }

            // Devuelve los datos en formato JSON
            return response()->json([
                'status' => 200,
                'jobName' => $jobNumber,
                'ubicacion' => $ubicacion,
                'tipo_usuario' => $tipo_menus,
            ]);
        } else {
            return response()->json([
                'status' => 700,
                'msj' => 'Sesión inválida',
            ]);
        }
    }
}
