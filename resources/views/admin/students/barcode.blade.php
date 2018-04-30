@extends('layouts.pages')

@section('content')
    @include('layouts.nav')
    <div class="wrapper">
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Students Barcodes</h4>
                </div>
            </div>
            <!-- end page title end breadcrumb -->
                <div>
                    <div class="row" >
                        <div class="col-12 container text-center" style="border: 1px solid #a1a1a1;padding: 15px;width: 70%;">
                            @foreach($students as $student)
                                <img src="{{BCode1D::getBarcodePNGPath($student->matric_number, 'C39')}}" alt="barcode" />
                                <br>
                                <p>{{ $student->name }}</p>
                            @endforeach
                    </div>
                </div>

        </div> <!-- end container -->

    </div>
@endsection