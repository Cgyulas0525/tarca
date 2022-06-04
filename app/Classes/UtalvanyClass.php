<?php
namespace App\Classes;

use App\Models\Utalvany;
use App\Models\Utalvanytetel;
use Redirect;
use Response;
use DB;


class UtalvanyClass
{

    /**
     * A következő utalvány sorszám
     *
     * @return string
     */
    public static function kovetkezoUtalvany()
    {
        $db = Utalvany::count();
        if ($db != 0) {
            $utalvanyszam = Utalvany::max('sorszam');
            $szam = intval($utalvanyszam) + 1;
            $utalvanyszam = str_pad('', 3 - strlen(intval($szam) + 1), '0') . $szam;
        } else {
            $utalvanyszam = '001';
        }

        return $utalvanyszam;
    }

    public static function UtalvanyTetelSzam($id)
    {
        return Utalvanytetel::where('utalvany_id', $id)->get()->count();
    }

    public static function UtalvanyFelhasznalhato($id)
    {
        return Utalvany::find($id)->felhasznalhato;
    }

    public static function utolsoUtalvanyTetel($id)
    {
        return Utalvanytetel::where('utalvany_id', $id)
            ->orderBy('created_at', 'desc')
            ->first();
    }

}
