<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Utalvany
 * @package App\Models
 * @version June 2, 2022, 12:52 pm UTC
 *
 * @property string sorszam
 * @property integer osszeg
 */
class Utalvany extends Model
{
    use SoftDeletes;

    public $table = 'utalvany';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'sorszam',
        'osszeg'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'sorszam' => 'string',
        'osszeg' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'sorszam' => 'required',
        'osszeg' => 'required'
    ];

    protected $append = ['felhasznalt', 'felhasznalhato'];

    public function utalvanytetel() {
        return $this->hasMany('App\Models\Utalvanytetel');
    }

    public function getFelhasznaltAttribute() {
        return Utalvanytetel::where('utalvany_id', $this->id)->get()->sum('osszeg');
    }

    public function getFelhasznalhatoAttribute() {
        return $this->osszeg - Utalvanytetel::where('utalvany_id', $this->id)->get()->sum('osszeg');
    }

}
