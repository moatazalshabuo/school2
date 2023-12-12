<!-- edit.blade.php -->
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
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@section('content')
    <div class="container">
        <h2>Edit Subject Score</h2>
        <form method="post" action="{{ route('subject-scores.update', $displayedScore->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="score">Score:</label>
                <input type="number" class="form-control"  name="score" value="{{ $displayedScore->score }}">
            </div>
            <!-- Add other form fields as needed -->

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
