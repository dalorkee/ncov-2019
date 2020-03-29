@extends('layouts.index')
@section('contents')
<div class="container">
    @include('flash::message')

    <p>Welcome to my website...</p>
</div>
@endsection
@section('bottom-script')
<script>
    $('#flash-overlay-modal').modal();
</script>
@endsection
