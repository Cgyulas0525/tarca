<?php
namespace App\Classes;
use Redirect,Response,DB;
use App\Models\termekcsoport;

class Api{

    public static function  getMaxCikkszam($betu)
    {
        $db = DB::table('termek')
                  ->whereNull('deleted_at')
                  ->where('cikkszam', 'like', '%'.$betu.'%')
                  ->count();
        if ($db > 0){
            $return = DB::table('termek')
                        ->select(DB::raw('MAX(cikkszam) AS cikkszam_max'))
                        ->whereNull('deleted_at')
                        ->where('cikkszam', 'like', '%'.$betu.'%')
                        ->get();
        }else{
            "0000000";
        }
        return Response::json($return);
    }

    public static function getMaxTermekCikkszam($csoport)
    {

        $db = DB::table('termek')
                  ->whereNull('deleted_at')
                  ->where('csoport', "=", $csoport)
                  ->count();
        if ($db > 0) {
            $return = DB::table('termek')
                        ->select(DB::raw('MAX(cikkszam) AS cikkszam_max'))
                        ->whereNull('deleted_at')
                        ->where('cikkszam', 'like', '%T%')
                        ->where('csoport', "=", $csoport)
                        ->get();
        }else{
            $termekCsoport = termekcsoport::getTermekCsoport($csoport);
            $focsoport = (string)$termekCsoport->focsoport;
            $strCsoport = (string)$csoport;
            if ( strlen($strCsoport) == 1){
                $strCsoport = "0".$strCsoport;
            }
            $cikkszam_max = $focsoport.$strCsoport."0000";
            $return = DB::table('termek')
                        ->select(DB::raw($cikkszam_max.' AS cikkszam_max'))
                        ->get();
            $return = $cikkszam_max;
        }
        return $return;
    }


}
