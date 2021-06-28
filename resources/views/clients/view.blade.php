@extends('layouts.master')

@section('title')
	Client Profile: {{ $client->first_name }}
@endsection

@section('content')
Client Profile: <span class="text-info">{{ $client->first_name }}</span>

<div class="card-box">
    <div class="card-title">
        First Name: <span class="label label-info btn-rounded">{{ $client->first_name }}</span>
    </div>
    <div class="m-t-20 m-b-15">
		Last Name: <span class="label label-info btn-rounded">{{ $client->last_name }}</span>
	</div>
	<div class="m-b-15">
		Email: <span class="text-black bold">{{ $client->email }}</span>
	</div>
    <div class="m-b-15">
		Profiled Date: <span class="text-black bold">{{ $client->date_profiled }}</span>
	</div>
    <div class="m-b-15">
		Primary Legal Counsel: <span class="text-black bold">{{ $client->primary_legal_counsel }}</span>
	</div>
    <div class="m-b-15">
		Date of Birth <span class="text-black bold">{{ $client->date_of_birth }}</span>
	</div>
    <div class="m-b-15">
		Case Details: <span class="text-black bold">{{ $client->case_details }}</span>
	</div>

    <div class="f13 m-b-15"><b>Profile Image
      <img width="22" height="22" alt="" src="{{ asset('images/avatars/'.$client->profile_image) }}" style="border-radius:50%" class="m-l-5">
      <span class="">{{ $client->profile_image }}</span>
      </b>
    </div>

    <div class="">
      {!! nl2br($client->Description) !!}
    </div>
  </div>
  @endsection
