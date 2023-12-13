<div class="col-md-12 mb-30">

    <div class="card card-statistics h-100">
        <div class="card-body">
            <form method="post" action="{{ url('/subject-scores') }}">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="grade_id">{{ trans('Grade') }} : <span class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" wire:model='select_grades' wire:change="change_grades"
                                name="grade_id">
                                <option selected value="">{{ trans('Parent_trans.Choose') }}...</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="stage_id">{{ trans('Stage') }} : <span class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" wire:model="select_stage" wire:change="change_stage"
                                name="stage_id">
                                <option selected value="">{{ trans('Parent_trans.Choose') }}...</option>
                                @foreach ($stages as $stage)
                                    <option value="{{ $stage->id }}">{{ $stage->Name_Class }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="section_id">{{ trans('Section') }} : <span class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" wire:model="select_section" wire:change="submitFirst"
                                name="section_id">
                                <option selected value="">{{ trans('Parent_trans.Choose') }}...</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->Name_Section }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label for="student_id">{{ trans('Student') }} : <span class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="student_id">
                                <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label for="subject_id">{{ trans('Subject') }} : <span class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="subject_id" wire:change="">
                                <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ trans('Score') }} :</label>
                            <input class="form-control" type="number" name="score">
                        </div>
                    </div> --}}
                </div>
                {{-- <button class="btn btn-success btn-sm nextBtn btn-lg pull-left" type="submit">Submit</button> --}}
            </form>

            <!-- جدول العرض -->
            <div class="mt-4">
                <h3>{{ trans('Displayed Scores') }}</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ trans('Student') }}</th>
                            <th>{{ trans('Subject') }}</th>
                            <th>{{ trans('Score') }}</th>
                            <th>{{ trans('Score') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $previousStudentId = null;
                        @endphp
                        @foreach ($students as $key1 => $item)
                            <tr class="student-row">
                                <td>{{ $item->name }}</td>
                                <td colspan="2"></td>
                            </tr>
                            @php

                            @endphp
                            @foreach ($item->subject_score as $key2 => $val)
                                <tr>
                                    <td></td>
                                    <td>{{ $val->subject->main_subject->name }}</td>
                                    <td>
                                        <input type='number'
                                            wire:model='students.{{ $key1 }}.subject_score.{{ $key2 }}.score'
                                            value="{{ $val->score }}" class="form-control">
                                    </td>
                                </tr>
                            @endforeach
                            <tr>

                                <td colspan="3">
                                    @if ($check_score[$key1])
                                        <div class="alert alert-success" id="success-alert">
                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                            {{ trans('messages.success') }}
                                        </div>
                                    @endif
                                </td>
                                <td class="text-left">
                                    <button wire:click="saveScore({{ $key1 }})" class="btn btn-primary"><i
                                            class="fa fa-check"></i> حفظ الطالب</button>
                                </td>
                            </tr>
                        @endforeach
                        @php

                        @endphp
                    </tbody>
                </table>
                @if (!empty($students))
                    <div>
                        @if (!empty($successMessage))
                            <div class="alert alert-success" id="success-alert">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                {{ $successMessage }}
                            </div>
                        @endif
                        <button wire:click="saveall" class="btn btn-success"><i class="fa fa-check"></i> حفظ
                            الكل</button>
                    </div>
                @endif
            </div>
            <!-- Add this modal structure to your HTML file -->
            <div class="modal" tabindex="-1" role="dialog" id="confirmDeleteModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this item?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
