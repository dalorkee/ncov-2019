@extends('layouts.index')
@section('contents')
<div class="container">
    @include('flash::message')
	<br>
	<br>
	<P>โอ่ โอ นายแน่มาก </p>
    <p>Welcome to my website...</p>
</div>
@endsection
@section('bottom-script')
<script>
    $('#flash-overlay-modal').modal();
</script>
@endsection
