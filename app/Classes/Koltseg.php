<?php
namespace App\Classes;
use Redirect,Response,DB;

class Koltseg{

    public static function  getEvHonapKoltseg()
    {
        $kezdo = date('Y-m-d', strtotime('first day of this month - 5'));
        $veg   = date('Y-m-d', strtotime('last day of this month'));
        $data  = DB::table('szamlatetel as p1')
                      ->join('szamla as p2', 'p2.id', '=', 'p1.szamla')
                      ->select(DB::raw("CONCAT(year(p2.teljesites), '.', lpad(month(p2.teljesites), 2, 0)) as honap, sum(p1.brutto) as db"))
                      ->whereBetween('p2.teljesites', [$kezdo, $veg])
                      ->whereNull('p1.deleted_at')
                      ->orderBy('honap')
                      ->groupBy('honap')
                      ->get();
        return $data;
    }

    public static function  getEvHetKoltseg()
    {
        $kezdo = date('Y-m-d', strtotime('first day of this month - 2'));
        $veg   = date('Y-m-d', strtotime('last day of this month'));
        $data  = DB::table('szamlatetel as p1')
                      ->join('szamla as p2', 'p2.id', '=', 'p1.szamla')
                      ->select(DB::raw("CONCAT(year(p2.teljesites), '.', lpad(week(p2.teljesites), 2, 0)) as honap, sum(p1.brutto) as db"))
                      ->whereBetween('p2.teljesites', [$kezdo, $veg])
                      ->whereNull('p1.deleted_at')
                      ->orderBy('honap')
                      ->groupBy('honap')
                      ->get();
        return $data;
    }

}
