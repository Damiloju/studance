@extends('layouts.pages')

@section('content')
    @include('layouts.nav')
    <dashboard-component></dashboard-component>
@endsection

@section('styles')
    <link href="/template/assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
@endsection

@section('scripts')
    @include('partials.datatablesScrpit')
    <script src="/template/assets/plugins/custombox/dist/custombox.min.js"></script>
    <script src="/template/assets/plugins/custombox/dist/legacy.min.js"></script>
@endsection

@include('layouts.footer')

