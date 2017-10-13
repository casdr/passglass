@extends('layouts.app')

@section('content-title', 'Login')
@section('content-body')
    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">E-mail address</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email"
                       value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">Password</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('yubikey') ? ' has-error' : '' }}">
            <label for="yubikey" class="col-md-4 control-label">Yubikey</label>

            <div class="col-md-6">
                <input id="yubikey" type="password" class="form-control" name="yubikey" required>

                @if ($errors->has('yubikey'))
                    <span class="help-block">
                        <strong>{{ $errors->first('yubikey') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Login
                </button>
            </div>
        </div>
    </form>
@endsection
