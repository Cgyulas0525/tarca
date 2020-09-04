<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * Class Partner
 * @package App\Models
 * @version July 5, 2020, 12:41 pm UTC
 *
 * @property string nev
 * @property integer tipus
 * @property string adoszam
 * @property string bankszamla
 * @property string isz
 * @property integer telepules
 * @property string cim
 * @property string email
 * @property string telefonszam
 * @property string megjegyzes
 */
class Partner extends Model
{
    use SoftDeletes;

    public $table = 'partner';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nev',
        'tipus',
        'adoszam',
        'bankszamla',
        'isz',
        'telepules',
        'cim',
        'email',
        'telefonszam',
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
        'tipus' => 'integer',
        'adoszam' => 'string',
        'bankszamla' => 'string',
        'isz' => 'string',
        'telepules' => 'integer',
        'cim' => 'string',
        'email' => 'string',
        'telefonszam' => 'string',
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


    public static function PartnerCount(){
        $db = DB::table('partner')
                ->whereNull('deleted_at')
                ->count();
        return $db;
    }

}
