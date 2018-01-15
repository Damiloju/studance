@extends('layouts.pages')

@section('content')
    @include('layouts.nav')
    <dashboard-component></dashboard-component>
@endsection

@section('scripts')
    @include('partials.datatablesScrpit')
@endsection

@include('layouts.footer')

