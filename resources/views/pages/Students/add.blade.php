@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('main_trans.add_student') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.add_student') }}
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

                <form method="post" action="{{ route('Students.store') }}" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">
                        {{ trans('Students_trans.personal_information') }}</h6><br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('Students_trans.name_ar') }} : <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name_ar" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('Students_trans.name_en') }} : <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="name_en" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('Students_trans.email') }} : </label>
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('Students_trans.password') }} :</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gender">{{ trans('Students_trans.gender') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="gender_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($Genders as $Gender)
                                        <option value="{{ $Gender->id }}">{{ $Gender->Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nal_id">{{ trans('Students_trans.Nationality') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="nationalitie_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($nationals as $nal)
                                        <option value="{{ $nal->id }}">{{ $nal->Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bg_id">{{ trans('Students_trans.blood_type') }} : </label>
                                <select class="custom-select mr-sm-2" name="blood_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($bloods as $bg)
                                        <option value="{{ $bg->id }}">{{ $bg->Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ trans('Students_trans.Date_of_Birth') }} :</label>
                                <input class="form-control" type="text" id="datepicker-action" name="Date_Birth"
                                    data-date-format="yyyy-mm-dd">
                            </div>
                        </div>

                    </div>

                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">
                        {{ trans('Students_trans.Student_information') }}</h6><br>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="Grade_id">{{ trans('Students_trans.Grade') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="Grade_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($my_classes as $c)
                                        <option value="{{ $c->id }}">{{ $c->Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="Classroom_id">{{ trans('Students_trans.classrooms') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="Classroom_id">

                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="section_id">{{ trans('Students_trans.section') }} : </label>
                                <select class="custom-select mr-sm-2" name="section_id">

                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{ trans('Students_trans.academic_year') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="academic_year_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($academic_years as $academic_year)
                                        {{-- <option value="{{ $academic_year->id }}">{{ $academic_year->start_date; $academic_year->start_date; }}</option> --}}
                                        <option value="{{ $academic_year->id }}">{{ $academic_year->academic_year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div><br>

                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">
                        {{ trans('Students_trans.Student_information') }}</h6><br>
                    {{-- ------------------------- --}}
                    {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="parent_id">{{ trans('Students_trans.parent') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="parent_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($parents as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->Name_Father }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="parent_data">{{ trans('Students_trans.parent_data') }} : </label>
                                <input type="radio" id="show_parent_select" name="parent_option" value="select">
                                <label for="show_parent_select">{{ trans('Students_trans.show_select') }}</label>
                                <input type="radio" id="show_add_parent_form" name="parent_option" value="add">
                                <label for="show_add_parent_form">{{ trans('Students_trans.show_add_form') }}</label>
                            </div>
                        </div>

                        {{-- عرض سيلكت --}}
                        <div class="col-md-3" id="parent_select" style="display: none;">
                            <div class="form-group">
                                <label for="parent_id">{{ trans('Students_trans.parent') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="parent_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($parents as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->Name_Father }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- عرض نموذج إضافة بيانات --}}
                        <div class="col-xs-12" id="add_parent_form" style="display: none;">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <br>
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="title">{{ trans('Parent_trans.Email') }}</label>
                                            <input name="email_p" type="email" class="form-control">
                                            @error('Email')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label for="title">{{ trans('Parent_trans.Password') }}</label>
                                            <input type="password" name="password_p" class="form-control">
                                            @error('Password')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col">
                                            <label for="title">{{ trans('Parent_trans.Name_Father') }}</label>
                                            <input type="text"name="Name_Father" class="form-control">
                                            @error('Name_Father')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label for="title">{{ trans('Parent_trans.Name_Father_en') }}</label>
                                            <input type="text"name="Name_Father_en" class="form-control">
                                            @error('Name_Father_en')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label for="title">{{ trans('Parent_trans.Job_Father') }}</label>
                                            <input type="text"name="Job_Father" class="form-control">
                                            @error('Job_Father')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="title">{{ trans('Parent_trans.Job_Father_en') }}</label>
                                            <input type="text"name="Job_Father_en" class="form-control">
                                            @error('Job_Father_en')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col">
                                            <label
                                                for="title">{{ trans('Parent_trans.National_ID_Father') }}</label>
                                            <input type="text"name="National_ID_Father" class="form-control">
                                            @error('National_ID_Father')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label
                                                for="title">{{ trans('Parent_trans.Passport_ID_Father') }}</label>
                                            <input type="text"name="Passport_ID_Father" class="form-control">
                                            @error('Passport_ID_Father')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col">
                                            <label for="title">{{ trans('Parent_trans.Phone_Father') }}</label>
                                            <input type="text"name="Phone_Father" class="form-control">
                                            @error('Phone_Father')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label
                                                for="inputCity">{{ trans('Parent_trans.Nationality_Father_id') }}</label>
                                            <select class="custom-select my-1 mr-sm-2" name="Nationality_Father_id">
                                                <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                                                @foreach ($nationals as $National)
                                                    <option value="{{ $National->id }}">{{ $National->Name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('Nationality_Father_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col">
                                            <label
                                                for="inputState">{{ trans('Parent_trans.Blood_Type_Father_id') }}</label>
                                            <select class="custom-select my-1 mr-sm-2" name="Blood_Type_Father_id">
                                                <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                                                @foreach ($bloods as $Type_Blood)
                                                    <option value="{{ $Type_Blood->id }}">{{ $Type_Blood->Name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('Blood_Type_Father_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col">
                                            <label
                                                for="inputZip">{{ trans('Parent_trans.Religion_Father_id') }}</label>
                                            <select class="custom-select my-1 mr-sm-2" name="Religion_Father_id">
                                                <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                                                @foreach ($Religions as $Religion)
                                                    <option value="{{ $Religion->id }}">{{ $Religion->Name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('Religion_Father_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label
                                            for="exampleFormControlTextarea1">{{ trans('Parent_trans.Address_Father') }}</label>
                                        <textarea class="form-control"name="Address_Father" id="exampleFormControlTextarea1" rows="4"></textarea>
                                        @error('Address_Father')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{--  --}}
                                    <div class="col-xs-12">
                                        <div class="col-md-12">
                                            <br>

                                            <div class="form-row">
                                                <div class="col">
                                                    <label
                                                        for="title">{{ trans('Parent_trans.Name_Mother') }}</label>
                                                    <input type="text"name="Name_Mother" class="form-control">
                                                    @error('Name_Mother')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col">
                                                    <label
                                                        for="title">{{ trans('Parent_trans.Name_Mother_en') }}</label>
                                                    <input type="text"name="Name_Mother_en" class="form-control">
                                                    @error('Name_Mother_en')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-3">
                                                    <label
                                                        for="title">{{ trans('Parent_trans.Job_Mother') }}</label>
                                                    <input type="text"name="Job_Mother" class="form-control">
                                                    @error('Job_Mother')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label
                                                        for="title">{{ trans('Parent_trans.Job_Mother_en') }}</label>
                                                    <input type="text"name="Job_Mother_en" class="form-control">
                                                    @error('Job_Mother_en')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col">
                                                    <label
                                                        for="title">{{ trans('Parent_trans.National_ID_Mother') }}</label>
                                                    <input type="text"name="National_ID_Mother"
                                                        class="form-control">
                                                    @error('National_ID_Mother')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col">
                                                    <label
                                                        for="title">{{ trans('Parent_trans.Passport_ID_Mother') }}</label>
                                                    <input type="text"name="Passport_ID_Mother"
                                                        class="form-control">
                                                    @error('Passport_ID_Mother')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col">
                                                    <label
                                                        for="title">{{ trans('Parent_trans.Phone_Mother') }}</label>
                                                    <input type="text"name="Phone_Mother" class="form-control">
                                                    @error('Phone_Mother')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                            </div>


                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label
                                                        for="inputCity">{{ trans('Parent_trans.Nationality_Father_id') }}</label>
                                                    <select
                                                        class="custom-select my-1 mr-sm-2"name="Nationality_Mother_id">
                                                        <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                                                        @foreach ($nationals as $National)
                                                            <option value="{{ $National->id }}">{{ $National->Name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('Nationality_Mother_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group col">
                                                    <label
                                                        for="inputState">{{ trans('Parent_trans.Blood_Type_Father_id') }}</label>
                                                    <select
                                                        class="custom-select my-1 mr-sm-2"name="Blood_Type_Mother_id">
                                                        <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                                                        @foreach ($bloods as $Type_Blood)
                                                            <option value="{{ $Type_Blood->id }}">
                                                                {{ $Type_Blood->Name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('Blood_Type_Mother_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group col">
                                                    <label
                                                        for="inputZip">{{ trans('Parent_trans.Religion_Father_id') }}</label>
                                                    <select
                                                        class="custom-select my-1 mr-sm-2"name="Religion_Mother_id">
                                                        <option selected>{{ trans('Parent_trans.Choose') }}...
                                                        </option>
                                                        @foreach ($Religions as $Religion)
                                                            <option value="{{ $Religion->id }}">
                                                                {{ $Religion->Name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('Religion_Mother_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label
                                                    for="exampleFormControlTextarea1">{{ trans('Parent_trans.Address_Mother') }}</label>
                                                <textarea class="form-control"name="Address_Mother" id="exampleFormControlTextarea1" rows="4"></textarea>
                                                @error('Address_Mother')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


            </div>

        </div>

        {{-- ----------------------- --}}

    </div><br>

    <div class="col-md-3">
        <div class="form-group">
            <label for="academic_year">{{ trans('Students_trans.Attachments') }} : <span
                    class="text-danger">*</span></label>
            <input type="file" accept="image/*" name="photos[]" multiple>
        </div>
    </div>



    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
        type="submit">{{ trans('Students_trans.submit') }}</button>
    </form>

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
    // تحديث العرض عند تغيير اختيار المستخدم
    const showParentSelect = document.getElementById('show_parent_select');
    const showAddParentForm = document.getElementById('show_add_parent_form');
    const parentSelect = document.getElementById('parent_select');
    const addParentForm = document.getElementById('add_parent_form');

    // استمع لتغييرات اختيار المستخدم
    document.querySelectorAll('input[name="parent_option"]').forEach((radio) => {
        radio.addEventListener('change', function() {
            if (showParentSelect.checked) {
                parentSelect.style.display = 'block';
                addParentForm.style.display = 'none';
            } else if (showAddParentForm.checked) {
                parentSelect.style.display = 'none';
                addParentForm.style.display = 'block';
            }
        });
    });
</script>
@endsection
