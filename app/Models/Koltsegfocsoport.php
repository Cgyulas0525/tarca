<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * Class Koltsegfocsoport
 * @package App\Models
 * @version July 5, 2020, 12:44 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection koltsegcsoports
 * @property string nev
 * @property string megjegyzes
 */
class Koltsegfocsoport extends Model
{
    use SoftDeletes;

    public $table = 'koltsegfocsoport';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
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
        'nev' => 'string',
        'megjegyzes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nev' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function koltsegcsoports()
    {
        return $this->hasMany(\App\Models\Koltsegcsoport::class, 'focsoport');
    }

    public static function KoltsegFoCsoportOsszesen($kezdo, $veg, $focsoport) {
        if ($focsoport != NULL){
            $data = DB::table('szamlatetel as t1')
                        ->join('koltsegcsoport as t2', 't2.id', '=', 't1.koltseg')
                        ->join('koltsegfocsoport as t3', 't3.id', '=', 't2.focsoport')
                        ->join('szamla as t4', 't4.id', '=', 't1.szamla')
                        ->select(DB::raw('t3.nev as nev, sum(t1.brutto) as osszeg'))
                        ->whereIn('t2.focsoport', $focsoport)
                        ->whereBetween('t4.kelt', [$kezdo, $veg])
                        ->groupBy('t3.nev')
                        ->get();
        }else {
            $data = DB::table('szamlatetel as t1')
                        ->join('koltsegcsoport as t2', 't2.id', '=', 't1.koltseg')
                        ->join('koltsegfocsoport as t3', 't3.id', '=', 't2.focsoport')
                        ->join('szamla as t4', 't4.id', '=', 't1.szamla')
                        ->select(DB::raw('t3.nev as nev, sum(t1.brutto) as osszeg'))
                        ->whereBetween('t4.kelt', [$kezdo, $veg])
                        ->groupBy('t3.nev')
                        ->get();
        }
        return $data;
    }

}
