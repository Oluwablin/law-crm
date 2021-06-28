@extends('layouts.master')

@section('page-title')
    Update Client Profile
@endsection

@section('title')
  Update Client Profile
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
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Edit Client Profile
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($client, array('route' => array('client_update', $client->id), 'autocomplete' => 'off', 'role' => 'form', 'files' => true)) }}
		{{ method_field('PATCH') }}
		<div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('first_name', 'First Name') }}
                                    {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name']) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="controls">
                            {{ Form::label('last_name', 'Last Name') }}
                                    {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Last Name']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('email', 'Email') }}
                                    {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email Address']) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="controls">
                            {{ Form::label('date_profiled', 'Profiled Date') }}
                                    {{ Form::date('date_profiled', null, ['class' => 'form-control', 'placeholder' => 'Enter Profile Date']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('primary_legal_counsel', 'Primary Legal Counsel') }}
                                    {{ Form::text('primary_legal_counsel', null, ['class' => 'form-control', 'placeholder' => 'Enter Primary Legal Counsel']) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="controls">
                            {{ Form::label('case_details', 'Case Details') }}
                                    {{ Form::text('case_details', null, ['class' => 'form-control', 'placeholder' => 'Enter Case Details']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('profile_image', 'Profile Image') }}
                                    {{ Form::file('profile_image', null, ['class' => 'form-control', 'placeholder' => 'Upload Profile Image']) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="controls">
                            {{ Form::label('date_of_birth', 'Date of Birth') }}
                                    {{ Form::date('date_of_birth', null, ['class' => 'form-control', 'placeholder' => 'Enter Date of Birth']) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="controls">
                                <div class="m-t-25"></div>
                                {{ Form::submit( 'Update', [ 'class' => 'btn btn-complete ' ]) }}
                            </div>
                        </div>
                    </div>
                </div>
		{{ Form::close() }}
	</div>
</div>
@endsection
