@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    قائمة المواد الدراسية
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    قائمة المواد الدراسية
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{route('subject.store')}}" method="post" autocomplete="off">
                            @csrf

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">اسم المادة باللغة العربية</label>
                                    <input type="text" name="Name_ar" class="form-control" value="{{old('Name_ar')}}">
                                </div>
                                <div class="col">
                                    <label for="title">اسم المادة باللغة الانجليزية</label>
                                    <input type="text" name="Name_en" class="form-control" value="{{old('Name_en')}}">
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">حفظ البيانات</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            {{-- <a href="{{ route('subjects.create') }}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">اضافة مادة جديدة</a><br><br> --}}
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم المادة</th>
                                            <th>التفاصيل</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subjects as $subject)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $subject->name }}</td>
                                                <td>{{ $subject->summry }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#edit_subject{{ $subject->id }}"
                                                        title="تعديل"><i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#delete_subject{{ $subject->id }}"
                                                        title="حذف"><i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                           {{-- edit --}}
                                           <div class="modal fade" id="edit_subject{{ $subject->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ route('subject.update', $subject->id) }}" method="post">
                                                    {{ method_field('patch') }}
                                                    {{ csrf_field() }}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">تعديل مادة دراسية</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-row">
                                                                <div class="col">
                                                                    <label for="title">اسم المادة باللغة العربية</label>
                                                                    
                                                                    <input type="text" name="Name_ar" class="form-control"value="{{ $subject->getTranslation('name','ar') }}" >
                                                                </div>
                                                                <div class="col">
                                                                    <label for="title">اسم المادة باللغة الانجليزية</label>
                                                                    <input type="text" name="Name_en" class="form-control" value="{{ $subject->getTranslation('name','en') }}">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group mt-3">
                                                                <label for="summry">{{ trans("Grades_trans.summry") }}</label>
                                                                <textarea class="form-control" id="summry" name="summry">{{ $subject->summry }}</textarea>
                                                            </div>
                                                            
                                                        </div>
                                                            {{-- <input type="text" name="name" value="{{ $subject->name }}">
                                                            <input type="text" name="summry" value="{{ $subject->summry }}"> --}}
                                                       
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                            <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        
                                            <div class="modal fade" id="delete_subject{{ $subject->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{ route('subject.destroy', 'test') }}"
                                                        method="post">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                    class="modal-title" id="exampleModalLabel">حذف مادة
                                                                    دراسية</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p> {{ trans('My_Classes_trans.Warning_Grade') }}
                                                                    {{ $subject->name }}</p>
                                                                <input type="hidden" name="id"
                                                                    value="{{ $subject->id }}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">{{ trans('My_Classes_trans.submit') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
