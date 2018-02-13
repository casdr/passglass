@extends('layouts.app')

@section('content-title')
    {{ $company->name }}
@endsection
@section('content-body')
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#contacts">Contacts</a></li>
        <li><a data-toggle="tab" href="#passwords">Passwords</a></li>
    </ul>

    <div class="tab-content">
        <div id="contacts" class="tab-pane fade in active">
            <h4>Contacts <small><a href="{{ route('contacts.add', ['company' => $company]) }}"><i class="fa fa-plus"></i> Add contact</a></small></h4>
            <table class="table" id="contactsTable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>E-mail address</th>
                    <th>Phone number</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($company->contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td><a href="javascript:void(0);" class="contact-delete" id="contact-{{ $contact->id }}" name="{{ $contact->name }}">Delete</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div id="passwords" class="tab-pane fade">
            <h4>Passwords <small><a href="{{ route('passwords.add', ['company' => $company]) }}"><i class="fa fa-plus"></i> Add password</a></small></h4>
            <table class="table" id="passwordsTable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($company->passwords()->orderBy('name', 'ASC')->get() as $password)
                    <tr class="pointer{{ ($password->sealed) ? ' ' : ' danger' }}" id="password-{{ $password->id }}" name="{{ $password->name }}">
                        <td>{{ $password->name }}</td>
                        <td>{{ $password->username }}</td>
                        <td>{{ ($password->sealed) ? 'Sealed' : 'Unsealed' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#contactsTable').on('click', '.contact-delete', function () {
                var id = $(this).attr('id').replace('contact-', '');
                var name = $(this).attr('name');

                if(confirm("Are you sure you want to remove the contact " + name + "?")) {
                    window.location.href = '{{ route('contacts.delete', ['contact' => ":contact"]) }}'.replace(':contact', id);
                }
            });
            $('#passwordsTable').on('click', 'tr', function () {
                var id = $(this).attr('id').replace('password-', '');
                var name = $(this).attr('name');
                window.location.href = '{{ route('passwords.view', ['password' => ':id']) }}'.replace(':id', id);
            });
        });
    </script>
@endsection
