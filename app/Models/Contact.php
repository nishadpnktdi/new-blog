<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Contact
 * @package App\Models
 * @version October 26, 2020, 6:05 am UTC
 *
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $message
 */
class Contact extends Model
{
    use SoftDeletes;

    public $table = 'contacts';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'phone',
        'email',
        'message'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'message' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required, string',
        'phone' => 'required, regex:/(01)[0-9]{9}/',
        'email' => 'required, email',
        'message' => 'required'
    ];

    
}
