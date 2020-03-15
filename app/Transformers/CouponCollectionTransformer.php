<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class CouponCollectionTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($data)
    {
        return [
            'id' => $data->id,
            'title' => $data->title,
            'link' => $data->link,
            'amount' => $data->amount,
            'brand' => $data->brand ? $data->brand->name : '',
            'type' => $data->type,
            'expire_at' => $data->expire_at
        ];
    }
}
