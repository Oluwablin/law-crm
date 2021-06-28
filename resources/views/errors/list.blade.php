@if($errors->any())
<div class="alert alert-error" role="alert">
	{{-- <p class="pull-left"><strong> ({{$errors->count()}}) {{ str_plural('error', $errors->count()) }} prevented the form from submitting</strong></p> <br> --}}
	<button class="close" data-dismiss="alert"></button>
	<div class="clearfix"></div>
	@foreach( $errors->all() as $error )
	<p>{!! $error !!}</p>
	@endforeach
</div>
@endif
