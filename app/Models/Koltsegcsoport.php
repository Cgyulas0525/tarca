<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * Class Koltsegcsoport
 * @package App\Models
 * @version July 5, 2020, 12:43 pm UTC
 *
 * @property \App\Models\Koltsegfocsoport focsoport
 * @property integer focsoport
 * @property string nev
 * @property string megjegyzes
 */
class Koltsegcsoport extends Model
{
    use SoftDeletes;

    public $table = 'koltsegcsoport';

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function focsoport()
    {
        return $this->belongsTo(\App\Models\Koltsegfocsoport::class, 'focsoport');
    }

    public static function KoltsegCsoportOsszesen($kezdo, $veg, $csoport) {
        if ($csoport != NULL){
            $data = DB::table('szamlatetel as t1')
                        ->join('koltsegcsoport as t2', 't2.id', '=', 't1.koltseg')
                        ->join('szamla as t4', 't4.id', '=', 't1.szamla')
                        ->select(DB::raw('t2.nev as nev, sum(t1.brutto) as osszeg'))
                        ->whereIn('t2.csoport', $csoport)
                        ->whereBetween('t4.kelt', [$kezdo, $veg])
                        ->groupBy('t2.nev')
                        ->get();
        }else {
            $data = DB::table('szamlatetel as t1')
                        ->join('koltsegcsoport as t2', 't2.id', '=', 't1.koltseg')
                        ->join('szamla as t4', 't4.id', '=', 't1.szamla')
                        ->select(DB::raw('t2.nev as nev, sum(t1.brutto) as osszeg'))
                        ->whereBetween('t4.kelt', [$kezdo, $veg])
                        ->groupBy('t2.nev')
                        ->get();
        }
        return $data;
    }

}
