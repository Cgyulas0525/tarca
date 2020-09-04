<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * Class termekcsoport
 * @package App\Models
 * @version July 13, 2020, 6:31 am UTC
 *
 * @property integer focsoport
 * @property string nev
 * @property string megjegyzes
 */
class termekcsoport extends Model
{
    use SoftDeletes;

    public $table = 'termekcsoport';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'focsoport',
        'nev',
        'megjegyzes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'focsoport' => 'integer',
        'nev' => 'string',
        'megjegyzes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'focsoport' => 'required',
        'nev' => 'required'
    ];

    public static function getTermekCsoport($id){
        $termekCsoport = DB::table('termekcsoport')->where('id', '=', $id)->first();
        return $termekCsoport;
    }

    public static function TermekCsoportCount(){
        $db = DB::table('termekcsoport')
                ->whereNull('deleted_at')
                ->count();
        return $db;
    }

    public static function TermekCsoportOsszesen($kezdo, $veg, $csoport) {
        if ($csoport != NULL){
            $data = DB::table('szamlatetel as t1')
                        ->join('termek as t2', 't2.id', '=', 't1.termek')
                        ->join('termekcsoport as t3', 't3.id', '=', 't2.csoport')
                        ->join('szamla as t5', 't5.id', '=', 't1.szamla')
                        ->select(DB::raw('t3.nev as nev, sum(t1.brutto) as osszeg'))
                        ->whereIn('t3.id', $csoport)
                        ->whereBetween('t5.kelt', [$kezdo, $veg])
                        ->groupBy('t3.nev')
                        ->get();
        }else {
            $data = DB::table('szamlatetel as t1')
                        ->join('termek as t2', 't2.id', '=', 't1.termek')
                        ->join('termekcsoport as t3', 't3.id', '=', 't2.csoport')
                        ->join('szamla as t5', 't5.id', '=', 't1.szamla')
                        ->select(DB::raw('t3.nev as nev, sum(t1.brutto) as osszeg'))
                        ->whereBetween('t5.kelt', [$kezdo, $veg])
                        ->groupBy('t3.nev')
                        ->get();
        }
        return $data;
    }

}
