@extends('layouts.master')

@section('title')
  Clients
@endsection

@section('buttons')
  <a href="{{ route('client_create') }}" class="btn btn-sm btn-info btn-rounded">Add New Client</a>
@endsection

@section('content')
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @else(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif
<div class="container-fluid container-fixed-lg bg-white">
    <!-- START PANEL -->
    <div class="panel panel-transparent">
        <div class="panel-heading">
            <div class="panel-title">
                All Clients
            </div>
            <div class="pull-right">
                <div class="col-xs-12">
                    <input class="search-table form-control pull-right" placeholder="Search" type="text">
                    </input>
                </div>
            </div>
            <div class="clearfix">
            </div>
        </div>
        <div class="panel-body">
            <table class="table tableWithSearch">
                <thead>
                    <th>
                        First Name
                    </th>
                    <th>
                        Last Name
                    </th>
                    <th>
                        Email Address
                    </th>
                    <th>
                        Profiled Date
                    </th>
                    <th>
                        Primary Legal Counsel
                    </th>
                    <th>
                        Date of Birth
                    </th>
                    <th>
                        Details of Case
                    </th>
                    <th>
                        Profile Image
                    </th>
                    <th colspan="2">
                    </th>
                </thead>
                <tbody>
                @if($clients->count() > 0)
                        @foreach ($clients as $client)
                        <tr>
                            <td>
                                {{ $client->first_name }}
                            </td>
                            <td>
                                {{ $client->last_name }}
                            </td>
                            <td>
                                {{ $client->email }}
                            </td>
                            <td>
                                {{ $client->date_profiled }}
                            </td>
                            <td>
                                {{ $client->primary_legal_counsel }}
                            </td>
                            <td>
                                {{ $client->date_of_birth }}
                            </td>
                            <td>
                                {{ $client->case_details }}
                            </td>
                            <td>
                                {{ $client->profile_image }}
                            </td>
                            <td class="actions">
                                <a class="btn btn-sm btn-rounded btn-primary" href="{{ route('client_view',[$client->id]) }}">
                                    View
                                </a>
                                <a class="btn btn-sm btn-rounded btn-primary" href="{{ route('client_edit',[$client->id]) }}">
                                    Edit
                                </a>
                                <form method="POST" action="/client/{{$client->id}}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="submit" class="btn btn-danger delete-client" value="Delete client">
                                </input>
                                </form>
                            </td>

                        </tr>
                        @endforeach
                        @else{{ 'No Clients Available' }}
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <!-- END PANEL -->
</div>
{{ $clients->links() }}
@endsection
<script>
    $('.delete-client').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if (confirm('Are you sure?')) {
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        }
    });
</script>

