@extends('layouts.app')

@section('content-title')
    Add password for {{ $company->name }}
@endsection
@section('content-body')
    <form method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="name" required="required"
                       placeholder="Application name" value="{{ old('name') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
                <input type="username" name="username" class="form-control" id="username" required="required"
                       placeholder="root" value="{{ old('username') }}">
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
                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add</button>
            </div>
        </div>
    </form>
@endsection