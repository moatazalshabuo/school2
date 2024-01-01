@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    استبعاد رسوم
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    @if ($student)
        استبعاد رسوم {{ $student->name }}
    @endif
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($student)
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{ route('ProcessingFee.store') }}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>المبلغ : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="Debit" type="number">
                                    <input type="hidden" name="student_id" value="{{ $student->id }}"
                                        class="form-control">
                                    <input type="hidden" name="fee_id" value="{{ $student->fee_id }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>على الطالب : </label>
                                    <input class="form-control" name="final_balance"
                                        value="{{ number_format($student->amount, 2) }}" type="text" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>البيان : <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                            type="submit">{{ trans('Students_trans.submit') }}</button>
                    </form>
                @else
                    <p>لم يتم اضافة الرسوم بعد</p>
                @endif
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
