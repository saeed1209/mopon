<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Coupon
 * @package App\Models
 * @version March 11, 2020, 2:51 pm UTC
 *
 * @property string title
 * @property string link
 * @property integer amount
 * @property integer brand_id
 * @property string coupon_code
 * @property string type
 * @property string expire_at
 */
class Coupon extends Model
{
    use SoftDeletes;

    const SUGGESTION = 'suggestion';
    const NORMAL = 'normal';
    const UNIQUE = 'unique';

    public $table = 'coupons';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'link',
        'amount',
        'brand_id',
        'coupon_code',
        'type',
        'expire_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'link' => 'string',
        'amount' => 'integer',
        'brand_id' => 'integer',
        'coupon_code' => 'string',
        'type' => 'string',
        'expire_at' => 'timestamp'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'amount' => 'required',
        'brand_id' => 'required',
        'type' => 'required|in:'.self::SUGGESTION.','.self::NORMAL.','.self::UNIQUE
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function unique_coupons()
    {
        return $this->hasMany(UniqueCouponUser::class);
    }

    public static function boot()
    {
        parent::boot();

        self::deleting(function ($coupon) {
            $coupon->unique_coupons()->delete();
        });
    }
}
