@extends('layouts.app')

@section('content-title')
    Add company
@endsection
@section('content-body')
    <form method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="name" placeholder="Jan Piet B.V." value="{{ old('name') }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add</button>
            </div>
        </div>
    </form>
@endsection
