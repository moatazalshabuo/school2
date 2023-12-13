<div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">
            <form method="post" action="{{ url('/subject-scores') }}">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                                <div class="form-group">
                                    <label for="grade_id">{{ trans('Grade') }} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="grade_id">
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    <div class="col-md-3">
                                <div class="form-group">
                                    <label for="stage_id">{{ trans('Stage') }} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="stage_id">
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($stages as $stage)
                                            <option value="{{ $stage->id }}">{{ $stage->Name_Class	 }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    {{-- <div class="col-md-3">
                                <div class="form-group">
                                    <label for="section_id">{{ trans('Section') }} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="section_id">
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->Name_Section }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="student_id">{{ trans('Student') }} : <span class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="student_id">
                                <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subject_id">{{ trans('Subject') }} : <span class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="subject_id" wire:change="">
                                <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ trans('Score') }} :</label>
                            <input class="form-control" type="number" name="score">
                        </div>
                    </div>
                </div>
                <button class="btn btn-success btn-sm nextBtn btn-lg pull-left" type="submit">Submit</button>
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

                        {{-- 
                            @forelse ($displayedScores as $index => $displayedScore)
                                @if ($displayedScore->student_id != $previousStudentId)
                                    <tr class="student-row">
                                        <td>{{ $displayedScore->student->name }}</td>
                                        <td colspan="2"></td>
                                    </tr>
                                @endif
                                <tr>
                                    <td></td>
                                    <td>{{ $displayedScore->subject->name }}</td>
                                    <td>{{ $displayedScore->score }}</td>
                                    <td>
                                        <a href="{{ route('subject-scores.edit', $displayedScore->id) }}"
                                            class="btn btn-primary">Edit</a>
                                        <form action="{{ route('subject-scores.destroy', $displayedScore->id) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>

                                </tr>

                                @php $previousStudentId = $displayedScore->student_id; @endphp

                                @if ($loop->last)
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="3">No scores to display</td>
                                </tr>
                            @endforelse --}}

                        @foreach ($students as $item)
                            <tr class="student-row">
                                <td>{{ $item->name }}</td>
                                <td colspan="2"></td>
                            </tr>
                            @foreach ($item->subject_score as $val)
                                <tr>
                                    <td></td>
                                    <td>{{ $val->subject->name }}</td>
                                    <td>{{ $val->score }}</td>
                                    <td>
                                        <a href="{{ route('subject-scores.edit', $val->id) }}"
                                            class="btn btn-primary">Edit</a>
                                        <form action="{{ route('subject-scores.destroy', $val->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>

                </table>
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
