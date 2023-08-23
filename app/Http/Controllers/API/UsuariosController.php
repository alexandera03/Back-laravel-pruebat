<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuarios;

use function Laravel\Prompts\password;

class UsuariosController extends Controller
{
    //
    public function get(){
        try {
            $data = Usuarios::get();
            return response()->json($data,200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }


    /*
        Función para crear el usuario
    */
    public function create(Request $request){
        try {
            $data['email'] = $request['email'];
            $data['password'] = $request['password'];
            $data['name'] = $request['name'];
            $validateExisting= Usuarios::where('email',$request['email'])->first();
            if($validateExisting){
                return response()->json(['error'=>'Usuario Ya Registrado'],500);

            }else{
                $res = Usuarios::create($data);
                return response()->json(['usuario'=>$data],200);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }


    public function getById($id){
        try {
            //code...
            $data = Usuarios::find($id);
            return response()->json($data,200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    public function login(Request $request){
        try {
            //code...
            $data = Usuarios::where('email',$request['email'])->first();
            info($data);
            if($data['password']==$request['password']){
                return response()->json(['usuario'=>$data],200);

            }else{
                return response()->json(['error'=>'Contraseña Incorrecta'],500);
            }

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error'=>$th->getMessage()],500);

        }
    }

    public function update(Request $request,$id){
        try {
            //code...
            $data['email']= $request['email'];
            $data['password']=$request['password'];
            $data['name']=$request['name'];
            Usuarios::find($id)->update($data);
            $res = Usuarios::find($id);
            return response()->json($res,200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error'=>$th->getMessage()],500);

        }
    }

    public function delete($id){
        try {
            //code...
            $res=Usuarios::find($id)->delete();
            return response()->json(['deleted'=>$res],200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error'=>$th->getMessage()],500);

        }
    }
}
