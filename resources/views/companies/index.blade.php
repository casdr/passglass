@extends('layouts.app')

@section('content-title')
    Companies
    <a href="{{ route('companies.add') }}" class="pull-right"><i class="fa fa-plus"></i> Add</a>
@endsection
@section('content-body')
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($companies as $company)
            <tr class="pointer">
                <td>{{ $company->id }}</td>
                <td>{{ $company->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            var dta = $('table').DataTable();
            $('table tbody').on('click', 'tr', function () {
                var row = dta.row(this).data();
                var url = '{{ route('companies.view', ['company' => ':id']) }}'.replace(':id', row[0]);
                window.location.href = url;
            });
        });
    </script>
@endsection
