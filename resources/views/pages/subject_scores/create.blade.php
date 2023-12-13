@extends('layouts.master')

@section('css')
    @toastr_css
@endsection

@section('title')
    {{ trans('main_trans.add_student') }}
@stop

@section('page-header')
@section('PageTitle')
    {{ trans('main_trans.add_student') }}
@stop
@endsection

@section('content')
<!-- row -->
<div class="row">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @error('student_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @if ($errors->has('error'))
        <div class="alert alert-danger">{{ $errors->first('error') }}</div>
    @endif

    @livewire('subjec-scores')

</div>

@toastr_js
@toastr_render
@endsection
