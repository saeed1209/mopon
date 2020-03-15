<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUniqueCouponUserRequest;
use App\Http\Requests\UpdateUniqueCouponUserRequest;
use App\Models\Coupon;
use App\Repositories\UniqueCouponUserRepository;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Response;

class UniqueCouponUserController extends AppBaseController
{
    /** @var  UniqueCouponUserRepository */
    private $uniqueCouponUserRepository;

    public function __construct(UniqueCouponUserRepository $uniqueCouponUserRepo)
    {
        $this->uniqueCouponUserRepository = $uniqueCouponUserRepo;
    }

    /**
     * Display a listing of the UniqueCouponUser.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $uniqueCouponUsers = $this->uniqueCouponUserRepository->all();

        return view('unique_coupon_users.index')
            ->with('uniqueCouponUsers', $uniqueCouponUsers);
    }

    /**
     * Show the form for creating a new UniqueCouponUser.
     *
     * @return Response
     */
    public function create()
    {
        if(!Coupon::is_unique(request('coupon_id')))
            abort(400, 'Coupon type is not unique');

        $file = fopen("codes.txt","r");
        $line = fgets($file);
        $users = User::where('role','user')->pluck('name', 'id');
        $coupons = Coupon::where('type','unique')->pluck('title','id');
        return view('unique_coupon_users.create', compact('line', 'users', 'coupons'));
    }

    /**
     * Store a newly created UniqueCouponUser in storage.
     *
     * @param CreateUniqueCouponUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUniqueCouponUserRequest $request)
    {
        $content = file_get_contents("codes.txt");
        $file = fopen("codes.txt","r");
        $line = fgets($file);
        $replace = str_replace($line, '',$content);
        file_put_contents('codes.txt', $replace);
        $input = $request->all();

        $input['coupon_code'] = $line;

        $uniqueCouponUser = $this->uniqueCouponUserRepository->create($input);

        Flash::success('Unique Coupon User saved successfully.');

        return redirect(route('uniqueCouponUsers.index'));
    }

    /**
     * Display the specified UniqueCouponUser.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $uniqueCouponUser = $this->uniqueCouponUserRepository->find($id);

        if (empty($uniqueCouponUser)) {
            Flash::error('Unique Coupon User not found');

            return redirect(route('uniqueCouponUsers.index'));
        }

        return view('unique_coupon_users.show')->with('uniqueCouponUser', $uniqueCouponUser);
    }

    /**
     * Show the form for editing the specified UniqueCouponUser.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $uniqueCouponUser = $this->uniqueCouponUserRepository->find($id);

        if (empty($uniqueCouponUser)) {
            Flash::error('Unique Coupon User not found');

            return redirect(route('uniqueCouponUsers.index'));
        }

        return view('unique_coupon_users.edit')->with('uniqueCouponUser', $uniqueCouponUser);
    }

    /**
     * Update the specified UniqueCouponUser in storage.
     *
     * @param int $id
     * @param UpdateUniqueCouponUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUniqueCouponUserRequest $request)
    {
        $uniqueCouponUser = $this->uniqueCouponUserRepository->find($id);

        if (empty($uniqueCouponUser)) {
            Flash::error('Unique Coupon User not found');

            return redirect(route('uniqueCouponUsers.index'));
        }

        $uniqueCouponUser = $this->uniqueCouponUserRepository->update($request->all(), $id);

        Flash::success('Unique Coupon User updated successfully.');

        return redirect(route('uniqueCouponUsers.index'));
    }

    /**
     * Remove the specified UniqueCouponUser from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $uniqueCouponUser = $this->uniqueCouponUserRepository->find($id);

        if (empty($uniqueCouponUser)) {
            Flash::error('Unique Coupon User not found');

            return redirect(route('uniqueCouponUsers.index'));
        }

        $this->uniqueCouponUserRepository->delete($id);

        Flash::success('Unique Coupon User deleted successfully.');

        return redirect(route('uniqueCouponUsers.index'));
    }
}
