<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $brand->title }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $brand->description }}</p>
</div>

<!-- Categroy Id Field -->
<div class="form-group">
    {!! Form::label('categroy_id', 'Categroy Id:') !!}
    <p>{{ $brand->categroy_id }}</p>
</div>

<!-- Website Field -->
<div class="form-group">
    {!! Form::label('website', 'Website:') !!}
    <p>{{ $brand->website }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $brand->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $brand->updated_at }}</p>
</div>

