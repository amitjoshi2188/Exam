@extends('layouts.app')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="create" class="btn btn-primary">Add new company.</a>
                        <h1>Companies Listing</h1>
                        @if (count($companies) > 0)
                            <div class="card">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Website</th>
                                            <th>Logo</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @foreach ($companies as $post)
                                        <tr>
                                            <td>{{ $post->id }}</td>
                                            <td>{{ $post->name }}</td>
                                            <td>{{ $post->email }}</td>
                                            <td>{{ $post->website }}</td>
                                            <td>
                                                <img class="img-thumbnail imagePreview"
                                                    src="{{ asset('storage/logo/' . $post->logo) }}"
                                                    alt="{{ asset('storage/logo/' . $post->logo) }}">
                                            </td>
                                            <td>{{ $post->created_at }}</td>
                                            <td>
                                                <a class="btn btn-primary" href="/home/{{ $post->id }}/edit"
                                                    class="btn btn-default">Edit</a>

                                                <button class="btn btn-danger"
                                                    onclick="deleteCompany({{ $post->id }});"
                                                    data-id="{{ $post->id }}">Delete</button>

                                            </td>
                                        </tr>
                                    @endforeach

                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Website</th>
                                            <th>Logo</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        @else
                            <h3>No record found.</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
