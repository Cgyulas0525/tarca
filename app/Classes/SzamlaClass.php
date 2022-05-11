<?php
namespace App\Classes;
use App\Models\Szamla;
use DB;

class SzamlaClass{

    public static function aktualisEvOsszKoltseg() {
        $kezdo = date('Y-m-d', strtotime('first day of january this year'));
        $veg   = date('Y-m-d', strtotime('last day of december this year'));
        return Szamla::whereBetween('kelt', [$kezdo, $veg])->sum('osszeg');
    }

    public static function aktualisHaviOsszKoltseg() {
        $kezdo = date('Y-m-d', strtotime('first day of this month'));
        $veg   = date('Y-m-d', strtotime('last day of this month'));
        return Szamla::whereBetween('kelt', [$kezdo, $veg])->sum('osszeg');
    }

    public static function SzamlaOsszPartnerenkent() {
        return DB::table('szamla')
            ->join('partner', 'partner.id', 'szamla.partner')
            ->select('partner.nev as nev', DB::raw('sum(osszeg) as osszeg'))
            ->whereNull('szamla.deleted_at')
            ->groupBy('partner.nev')
            ->get();
    }

    public static function idoszakEvOsszKoltseg($kezdo, $veg) {
        return Szamla::whereBetween('kelt', [$kezdo, $veg])->sum('osszeg');
    }

    public static function szamlakPartnerIdoszakOsszesen($partner, $tol, $ig)
    {
        return DB::table('szamla')
            ->join('partner', 'partner.id', '=', 'szamla.partner')
            ->select(DB::raw('partner.nev as partner, partner.id, Sum(szamla.osszeg) osszeg'))
            ->where(function($query) use($partner) {
                if ( is_null($partner)) {
                    $query->whereNotNull('szamla.partner');
                } else {
                    $query->where( 'szamla.partner', $partner);
                }
            })
            ->whereBetween('szamla.fizetesihatarido', [
                is_null($tol) ? date('Y-m-d', strtotime('first day of 1990')) : $tol ,
                is_null($ig) ? date('Y-m-d', strtotime('last day of this year')) : $ig])
            ->whereNull('szamla.deleted_at')
            ->where('szamla.osszeg', '>', 0)
            ->groupBy('partner.nev', 'partner.id')
            ->orderBy('partner.nev')
            ->get();
    }

    public static function szamlakPartnerIdoszakHaviOsszesen($partner, $tol, $ig)
    {
        return DB::table('szamla')
            ->join('partner', 'partner.id', '=', 'szamla.partner')
            ->select(DB::raw('partner.nev as partner, Sum(szamla.osszeg) osszeg, concat(year(szamla.fizetesihatarido), if(CAST(month(szamla.fizetesihatarido) AS UNSIGNED) < 10, concat("0", month(szamla.fizetesihatarido)), month(szamla.fizetesihatarido))) honap'))
            ->where(function($query) use($partner) {
                if ( is_null($partner)) {
                    $query->whereNotNull('szamla.partner');
                } else {
                    $query->where( 'szamla.partner', $partner);
                }
            })
            ->whereBetween('szamla.fizetesihatarido', [
                is_null($tol) ? date('Y-m-d', strtotime('first day of 1990')) : $tol ,
                is_null($ig) ? date('Y-m-d', strtotime('last day of this year')) : $ig])
            ->whereNull('szamla.deleted_at')
            ->groupBy('partner', 'honap')
            ->orderBy('partner')->orderBy('honap')
            ->get();
    }

    public static function szamlaPartnerEviIdoszak($partner, $tol, $ig)
    {
        return DB::table('szamla')
            ->join('partner', 'partner.id', '=', 'szamla.partner')
            ->select(DB::raw('partner.nev as partner, Sum(szamla.osszeg) osszeg, year(szamla.fizetesihatarido) ev'))
            ->where(function($query) use($partner) {
                if ( is_null($partner)) {
                    $query->whereNotNull('szamla.partner');
                } else {
                    $query->where( 'szamla.partner', $partner);
                }
            })
            ->whereBetween('szamla.fizetesihatarido', [
                is_null($tol) ? date('Y-m-d', strtotime('first day of 1990')) : $tol ,
                is_null($ig) ? date('Y-m-d', strtotime('last day of this year')) : $ig])
            ->whereNull('szamla.deleted_at')
            ->groupBy('partner', 'ev')
            ->orderBy('partner')->orderBy('ev')
            ->get();
    }

    public static function szamlaPartnerNegyedevOsszesen($partner, $tol, $ig)
    {
        return DB::table('szamla')
            ->join('partner', 'partner.id', '=', 'szamla.partner')
            ->select(DB::raw('partner.nev as partner, concat(year(szamla.fizetesihatarido), quarter(szamla.fizetesihatarido)) idoszak, Sum(szamla.osszeg) osszeg'))
            ->where(function($query) use($partner) {
                if ( is_null($partner)) {
                    $query->whereNotNull('szamla.partner');
                } else {
                    $query->where( 'szamla.partner', $partner);
                }
            })
            ->whereBetween('szamla.fizetesihatarido', [
                is_null($tol) ? date('Y-m-d', strtotime('first day of 1990')) : $tol ,
                is_null($ig) ? date('Y-m-d', strtotime('last day of this year')) : $ig])
            ->whereNull('szamla.deleted_at')
            ->groupBy('partner.nev', 'idoszak')
            ->orderBy('partner.nev')->orderBy('idoszak')
            ->get();
    }

//    public static function proba($partner, $tol, $ig)
//    {
//
//    }
}

//$months = DB::table('szamla as t')
//    ->join('partner as t1', 't1.id', '=', 't.partner')
//    ->select(DB::raw('t1.nev as partner, Sum(t.osszeg) osszeg, concat(year(t.fizetesihatarido), if(CAST(month(t.fizetesihatarido) AS UNSIGNED) < 10, concat("0", month(t.fizetesihatarido)), month(t.fizetesihatarido))) honap'))
//    ->where(function($query) use($partner) {
//        if ( is_null($partner)) {
//            $query->whereNotNull('t.partner');
//        } else {
//            $query->where( 't.partner', $partner);
//        }
//    })
//    ->whereNull('t.deleted_at')
//    ->groupBy('partner', 'honap')
//    ->orderBy('partner')->orderBy('honap')
//    ->get();
//
//foreach( $months as $month){
//    echo $month->partner. ' ' . $month->honap  . ' ' . $month->osszeg . "\n";
//}

//
//$months = DB::table('szamla as t')
//    ->select(DB::raw('concat(year(t.fizetesihatarido), if(CAST(month(t.fizetesihatarido) AS UNSIGNED) < 10, concat("0", month(t.fizetesihatarido)), month(t.fizetesihatarido))) nev, Sum(t.osszeg) osszeg'))
//    ->where('t.partner', 61)
//    ->groupBy('nev')
//    ->orderBy('nev')
//    ->get();
//
//$quarters = DB::table('szamla as t')
//    ->select(DB::raw('concat(year(t.fizetesihatarido), quarter(t.fizetesihatarido)) nev, Sum(t.osszeg) osszeg'))
//    ->where('t.partner', 61)
//    ->groupBy('nev')
//    ->orderBy('nev')
//    ->get();
