@extends('layouts.app')

@section('content')
    <div class="col-md-12 mt-5">
        <h1>Search cities</h1>
        <cities-component></cities-component>
    </div>
@endsection

@push('js')
<script src="https://maps.googleapis.com/maps/api/js?key={{config('app.google_places')}}&libraries=places"></script>
<script src="{{mix('/js/app.js')}}"></script>
@endpush
