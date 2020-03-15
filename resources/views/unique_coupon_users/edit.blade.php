@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('unique_coupon_users.index') !!}">Unique Coupon User</a>
          </li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
    <div class="container-fluid">
         <div class="animated fadeIn">
             @include('coreui-templates::common.errors')
             <div class="row">
                 <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Edit Unique Coupon User</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($uniqueCouponUser, ['route' => ['unique_coupon_users.update', $uniqueCouponUser->id], 'method' => 'patch']) !!}

                              @include('unique_coupon_users.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection