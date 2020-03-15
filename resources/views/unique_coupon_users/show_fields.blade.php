<!-- Coupon Id Field -->
<div class="form-group">
    {!! Form::label('coupon_id', 'Coupon Id:') !!}
    <p>{{ $uniqueCouponUser->coupon_id }}</p>
</div>

<!-- User Field -->
<div class="form-group">
    {!! Form::label('user', 'User:') !!}
    <p>{{ $uniqueCouponUser->user }}</p>
</div>

<!-- Coupon Code Field -->
<div class="form-group">
    {!! Form::label('coupon_code', 'Coupon Code:') !!}
    <p>{{ $uniqueCouponUser->coupon_code }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $uniqueCouponUser->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $uniqueCouponUser->updated_at }}</p>
</div>

