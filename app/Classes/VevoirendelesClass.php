<?php
namespace App\Classes;

use DB;

class VevoirendelesClass {

    public static function megrendeltTermekDarab($veg)
    {

        return DB::table('vevoirendelesfej as t1')
            ->join('vevoirendelestetel as t2', 't2.vevoirendelesfej_id', '=', 't1.id' )
            ->join( 'partner as t3', 't3.id', '=', 't1.partner_id' )
            ->join( 'termek as t4', 't4.id', '=', 't2.termek_id')
            ->select(DB::raw('t4.nev as termek, SUM(t2.mennyiseg) as darab, (SUM(t2.mennyiseg) * t4.ar) as ar'))
            ->where('t1.mikorra', '<=', $veg)
            ->whereNull('t1.deleted_at')
            ->whereNull('t2.deleted_at')
            ->where('t1.statusz', '!=', 2114)
            ->groupBy('termek', 'ar')
            ->orderBy('termek')
            ->get();
    }

}

