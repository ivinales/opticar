<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TallerUser;
use DB;

class TallerUserController extends Controller
{
    public function index(Request $request)
    {
        // return new TallerUserResource(TallerUser::all());
        
        // $data = DB::table('taller_user')
        //     ->join('users', 'users.id', '=', 'taller_user.user_id')
        //     ->join('taller', 'taller.id' , '=', 'taller_user.taller_id')
        //     ->select('taller.nombre','users.num_documento','taller_user.id')
        //     ->get();
        //     return $data;


            $buscar= $request->buscar;
            $criterio= $request->criterio;
    
            if($buscar==''){
    
                $talleruser = TallerUser::join('users', 'users.id', '=', 'taller_user.user_id')
                ->join('taller', 'taller.id' , '=', 'taller_user.taller_id')
                ->select('taller.nombre','taller.direccion','taller.estado','users.num_documento','users.nombre','users.email')
                ->orderBy('taller_user.id', 'desc')->paginate(3);
    
            } else{
    
                $talleruser = TallerUser::join('users', 'users.id', '=', 'taller_user.user_id')
                ->join('taller', 'taller.id' , '=', 'taller_user.taller_id')
                ->select('taller.nombre','taller.direccion','taller.estado','users.num_documento','users.nombre','users.email')
                ->where('taller.'.$criterio, 'like', '%'. $buscar . '%')
                ->orderBy('taller_user.id', 'desc')->paginate(3);
            }
    
             
            return[
    
                'pagination' => [
                'total'            => $talleruser->total(),
                'current_page'     => $talleruser->currentPage(),
                'per_page'         => $talleruser->perPage(),
                'last_page'        => $talleruser->lastPage(),
                'from'             => $talleruser->firstItem(),
                'to'               => $talleruser->lastItem(),
               
                ],
    
                'talleruser' =>$talleruser
    
            ];
        
    }
    public function store(Request $request)
    {
        $talleruser=new TallerUser();
        $talleruser->user_id=$request->user;
        $talleruser->taller_id=$request->taller;
        $talleruser->save();
        return;
    }

}
