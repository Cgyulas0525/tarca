<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * Class szamla
 * @package App\Models
 * @version July 8, 2020, 7:25 am UTC
 *
 * @property integer partner
 * @property string szamlaszam
 * @property integer fizitesimod
 * @property number osszeg
 * @property string kelt
 * @property string teljesites
 * @property string fizetesihatarido
 */
class szamla extends Model
{
    use SoftDeletes;

    public $table = 'szamla';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'partner',
        'szamlaszam',
        'fizitesimod',
        'osszeg',
        'kelt',
        'teljesites',
        'fizetesihatarido'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'partner' => 'integer',
        'szamlaszam' => 'string',
        'fizitesimod' => 'integer',
        'osszeg' => 'float',
        'kelt' => 'date',
        'teljesites' => 'date',
        'fizetesihatarido' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'partner' => 'required',
        'szamlaszam' => 'required',
        'fizitesimod' => 'required',
        'osszeg' => 'required',
        'kelt' => 'required',
        'teljesites' => 'required',
        'fizetesihatarido' => 'required'
    ];

    public static function OsszKoltseg() {
        $data = DB::table('szamla')->sum('osszeg');
        return $data;
    }

}
