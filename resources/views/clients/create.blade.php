@extends('layouts.master')

@section('page-title')
  Create Client Profile
@endsection

@section('title')
  Create Client Profile
@endsection

@section('content')
    <div class="panel-body">
        <h5>Add New Client</h5>
            @include('errors.list')
            <form action="{{ route('store_client') }}" method="post" enctype="multipart/form-data">
            @csrf
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
                            {{ Form::label('last_name', 'First Name') }}
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
                            {{ Form::label('date_profiled', 'First Name') }}
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
                            {{ Form::label('case_details', 'Enter Case Details') }}
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
                                {{ Form::submit( 'Submit', [ 'class' => 'btn btn-complete ' ]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div>
@endsection
