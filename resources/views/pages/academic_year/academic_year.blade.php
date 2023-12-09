@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Grades_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.Grades') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


    @if ($errors->any())
        <div class="error">{{ $errors->first('academic_year') }}</div>
    @endif



    <div class="col-xl-12 mb-30">
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

                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('Grades_trans.add_Year') }}
                </button>
                <br><br>

                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('Grades_trans.academic_year') }}</th>
                                <th>{{ trans('Grades_trans.start_date') }}</th>
                                <th>{{ trans('Grades_trans.end_date') }}</th>
                                <th>{{ trans('Grades_trans.status') }}</th>
                                <th>{{ trans('Grades_trans.Processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($academicYears as $academicYear)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $academicYear->academic_year }}</td>
                                    <td>{{ $academicYear->start_date }}</td>
                                    <td>{{ $academicYear->end_date }}</td>
                                    <td>
                                        @if ($academicYear->status === 1)
                                            <label
                                                class="badge badge-success">{{ trans('Grades_trans.active') }}</label>
                                        @else
                                            <label
                                                class="badge badge-danger">{{ trans('Grades_trans.inactive') }}</label>
                                        @endif

                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $academicYear->id }}"
                                            title="{{ trans('Grades_trans.Edit') }}"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $academicYear->id }}"
                                            title="{{ trans('Grades_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- edit_modal_Grade -->
                                <!-- edit_modal_Grade -->
                                <div class="modal fade" id="edit{{ $academicYear->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('Grades_trans.edit_Grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('Grades.update', 'test') }}" method="post">
                                                    {{ method_field('patch') }}
                                                    @csrf


                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label>{{ trans("Grades_trans.stage_name_ar") }}</label>
                                                            <input type="text" class="form-control" value="{{ $academicYear->getTranslation('academic_year','ar') }}" required name="Name_en">
                                                        </div>
                                                        <div class="col-6">
                                                            <label>{{ trans("Grades_trans.stage_name_en") }}</label>
                                                            <input type="text" class="form-control" value="{{ $academicYear->getTranslation('academic_year','en') }}" required name="Name_en">
                                                        </div>
                                                        <div class="col">
                                                            <label for="start_date"
                                                                class="mr-sm-2">{{ trans('Grades_trans.start_date') }}
                                                                :</label>
                                                            {{-- <input id="start_date" type="date" name="start_date" class="form-control"> --}}
                                                            <input id="start_date" type="date" name="start_date"
                                                                class="form-control" min="2020" required
                                                                value="{{ $academicYear->start_date }}">

                                                        </div>
                                                        <div class="col">
                                                            <label for="end_date"
                                                                class="mr-sm-2">{{ trans('Grades_trans.end_date') }}
                                                                :</label>
                                                            {{-- <input type="date" class="form-control" name="end_date"> --}}
                                                            {{-- <input id="end_date" type="date" name="end_date" class="form-control" min="2020" value="{{ date('Y-m-d') + 1 }}"> --}}
                                                            <input id="end_date" type="date" name="end_date"
                                                                class="form-control" min="" required
                                                                value="{{ $academicYear->end_date }}">

                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <label for="status"
                                                            class="mr-sm-2">{{ trans('Grades_trans.status') }}:</label>
                                                        <select class="form-control" name="status" required>
                                                            <option value="1"
                                                                {{ $academicYear->status == 1 ? 'selected' : '' }}>
                                                                {{ trans('Grades_trans.active') }}
                                                            </option>
                                                            <option value="0"
                                                                {{ $academicYear->status == 0 ? 'selected' : '' }}>
                                                                {{ trans('Grades_trans.inactive') }}
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <br><br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- delete_modal_Grade -->
                                <div class="modal fade" id="delete{{ $academicYear->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('Grades_trans.delete_AcademicYear') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('academic_year.destroy', 'test') }}"
                                                    method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ trans('Grades_trans.Warning_AcademicYear') }}
                                                    <input id="id" type="hidden" name="id"
                                                        class="form-control" value="{{ $academicYear->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-danger">{{ trans('Grades_trans.submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- add_modal_Grade -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('Grades_trans.add_Year') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('academic_year.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label>{{ trans("Grades_trans.stage_name_ar") }}</label>
                                <input type="text" class="form-control" required name="Name_en">
                            </div>
                            <div class="col-6">
                                <label>{{ trans("Grades_trans.stage_name_en") }}</label>
                                <input type="text" class="form-control" required name="Name_en">
                            </div>
                            <div class="col-6">
                                <label for="start_date" class="mr-sm-2">{{ trans('Grades_trans.start_date') }}
                                    :</label>
                                {{-- <input id="start_date" type="date" name="start_date" class="form-control"> --}}
                                <input id="start_date" type="date" name="start_date" class="form-control"
                                    min="2020" value="{{ date('Y-m-d') }}">

                            </div>
                            <div class="col-6">
                                <label for="end_date" class="mr-sm-2">{{ trans('Grades_trans.end_date') }}
                                    :</label>
                                {{-- <input type="date" class="form-control" name="end_date"> --}}
                                {{-- <input id="end_date" type="date" name="end_date" class="form-control" min="2020" value="{{ date('Y-m-d') + 1 }}"> --}}
                                <input id="end_date" type="date" name="end_date" class="form-control"
                                    min="{{ date('Y-m-d', strtotime('+1 year')) }}"
                                    value="{{ date('Y-m-d', strtotime('+1 year')) }}">

                            </div>
                        </div>
                        <div class="col">
                            <label for="status" class="mr-sm-2">{{ trans('Grades_trans.status') }}:</label>
                            <select class="fancyselect w-100" name="status">
                                <option value="1">{{ trans('Grades_trans.active') }}</option>
                                <option value="0">{{ trans('Grades_trans.inactive') }}</option>
                            </select>
                        </div>
                        {{-- <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{ trans('Grades_trans.Notes') }}
                            :</label>
                            <input type="date" class="form-control" name="start_date">
                    </div> --}}
                        <br><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                    <button type="submit" class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                </div>
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
