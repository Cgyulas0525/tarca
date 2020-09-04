<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * Class termek
 * @package App\Models
 * @version July 8, 2020, 7:24 am UTC
 *
 * @property string nev
 * @property string cikkszam
 * @property integer me
 * @property integer tsz
 * @property string megjegyzes
 */
class termek extends Model
{
    use SoftDeletes;

    public $table = 'termek';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nev',
        'csoport',
        'cikkszam',
        'me',
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
        'csoport' => 'integer',
        'cikkszam' => 'string',
        'me' => 'integer',
        'megjegyzes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nev' => 'required',
        'csoport' => 'required',
        'cikkszam' => 'required',
        'me' => 'required'
    ];

    public static function TermekCount(){
        $db = DB::table('termek')
                ->whereNull('deleted_at')
                ->count();
        return $db;
    }

    public static function TermekOsszesen($kezdo, $veg, $csoport) {
        if ($csoport != NULL){
            $data = DB::table('szamlatetel as t1')
                        ->join('termek as t2', 't2.id', '=', 't1.termek')
                        ->join('szamla as t5', 't5.id', '=', 't1.szamla')
                        ->select(DB::raw('t2.nev as nev, sum(t1.brutto) as osszeg'))
                        ->whereIn('t2.id', $csoport)
                        ->whereBetween('t5.kelt', [$kezdo, $veg])
                        ->groupBy('t2.nev')
                        ->get();
        }else {
            $data = DB::table('szamlatetel as t1')
                        ->join('termek as t2', 't2.id', '=', 't1.termek')
                        ->join('szamla as t5', 't5.id', '=', 't1.szamla')
                        ->select(DB::raw('t2.nev as nev, sum(t1.brutto) as osszeg'))
                        ->whereBetween('t5.kelt', [$kezdo, $veg])
                        ->groupBy('t2.nev')
                        ->get();
        }
        return $data;
    }

}
