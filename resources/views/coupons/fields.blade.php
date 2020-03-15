<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link', 'Link:') !!}
    {!! Form::text('link', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::text('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Brand Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('brand_id', 'Brand Id:') !!}
    {!! Form::text('brand_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Coupon Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('coupon_code', 'Coupon Code:') !!}
    {!! Form::text('coupon_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type', [
    '',
    \App\Models\Coupon::SUGGESTION,
    \App\Models\Coupon::NORMAL,
    \App\Models\Coupon::UNIQUE
    ], null, ['class' => 'form-control']) !!}
</div>

<!-- Expire At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('expire_at', 'Expire At:') !!}
    {!! Form::date('expire_at', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('coupons.index') }}" class="btn btn-secondary">Cancel</a>
</div>

<div>
    {{ csrf_token() }}
</div>