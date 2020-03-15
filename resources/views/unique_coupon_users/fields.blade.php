<!-- Coupon Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('coupon_id', 'Coupon Id:') !!}
    {!! Form::select('coupon_id', $coupons, ['class' => 'form-control']) !!}
</div>

<!-- User Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user', 'User:') !!}
    {!! Form::select('user', $users, ['class' => 'form-control']) !!}
</div>

<!-- Coupon Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('coupon_code', 'Coupon Code:') !!}
    {!! Form::text('coupon_code', $line, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('unique_coupon_users.index') }}" class="btn btn-secondary">Cancel</a>
</div>
