<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class szamlatetel
 * @package App\Models
 * @version July 8, 2020, 7:26 am UTC
 *
 * @property integer szamla
 * @property integer termek
 * @property integer koltseg
 * @property integer afaszaz
 * @property number netto
 * @property number afa
 * @property number brutto
 */
class szamlatetel extends Model
{
    use SoftDeletes;

    public $table = 'szamlatetel';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'szamla',
        'termek',
        'koltseg',
        'afaszaz',
        'netto',
        'afa',
        'brutto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'szamla' => 'integer',
        'termek' => 'integer',
        'koltseg' => 'integer',
        'afaszaz' => 'integer',
        'netto' => 'float',
        'afa' => 'float',
        'brutto' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'szamla' => 'required',
        'termek' => 'required',
        'koltseg' => 'required',
        'afaszaz' => 'required',
        'netto' => 'required',
        'afa' => 'required',
        'brutto' => 'required'
    ];
}
