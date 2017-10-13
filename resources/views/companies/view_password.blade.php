@extends('layouts.app')

@section('content-title')
    <a href="{{ route('companies.view', ['company' => $password->company]) }}">{{ $password->company->name }}</a> - {{ $password->name }}
@endsection
@section('content-body')
    <pre>{{ $password->password }}</pre>
@endsection

