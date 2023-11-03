<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\menuSubmenu;
use App\Models\XxhrEstructuraUteq;
use App\Models\Mando;


class menuSubmenuController extends Controller
{
    //TRAE LOS "MENÚS" Y "SUBMENÚS" DE CADA EMPLEADO CUANDO INICIA SECIÓN DEBEN DE ESTAR ESTAUS "A"
    public function get_MenuSubmenu(Request $request)
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

            // Verifica si $numEmp existe en la tabla 'menu_submenu'
            $employeeExists = menuSubmenu::where('EMP_NUM', $numEmp)->exists();

            if ($employeeExists) {
                // Si el empleado existe en 'menu_submenu', obtén los menús y submenús
                $menuSubmenu = menuSubmenu::with(['menu', 'submenu'])
                    ->where('EMP_NUM', $numEmp)
                    ->whereHas('menu', function ($query) {
                        $query->where('ESTATUS', 'A');
                    })
                    ->whereHas('submenu', function ($query) {
                        $query->where('ESTATUS', 'A');
                    })
                    ->get();

                // Devuelve los datos en formato JSON
                return response()->json([
                    'status' => 200,
                    'datos' => $menuSubmenu,
                    'tipo_menus' => $tipo_menus,
                    'msj' => 'Menús y submenús encontrados'
                ]);
            } else {

                // Obtiene el JOB_NAME
                $jobName = XxhrEstructuraUteq::where('EMP_NUM', $numEmp)->value('JOB_NAME');

                // Separa los primeros dígitos del JOB_NAME antes del punto
                $jobNumber = substr($jobName, 0, strpos($jobName, '.'));

                // Verifica si el número existe en la tabla 'mando'
                $mandoExists = Mando::where('NUM_MANDO', $jobNumber)->exists();

                // Realiza las validaciones adicionales
                if ($mandoExists) {
                    $tipo_menus[] = 60;
                }

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

                // Luego de las validaciones, obtén los menús y submenús
                $menuSubmenu = menuSubmenu::with(['menu', 'submenu'])
                    ->whereIn('EMP_NUM', $tipo_menus)
                    ->whereHas('menu', function ($query) {
                        $query->where('ESTATUS', 'A');
                    })
                    ->whereHas('submenu', function ($query) {
                        $query->where('ESTATUS', 'A');
                    })
                    ->get();

                // Devuelve los datos en formato JSON
                return response()->json([
                    'status' => 200,
                    'datos' => $menuSubmenu,
                    'jobName' => $jobName,
                    'tipo_menus' => $tipo_menus,
                    'msj' => 'Menús y submenús encontrados'
                ]);
            }
        } else {
            return response()->json([
                'status' => 700,
                'msj' => 'Sesión inválida',
            ]);
        }
    }
    //TRAE LOS "MENÚS" Y "SUBMENÚS" DE CADA EMPLEADO CUANDO PARA EL CRUD, DEBEN DE ESTAR ESTAUS "A" Y "I"
    public function get_menu_empleado(Request $request)
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

            // Verifica si $numEmp existe en la tabla 'menu_submenu'
            $employeeExists = menuSubmenu::where('EMP_NUM', $numEmp)->exists();

            if ($employeeExists) {
                // Si el empleado existe en 'menu_submenu', obtén los menús y submenús
                $menuSubmenu = menuSubmenu::with(['menu', 'submenu'])
                    ->where('EMP_NUM', $numEmp)
                    ->get();

                // Devuelve los datos en formato JSON
                return response()->json([
                    'status' => 200,
                    'datos' => $menuSubmenu,
                    'tipo_menus' => $tipo_menus,
                    'msj' => 'Menús y submenús encontrados'
                ]);
            } else {

                // Obtiene el JOB_NAME
                $jobName = XxhrEstructuraUteq::where('EMP_NUM', $numEmp)->value('JOB_NAME');

                // Separa los primeros dígitos del JOB_NAME antes del punto
                $jobNumber = substr($jobName, 0, strpos($jobName, '.'));

                // Verifica si el número existe en la tabla 'mando'
                $mandoExists = Mando::where('NUM_MANDO', $jobNumber)->exists();

                // Realiza las validaciones adicionales
                if ($mandoExists) {
                    $tipo_menus[] = 60;
                }

                // Obtiene los campos NOM_NAME_1, TIPO_CONTRATO y SINDICALIZADO_N_S
                $employeeInfo = XxhrEstructuraUteq::where('EMP_NUM', $numEmp)
                    ->select('NOM_NAME_1', 'TIPO_CONTRATO', 'SINDICALIZADO_N_S')
                    ->first();

                if (
                    $employeeInfo->NOM_NAME_1 == "UTEQ" &&
                    //$employeeInfo->SINDICALIZADO_N_S == "SI" &&
                    $employeeInfo->TIPO_CONTRATO == "BASE"
                ) {
                    $tipo_menus[] = 59;
                }

                if (
                    $employeeInfo->NOM_NAME_1 == "UTEQ" &&
                    $employeeInfo->SINDICALIZADO_N_S == "NO" &&
                    $employeeInfo->TIPO_CONTRATO == "CONFIANZA"
                ) {
                    $tipo_menus[] = 36;
                }

                // Luego de las validaciones, obtén los menús y submenús
                $menuSubmenu = menuSubmenu::with(['menu', 'submenu'])
                    ->whereIn('EMP_NUM', $tipo_menus)
                    ->get();

                // Devuelve los datos en formato JSON
                return response()->json([
                    'status' => 200,
                    'datos' => $menuSubmenu,
                    'jobName' => $jobName,
                    'tipo_menus' => $tipo_menus,
                    'msj' => 'Menús y submenús encontrados'
                ]);
            }
        } else {
            return response()->json([
                'status' => 700,
                'msj' => 'Sesión inválida',
            ]);
        }
    }
    //INSERTA LOS "MENÚS" Y "SUBMENÚS" ACTUALIZADOS POR EL EMP_NUM Ó EL (9, 60, 59, 36)MENUS Y SUBMENUS ESPECIALES
    public function insert_MenuEditado(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            $data = json_decode($request->input('data'));
            if (empty($data) || is_null($data)) {
                return response()->json([
                    'status' => 400,
                    'msj' => 'Selecciona almenos un Submenú'
                ]);
            }
            $empNum = $data[0]->EMP_NUM; // Obtener el EMP_NUM de los datos (puedes elegir cualquier registro para esto)

            // Verificar si $empNum existe en la base de datos
            $employeeExists = menuSubmenu::where('EMP_NUM', $empNum)->exists();

            if ($employeeExists) {
                // Elimina los registros existentes en la tabla menu_submenu para el EMP_NUM específico
                menuSubmenu::where('EMP_NUM', $empNum)->delete();
            }
            // Inserta los nuevos registros basados en los datos proporcionados
            foreach ($data as $item) {
                menuSubmenu::create([
                    'EMP_NUM' => $item->EMP_NUM,
                    'MENU_ID' => $item->MENU_ID,
                    'SUBMENU_ID' => $item->SUBMENU_ID,
                ]);
            }

            return response()->json([
                'status' => 200,
                'msj' => 'Mumús actualizados exitosamente',
            ]);

            //--------------------------------------------------------
        } else {
            return response()->json([
                'status' => 700,
                'msj' => 'Sesión inválida',
            ]);
        }
    }
}
