@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    اضافة صف جديد
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    اضافة صف جديد
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="mb-30" action="{{ route('Classrooms.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <div class="col-6">
                            <label for="Name" class="mr-sm-2">{{ trans('My_Classes_trans.Name_class') }}
                                :</label>
                            <input class="form-control" type="text" value="{{ old('Name') }}" name="Name" />
                        </div>
                        <div class="col-6">
                            <label for="Name" class="mr-sm-2">{{ trans('My_Classes_trans.Name_class_en') }}
                                :</label>
                            <input class="form-control" type="text" name="Name_class_en"
                                value="{{ old('Name_class_en') }}" />
                        </div>


                        <div class="col-6">
                            <label for="Name_en" class="mr-sm-2">{{ trans('My_Classes_trans.Name_Grade') }}
                                :</label>

                            <div class="box">
                                <select class="fancyselect w-100" required name="Grade_id">
                                    @foreach ($Grades as $Grade)
                                        <option value="{{ $Grade->id }}">
                                            {{ $Grade->Name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="col-6">
                            <label for="Name_en" class="mr-sm-2">{{ trans('My_Classes_trans.Subject_of_class') }}
                                :</label>

                            <div class="box">
                                <select class="select2 w-100" required name="subject_id[]" multiple>
                                    @foreach ($subjects as $sub)
                                        <option value="{{ $sub->id }}">
                                            {{ $sub->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>


                    </div>
                    <button type="submit" class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
