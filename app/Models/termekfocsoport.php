<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * Class termekfocsoport
 * @package App\Models
 * @version July 13, 2020, 6:30 am UTC
 *
 * @property string nev
 * @property string megjegyzes
 */
class termekfocsoport extends Model
{
    use SoftDeletes;

    public $table = 'termekfocsoport';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nev',
        'tsz',
        'megjegyzes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nev' => 'string',
        'tsz' => 'integer',
        'megjegyzes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nev' => 'required',
        'tsz' => 'required'
    ];

    public static function TermekFoCsoportCount(){
        $db = DB::table('termekfocsoport')
                ->whereNull('deleted_at')
                ->count();
        return $db;
    }

    public static function TermekFoCsoportOsszesen($kezdo, $veg, $csoport) {
        if ($csoport != NULL){
            $data = DB::table('szamlatetel as t1')
                        ->join('termek as t2', 't2.id', '=', 't1.termek')
                        ->join('termekcsoport as t3', 't3.id', '=', 't2.csoport')
                        ->join('termekfocsoport as t4', 't4.id', '=', 't3.focsoport')
                        ->join('szamla as t5', 't5.id', '=', 't1.szamla')
                        ->select(DB::raw('t4.nev as nev, sum(t1.brutto) as osszeg'))
                        ->whereIn('t4.id', $csoport)
                        ->whereBetween('t5.kelt', [$kezdo, $veg])
                        ->groupBy('t4.nev')
                        ->get();
        }else {
            $data = DB::table('szamlatetel as t1')
                        ->join('termek as t2', 't2.id', '=', 't1.termek')
                        ->join('termekcsoport as t3', 't3.id', '=', 't2.csoport')
                        ->join('termekfocsoport as t4', 't4.id', '=', 't3.focsoport')
                        ->join('szamla as t5', 't5.id', '=', 't1.szamla')
                        ->select(DB::raw('t4.nev as nev, sum(t1.brutto) as osszeg'))
                        ->whereBetween('t5.kelt', [$kezdo, $veg])
                        ->groupBy('t4.nev')
                        ->get();
        }
        return $data;
    }

}
