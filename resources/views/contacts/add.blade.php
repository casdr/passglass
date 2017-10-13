@extends('layouts.app')

@section('content-title')
    Add contact for {{ $company->name }}
@endsection
@section('content-body')
    <form method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="name" placeholder="Jan Jansen" value="{{ old('name') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">E-mail address</label>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="email" placeholder="jan@jansen.nl" value="{{ old('email') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="phone" class="col-sm-2 control-label">Phone number</label>
            <div class="col-sm-10">
                <input type="text" name="phone" class="form-control" id="phone" placeholder="+31687654321" value="{{ old('phone') }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add</button>
            </div>
        </div>
    </form>
@endsection
