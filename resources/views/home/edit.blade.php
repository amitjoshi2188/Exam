@extends('layouts.app')
@section('content')
    <h1>Edit Company Details</h1>
    <div class="row">
        {!! Form::open(['action' => ['App\Http\Controllers\HomeController@update', $company->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

        <div class="form-group">
            {{ Form::label('name', 'Company Name', ['class' => 'form-label']) }}
            {{ Form::text('name', $company->name, ['class' => 'form-control', 'placeholder' => 'Enter Company Name', 'required' => 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('email', 'Company Email Address', ['class' => 'form-label']) }}
            {{ Form::email('email', $company->email, ['class' => 'form-control', 'placeholder' => 'Enter Company Email Address']) }}
        </div>

        <div class="form-group">
            {{ Form::label('website', 'Company Website', ['class' => 'form-label']) }}
            {{ Form::text('website', $company->website, ['class' => 'form-control', 'placeholder' => 'Enter Company Website Address']) }}
        </div>
        <div class="form-group">
            <input type="file" id="logo" name="logo" onchange="previewImage(this.value)">
            <img id="uploadPreview" class="imagePreview" src="{{ asset('storage/logo/' . $company->logo) }}" />
        </div>
        <div class="form-group">
            {{ Form::hidden('_method', 'POST') }}
            {{ Form::submit('Update') }}

        </div>
        {!! Form::close() !!}
    </div>


@endsection
