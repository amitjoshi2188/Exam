@extends('layouts.app')
@section('content')
    <h1>Create Company page</h1>
    <div class="row">
        {!! Form::open(['action' => 'App\Http\Controllers\HomeController@store', 'id' => 'createCompany', 'name' => 'createCompany', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{ Form::label('name', 'Company Name', ['class' => 'form-label']) }}
            {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Enter Company Name', 'required' => 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('email', 'Company Email Address', ['class' => 'form-label']) }}
            {{ Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Enter Company Email Address']) }}
        </div>

        <div class="form-group">
            {{ Form::label('website', 'Company Website', ['class' => 'form-label']) }}
            {{ Form::text('website', '', ['class' => 'form-control', 'placeholder' => 'Enter Company Website Address']) }}
        </div>
        <div class="form-group">
            <input type="file" id="logo" name="logo" onchange="previewImage(this.value)">
            <img id="uploadPreview" class="imagePreview" src="{{ asset('storage/logo/default.jpg') }}" />
        </div>
        <div class="form-group">
            {{ Form::submit('Submit') }}

        </div>
        {!! Form::close() !!}
    </div>


@endsection
