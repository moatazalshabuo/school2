@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    المواد الدراسية
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    مواد الدراسية > {{ $Teacher->Name }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    @foreach ($Teacher->TeachClassSubject as $item)
        <div class="col-xl-4 col-lg-4 col-md-4 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-success">
                                
                                <h4 class="d-inline m-1">{{ $item->subject->main_subject->name }}</h4>
                                <i class="fas fa-book" style="font-size: 25px" aria-hidden="true"></i>
                            </span>
                            <div class="m-1">
                                <span>الفصل : {{ $item->Section->Name_Section }}</span>
                            </div>
                        </div>
                        <div class="float-right text-right">
                           <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                           <button class="btn btn-warning text-white"><i class="fas fa-edit"></i></button>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{ route('student.index') }}"
                            target="_blank"><span class="text-danger">عرض البيانات</span></a>
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
