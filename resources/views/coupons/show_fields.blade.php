<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $coupon->title }}</p>
</div>

<!-- Link Field -->
<div class="form-group">
    {!! Form::label('link', 'Link:') !!}
    <p>{{ $coupon->link }}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $coupon->amount }}</p>
</div>

<!-- Brand Id Field -->
<div class="form-group">
    {!! Form::label('brand_id', 'Brand Id:') !!}
    <p>{{ $coupon->brand_id }}</p>
</div>

<!-- Coupon Code Field -->
<div class="form-group">
    {!! Form::label('coupon_code', 'Coupon Code:') !!}
    <p>{{ $coupon->coupon_code }}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $coupon->type }}</p>
</div>

<!-- Expire At Field -->
<div class="form-group">
    {!! Form::label('expire_at', 'Expire At:') !!}
    <p>{{ $coupon->expire_at }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $coupon->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $coupon->updated_at }}</p>
</div>

