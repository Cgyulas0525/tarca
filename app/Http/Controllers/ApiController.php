<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Classes\Api;
use Redirect,Response,DB,Datatables;

class ApiController extends Controller
{

    public function getTelepulesList(Request $request)
    {
        $id = $request->get('id');
        $states = DB::table("telepules")
                    ->where("iranyitoszam", '=', $id)
                    ->select('telepules' , 'id')
                    ->orderBy('telepules')
                    ->get();
        return Response::json($states);
    }

    public function getFocsoport(Request $request)
    {
        $id = $request->get('id');
        $return = DB::table('termekfocsoport')->where('id', '=', $id)->get();
        return Response::json($return);
   }

   public function getFocsoportFromCsoport(Request $request)
   {
       $id = $request->get('id');
       $return = DB::table('termekfocsoport as t1')
                     ->join('termekcsoport as t2', 't2.focsoport', '=', 't1.id')
                     ->where('t2.id', '=', $id)->get();
       return Response::json($return);
   }

   public function getMaxSzolgaltatasCikkszam(Request $request)
   {
       $betu = $request->get('betu');
       $return = Api::getMaxCikkszam($betu);
       return Response::json($return);
   }


   public function getMaxTermekCikkszam(Request $request)
   {
       $csoport = $request->get('csoport');
       $return = Api::getMaxTermekCikkszam($csoport);
       return Response::json($return);
   }

   public function getAfaSzazalek(Request $request)
   {
       $id = $request->get('id');
       $afaszaz = 0;
       if ( $id == 2081 || $id == 2084){
           $afaszaz = 0;
       }else if ( $id == 2082){
           $afaszaz = 5;
       }else if ($id == 2083){
           $afaszaz = 27;
       }
       $return = DB::table('dictionaries')
                   ->select(DB::raw($afaszaz.' AS afaszaz'))
                   ->get();
       return Response::json($return);
   }


   public function dashboard(Request $request)
   {
       $data = DB::table('todo')
                 ->join('users as p1', 'p1.id', '=', 'todo.user')
                 ->select('todo.*', 'p1.name as nev')
                 ->whereNull('todo.deleted_at')
                 ->whereNull('todo.vege')
                 ->orderBy('todo.vege', 'todo.mikorra')
                 ->get();

       return Datatables::of($data)
                   ->make(true);

   }
}
