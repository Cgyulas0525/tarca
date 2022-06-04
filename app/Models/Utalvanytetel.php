<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Utalvanytetel
 * @package App\Models
 * @version June 2, 2022, 12:53 pm UTC
 *
 * @property integer utalvany_id
 * @property integer osszeg
 */
class Utalvanytetel extends Model
{
    use SoftDeletes;

    public $table = 'utalvanytetel';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'utalvany_id',
        'osszeg'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'utalvany_id' => 'integer',
        'osszeg' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'utalvany_id' => 'required',
        'osszeg' => 'required'
    ];

    public function utalvany() {
        return $this->belongsTo('App\Models\Utalvany');
    }

}
