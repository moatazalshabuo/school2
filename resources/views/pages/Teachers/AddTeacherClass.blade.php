@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Teacher_trans.Add_Teacher') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Teacher_trans.Add_Teacher') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if (session()->has('error'))
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
                        <form action="{{ route('teacher_class.store') }}" method="post">
                            @csrf
                            <div class="repeater">
                                <div data-repeater-list="List_Classes">
                                    <div data-repeater-item>
                                        <div class="form-row">
                                            <div class="col-6 my-2">
                                                <label for="title">{{ trans('Teacher_trans.Name_Teacher') }}</label>
                                                <select name="teacher" required class="form-control subject select2">
                                                    @foreach ($Teachers as $item)
                                                        <option value="{{ $item->id }}">{{ $item->Name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('teacher')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6 my-2">
                                                <label for="title">{{ trans('Teacher_trans.Subject') }}</label>
                                                <select name="subject" required class="form-control subject select2">
                                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...
                                                    </option>
                                                    @foreach ($subject as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->main_subject->name }} - {{ $item->class_room->Name_Class }}</option>
                                                    @endforeach
                                                </select>
                                                @error('subject')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6 my-2 class-div">
                                                <label for="title">{{ trans('Teacher_trans.Class') }}</label>
                                                <select name="class" required class="form-control subject select2">
                                                </select>
                                                @error('class')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6 my-2">
                                                <label for="title">{{ trans('Teacher_trans.Academy_year') }}</label>
                                                <select name="academy" required class="form-control subject select2">
                                                    @foreach ($year as $item)
                                                        <option value="{{ $item->id }}">{{ $item->academic_year }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('academy')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <label for="Name_en"
                                                    class="mr-sm-2">{{ trans('My_Classes_trans.Processes') }}
                                                    :</label>
                                                <input class="btn btn-danger btn-block" data-repeater-delete
                                                    type="button"
                                                    value="{{ trans('My_Classes_trans.delete_row') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button"
                                            value="{{ trans('My_Classes_trans.add_row') }}" />
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{ trans('Parent_trans.Next') }}</button>
                        </form>
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
<script>
    $(document).ready(function() {
        $(document).on('change', '.subject', function() {
            console.log($(this).val());
            var Grade_id = $(this).val();
            var nextSelect = $(this).parent().next('.class-div').children('select').eq(0);
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('Get_sections_cl') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        nextSelect.empty();
                        nextSelect.append(
                            '<option selected disabled >{{ trans('Parent_trans.Choose') }}...</option>'
                        );
                        $.each(data, function(key, value) {
                            nextSelect.append(
                                '<option value="' + key + '">فصل ' + value +
                                '</option>');
                        });

                    },
                });
            } else {
                console.log('AJAX load did not work');
            }

        });
    });
</script>
@endsection
