<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUniqueCouponUserAPIRequest;
use App\Http\Requests\API\UpdateUniqueCouponUserAPIRequest;
use App\Models\Coupon;
use App\Models\UniqueCouponUser;
use App\Repositories\CouponRepository;
use App\Repositories\UniqueCouponUserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class UniqueCouponUserController
 * @package App\Http\Controllers\API
 */

class UniqueCouponUserAPIController extends AppBaseController
{
    /** @var  UniqueCouponUserRepository */
    private $uniqueCouponUserRepository;
    private $couponRepository;

    public function __construct(UniqueCouponUserRepository $uniqueCouponUserRepo,
                                CouponRepository $couponRepo)
    {
        $this->middleware('is_admin');
        $this->uniqueCouponUserRepository = $uniqueCouponUserRepo;
        $this->couponRepository = $couponRepo;
    }

    /**
     * Display a listing of the UniqueCouponUser.
     * GET|HEAD /uniqueCouponUsers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $uniqueCouponUsers = $this->uniqueCouponUserRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($uniqueCouponUsers->toArray(), 'Unique Coupon Users retrieved successfully');
    }

    /**
     * Store a newly created UniqueCouponUser in storage.
     * POST /uniqueCouponUsers
     *
     * @param CreateUniqueCouponUserAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUniqueCouponUserAPIRequest $request)
    {
        $input = $request->all();

        if(!$this->couponRepository->find($input['coupon_id']))
            abort(404, 'Coupon id not found');

        if(!$this->couponRepository->is_unique($input['coupon_id']))
            abort(400, 'Coupon type is not unique');

        $content = file_get_contents("codes.txt");
        $file = fopen("codes.txt","r");
        $line = fgets($file);
        $replace = str_replace($line, '',$content);
        if(!$replace)
            $this->couponRepository->expire_empty_coupon($input['coupon_id']);
        file_put_contents('codes.txt', $replace);

        $input['coupon_code'] = $line;

        $uniqueCouponUser = $this->uniqueCouponUserRepository->create($input);

        return $this->sendResponse($uniqueCouponUser->toArray(), 'Unique Coupon User saved successfully');
    }

    /**
     * Display the specified UniqueCouponUser.
     * GET|HEAD /uniqueCouponUsers/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var UniqueCouponUser $uniqueCouponUser */
        $uniqueCouponUser = $this->uniqueCouponUserRepository->find($id);

        if (empty($uniqueCouponUser)) {
            return $this->sendError('Unique Coupon User not found');
        }

        return $this->sendResponse($uniqueCouponUser->toArray(), 'Unique Coupon User retrieved successfully');
    }

    /**
     * Update the specified UniqueCouponUser in storage.
     * PUT/PATCH /uniqueCouponUsers/{id}
     *
     * @param int $id
     * @param UpdateUniqueCouponUserAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUniqueCouponUserAPIRequest $request)
    {
        $input = $request->all();

        if(!$this->couponRepository->find($input['coupon_id']))
            abort(404, 'Coupon id not found');

        if(!$this->couponRepository->is_unique($input['coupon_id']))
            abort(400, 'Coupon type is not unique');

        /** @var UniqueCouponUser $uniqueCouponUser */
        $uniqueCouponUser = $this->uniqueCouponUserRepository->find($id);

        if (empty($uniqueCouponUser)) {
            return $this->sendError('Unique Coupon User not found');
        }

        $uniqueCouponUser = $this->uniqueCouponUserRepository->update($input, $id);

        return $this->sendResponse($uniqueCouponUser->toArray(), 'UniqueCouponUser updated successfully');
    }

    /**
     * Remove the specified UniqueCouponUser from storage.
     * DELETE /uniqueCouponUsers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var UniqueCouponUser $uniqueCouponUser */
        $uniqueCouponUser = $this->uniqueCouponUserRepository->find($id);

        if (empty($uniqueCouponUser)) {
            return $this->sendError('Unique Coupon User not found');
        }

        $uniqueCouponUser->delete();

        return $this->sendSuccess('Unique Coupon User deleted successfully');
    }
}
