<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use App\Departamento;
use DB;

class empleadosController extends Controller
{
    //GENERACIÓN DE CADA UNO DE LOS MÉTODOS PARA HACER EL CRUD A LA BD.

    //1. Método de listado de empleados.
    public function index(){ //el index es la raiz que voy a mostrar cuando entre a la capa CONTROLLER
        $empleados = Empleado::all();
        //Mostrar en la vista el listado de empleados
        return view('empleados.admin_empleados',compact('empleados')); //compact instancia la vista del folder
    }

    //2. Método para crear nuevo empleado
    public function create(){
        return view('empleados.alta_empleado',compact('empleados'));
    }

    //3. Almacenar empleados
    public function store(Request $request){
        //Retirar datos del request previo
        $datosEmpleado = request()->except('empleados');
        //Retirar el token del request
        $datosEmpleado = request()->except(['_token']);
        //Insertar en la tabla empleado los datos para la creación de un nuevo registro
        $id = DB::table('empleados')->insertGetId($datosEmpleado);
        //Redirección de URL después de guardar
        return redirect('empleados');

    }

    //4. Editar empleados
    public function edit($id){
        //Encontrar el empleado y editar a través de su ID
        $empleados = Empleado::findOrFail($id);
        //Una vez encontrado, mostrar la vista para editar
        return view('empleados.editar_empleado',compact('empleados'));
    }

    //5. Controlador para eliminar empleado
    public function destroy($id){
        //Alert::success('Datos eliminados de la base de datos');
        $usuario = Empleado::findOrFail($id);
        $usuario->delete();
        return redirect('empleados');
    }

    public function update(Request $request){
        //Retirar el token del request
        //$datosEmpleado = request()->except(['_token']);

        //obtengo el id del input tipo hidden
        $id = $request->input('id');

             //validar data de empleados:
            $request->validate([
                'nombres' => 'required|max:50',
                'apellidos' => 'required|max:50',
                'cedula' => 'required|max:20',
                'email' => 'required|max:50|email|unique:empleados,email,' . $id,
                'lugar_nacimiento' => 'required|max:50',
                'estado_civil' => 'required|max:50',
                'telefono' => 'required|numeric'
            ]);


        
        $empleado = Empleado::findOrfail($id);
        $empleado->nombres = $request->input('nombres');
        $empleado->apellidos = $request->input('apellidos');
        $empleado->cedula = $request->input('cedula');
        $empleado->email = $request->input('email');
        $empleado->lugar_nacimiento = $request->input('lugar_nacimiento');
        $empleado->sexo = $request->input('sexo');
        $empleado->estado_civil = $request->input('estado_civil');
        $empleado->telefono = $request->input('telefono');
        $empleado->save();
        return redirect('empleados');
    
        //echo '<h1>'.$datosEmpleado.'</h1>';
    }




}
