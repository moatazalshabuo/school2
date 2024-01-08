@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('main_trans.list_students') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.list_students') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-header">
                            <form action="" method="GET">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>المرحلة <span class="text-danger">*</span></label>
                                        <select class="form-control p-1" name="Grade_id" id="Grade_id" required>
                                            <option disabled selected>اختر من القائمة</option>
                                            @foreach ($Grades as $item)
                                                <option value="{{ $item->id }}">{{ $item->Name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>الصف</label>
                                        <select class="form-control p-1" name="Classroom_id" id="Classroom_id" required>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>الفصل</label>
                                        <select class="form-control p-1" name="section_id" id="section_id">

                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <button type="submet" class="btn btn-primary">عرض</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body" style="height: 400px;overflow-y:scroll">
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('Students_trans.name') }}</th>
                                            <th>{{ trans('Students_trans.email') }}</th>
                                            <th>{{ trans('Students_trans.gender') }}</th>
                                            <th>{{ trans('Students_trans.Grade') }}</th>
                                            <th>{{ trans('Students_trans.classrooms') }}</th>
                                            <th>{{ trans('Students_trans.section') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td><input type="checkbox" value="{{ $student->id }}"
                                                        class="student_check"></td>
                                                </td>
                                                <td><a
                                                        href="{{ route('card.st', $student->id) }}">{{ $student->name }}</a>
                                                </td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->gender->Name }}</td>
                                                <td>{{ $student->grade->Name }}</td>
                                                <td>{{ $student->classroom->Name_Class }}</td>
                                                <td>{{ $student->section->Name_Section }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>اختر الفصل المراد النقل اليه</label>
                                    <select class="form-control p-1" name="section_id" id="section_id_tr"></select>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-danger mt-4" id="save_tr">حفظ</button>
                                </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.3/axios.min.js"
    integrity="sha512-JWQFV6OCC2o2x8x46YrEeFEQtzoNV++r9im8O8stv91YwHNykzIS2TbvAlFdeH0GVlpnyd79W0ZGmffcRi++Bw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var ListStudents = []
    $(function() {
        $(".student_check").change(function() {
            if ($(this).is(":checked")) {
                ListStudents = ListStudents.concat($(this).val())
                console.log(ListStudents)
            } else {
                ListStudents = ListStudents.filter(item => item !== $(this).val());
            }
        })
    })
</script>

@if ($grade_id)
    <script>
        $(function() {
            $('#Grade_id').val({{ $grade_id }})
            getClasses({{ $grade_id }})
        })
    </script>
@endif



<script>
    function getClasses(id) {
        var Grade_id = id;
        if (Grade_id) {
            $.ajax({
                url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="Classroom_id"]').empty();
                    $('select[name="Classroom_id"]').append(
                        '<option selected disabled >{{ trans('Parent_trans.Choose') }}...</option>'
                    );
                    $.each(data, function(key, value) {
                        $('select[name="Classroom_id"]').append(
                            '<option value="' + key + '">' + value +
                            '</option>');
                    });
                    $('#Classroom_id').val({{ $class_id }})
                    getSection({{ $class_id }})
                },
            });
        } else {
            console.log('AJAX load did not work');
        }
    }

    function getSection(id) {
        var Classroom_id = id;
        if (Classroom_id) {
            $.ajax({
                url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="section_id"]').empty();
                    $('select[name="section_id"]').append(
                        '<option selected disabled >اختر الفصل...</option>'
                    );
                    $.each(data, function(key, value) {
                        $('select[name="section_id"]').append(
                            '<option value="' + key + '">' + value +
                            '</option>');
                    });

                },
            });
        } else {
            console.log('AJAX load did not work');
        }
    };
    $(function() {
        $("#save_tr").click(function() {
            if (ListStudents.length != 0) {
                if ($('#section_id_tr').val() != '' && $('#section_id_tr').val() != undefined && $(
                        '#section_id_tr').val() != null) {
                    axios.post("{{ route('TransformStuSec') }}", {
                        'list': ListStudents,
                        'section_id': $('#section_id_tr').val()
                    }).then((res) => {
                        location.reload()
                    })
                } else {
                    alert('يجب اختيار الفصل المراد النقل اليه')
                }
            } else {
                alert('يحب تحديد طلاب اولا')
            }
        })
    })
</script>
@toastr_js
@toastr_render
@endsection
