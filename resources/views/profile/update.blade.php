@extends('layouts.app')

@section('content-title')
    {{ Auth::user()->name }}
@endsection
@section('content-body')
    <form method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-9">
                <input type="password" name="password" class="form-control" id="password">
            </div>
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="col-sm-3 control-label">Password Confirmation</label>
            <div class="col-sm-9">
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-success pull-right">Update</button>
            </div>
        </div>
    </form>
@endsection
