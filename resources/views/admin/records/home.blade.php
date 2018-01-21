@extends('layouts.pages')

@section('styles')
    <link href="/template/assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
@endsection

@section('content')
    @include('layouts.nav')
    <records-component></records-component>
@endsection

@include('layouts.footer')
@section('scripts')
    <script src="/template/assets/plugins/custombox/dist/custombox.min.js"></script>
    <script src="/template/assets/plugins/custombox/dist/legacy.min.js"></script>
    @include('partials.datatablesScrpit')
@endsection