@extends('layouts.app')

@section('content-title')
    <a href="{{ route('companies.view', ['company' => $password->company]) }}">{{ $password->company->name }}</a>
    -
    {{ $password->name }}
    <a href="{{ route('passwords.update', ['password' => $password]) }}" class="pull-right btn btn-primary btn-xs">Update</a>
@endsection
@section('content-body')
    @if(!$password->sealed)
        <div class="alert alert-danger">
            <p><b>NOTE:</b> The status of this password is unsealed. Please update as soon as possible.</p>
        </div>
    @endif
    <table class="table table-responsive">
        <tbody>
        <tr>
            <td><b>Username:</b></td>
            <td>{{ $password->username }}</td>
        </tr>
        </tbody>
    </table>

    <h3>Content</h3>
    <div id="password-block" class="alert alert-warning">
        <p><a href="javascript:void(0);" id="password-click">Click here</a> if you want to view the password.
        </p>
        <p><b>NOTE:</b> All users will be notified of this action @if($password->sealed)and the seal status will be set
            to Unsealed @endif.
        </p>
    </div>
    <div id="password-view" style="display:none;">
        @if($password->sealed)<b>Status has been set to unsealed.</b>@endif
        <pre id="password-content">Loading...</pre>
    </div>

    <h3>Log entries</h3>
    <table class="table table-striped" id="log-entries">
        <thead>
        <tr>
            <th>Date</th>
            <th>User</th>
            <th>IP</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($password->logEntries()->orderBy('created_at', 'DESC')->get() as $log)
            <tr>
                <td>{{ $log->created_at }}</td>
                <td>{{ $log->user->name }}</td>
                <td>{{ $log->ip_address }}</td>
                <td>{{ $log->description }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            var dta = $('#log-entries').DataTable({
                order: [[0, 'desc']]
            });

            $('#password-click').click(function () {
                $('#password-block').hide();
                $('#password-view').show();
                $.get('{{ route('passwords.decrypt', ['password' => $password]) }}')
                    .done(function (password) {
                        $('#password-content').text(password);
                    });
            });
        });
    </script>
@endsection
