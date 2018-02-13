@extends('layouts.app')

@section('content-title')
    <a href="{{ route('companies.view', ['company' => $password->company]) }}">{{ $password->company->name }}</a>
    -
    <a href="{{ route('passwords.view', ['password' => $password]) }}">{{ $password->name }}</a>
    - Update
@endsection
@section('content-body')
    <form method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="name" required="required"
                       placeholder="Application name" value="{{ old('name', $password->name) }}">
            </div>
        </div>
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
                <input type="username" name="username" class="form-control" id="username" required="required"
                       placeholder="root" value="{{ old('username', $password->username) }}">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password content</label>
            <div class="col-sm-10">
                <textarea name="password" class="form-control" id="password" required="required"
                          placeholder="-----BEGIN PGP MESSAGE-----
...
-----END PGP MESSAGE-----" rows="10">{{ old('password') }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Update</button>
            </div>
        </div>
        <div class="alert alert-warning">
            <b>NOTE:</b> All users will be notified of this action
        </div>
    </form>
@endsection
