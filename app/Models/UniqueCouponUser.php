<?php

namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UniqueCouponUser
 * @package App\Models
 * @version March 11, 2020, 3:58 pm UTC
 *
 * @property integer coupon_id
 * @property integer user
 * @property string coupon_code
 */
class UniqueCouponUser extends Model
{
    use SoftDeletes;

    public $table = 'unique_coupon_users';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'coupon_id',
        'user_id',
        'coupon_code'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'coupon_id' => 'integer',
        'user_id' => 'integer',
        'coupon_code' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'coupon_id' => 'required',
        'user_id' => 'required'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
