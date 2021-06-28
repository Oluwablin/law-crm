@extends('layouts.master')

@section('title')
  Clients
@endsection

@section('button')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
 <a style="margin: 19px;" href="{{ route('client_create') }}" class="btn btn-primary">Add New Client</a>
  </div>
  </div>
@endsection

@section('content')
<div class="col-sm-12">
@if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @else($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
@endif
</div>
<div class="container-fluid container-fixed-lg bg-white">
    <!-- START PANEL -->
    <div class="panel panel-transparent">
        <div class="panel-heading">
            <div class="panel-title">
                All Clients
            </div>
            <div class="mx-auto pull-right">
            <div class="">
                <form action="{{ route('client_index') }}" method="GET" role="search">

                    <div class="input-group">
                        <span class="input-group-btn mr-5 mt-1">
                            <button class="btn btn-info" type="submit" title="Search clients">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>
                        <input type="text" class="form-control mr-2" name="search" placeholder="Search Clients by Lastname" id="search">
                        <a href="{{ route('client_index') }}" class=" mt-1">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button" title="Refresh page">
                                    <span class="fas fa-sync-alt"></span>
                                </button>
                            </span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
        </div>
            <div class="clearfix">
            </div>
        </div>
        <div class="panel-body">
            <table class="table tableWithSearch">
                <tr>
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
                        Actions
                    </th>
                </tr>

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

