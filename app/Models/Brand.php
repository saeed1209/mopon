<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Brand
 * @package App\Models
 * @version March 11, 2020, 2:00 pm UTC
 *
 * @property string title
 * @property string description
 * @property integer categroy_id
 * @property string website
 */
class Brand extends Model
{
    use SoftDeletes;

    public $table = 'brands';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'description',
        'category_id',
        'website'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'category_id' => 'integer',
        'website' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'description' => 'required',
        'category_id' => 'required'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public static function get_brand($id)
    {
        return self::findOrFail($id);
    }

    public static function boot()
    {
        parent::boot();

        self::deleting(function ($brand) {
            $brand->coupons()->delete();
        });
    }
    
}
