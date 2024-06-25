@extends('layouts')
@section('title', 'Edit Form')
@section('content')
    <style>
        .error-message {
            color: red;
            font-size: 14px;
        }

        h3 {
            padding: 5px;
        }
    </style>
    {{-- @php
        dd($students);
    @endphp --}}
    {{-- @php
        dd($standards);
    @endphp --}}
    <div class="container-form">
        <h3>Edit Form</h3>
        <div>
            <form method="POST" id="student_form" action="" enctype="multipart/form-data" class="row g-3">
                @csrf
                <input type="hidden" id="student_id" name="student_id" value="{{$students['students']->id}}">
                <div class="col-md-4">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $students['students']->name }}">
                    <span class="error-message" id="name-error"></span>
                </div>
                <div class="col-md-4">
                    <label for="age" class="form-label">Age</label>
                    <input type="text" class="form-control" name="age" id="age" value="{{ $students['students']->age }}">
                    <span class="error-message" id="age-error"></span>
                </div>
                <div class="col-md-4">
                    <label for="standard" class="form-label">Standard</label>
                    <select class="form-select" value="" name="standard" id="standard">
                        <option value="">...</option>
                        @foreach ($standards as $standard)
                            <option value="{{ $standard->id }}" {{ $standard->id == $students['students']->standard ? 'selected' : '' }}>{{ $standard->standard }}</option>
                        @endforeach
                    </select>
                    <span class="error-message" id="standard-error"></span>
                </div>
                <div class="col-md-3">
                    <label for="division" class="form-label">Division</label>
                    <select class="form-select"  name="division" id="division">
                        {{-- <option value="">Choose...</option> --}}
                        <option value="A"{{ $students['students']->division == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B"{{ $students['students']->division == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C"{{ $students['students']->division == 'C' ? 'selected' : '' }}>C</option>
                        <option value="D"{{ $students['students']->division == 'D' ? 'selected' : '' }}>D</option>
                    </select>
                    <span class="error-message" id="division-error"></span>
                </div>
                <div class="col-md-6">
                    <label for="roll_no" class="form-label">Roll No</label>
                    <input type="text" class="form-control" name="roll_no" id="roll_no"
                        value="{{ $students['students']->roll_no }}">
                    <span class="error-message" id="rollno-error"></span>

                </div>
                <div class="col-12">
                    <div id="subjectList">
                        {{-- @php
                            dd($students);
                            @endphp --}}
                            @foreach ($students['subjects'] as $subject)
                            {{-- @php
                                dd($subject->subjectname);
                            @endphp --}}
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <input type="text" name="subject[{{ $loop->index + 1 }}][name]" class="form-control"
                                        placeholder="Subject Name" value="{{ $subject->subjectname}}">
                                </div>
                                <div class="col-md-4">
                                    <input type="number" name="subject[{{ $loop->index + 1 }}][marks]" class="form-control"
                                        placeholder="Marks" value="{{ $subject->marks }}">
                                </div>
                                {{-- <div class="col-md-4">
                                    <button type="button" class="btn btn-danger removeSubject">Remove</button>
                                </div> --}}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12">
                    <button type="button" id="addSubject" class="btn btn-success">+ Add Subject</button>
                </div>
                <span class="error-message" id="addSubject-error"></span>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Update form</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#student_form').on('submit', function(event) {
                event.preventDefault();


                $('.error-message').text('');


                var name = $('#name').val().trim();
                var age = $('#age').val().trim();
                var standard = $('#standard').val();
                var division = $('#division').val();
                var roll_no = $('#roll_no').val().trim();
                var subjectCount = $('#subjectList').children().length;
                var errors = false;

                if (name.length < 1) {
                    $('#name-error').text('Name is required');
                    errors = true;
                }

                if (/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(name)) {
                    $('#name-error').text('Name should not contain special characters');
                    errors = true;
                }

                if (age.length < 1) {
                    $('#age-error').text('Age is required');
                    errors = true;
                }

                if (!standard || standard === "") {
                    $('#standard-error').text('Standard is required');
                    errors = true;
                }

                // Validate Division
                if (!division || division === "") {
                    $('#division-error').text('Division is required');
                    errors = true;
                }

                if (roll_no.length < 1) {
                    $('#rollno-error').text('Roll no is required');
                    errors = true;
                }

                // if ($('#subjectList').children().length < 1) {
                //     $('#addSubject-error').text('At least one subject is required');
                //     errors = true;
                // }

                if (subjectCount !== 0 && subjectCount < 5) {
                    $('#addSubject-error').text('Either no subjects or at least 5 subjects are required');
                    errors = true;
                }

                if (errors) {
                    return;
                }


                $.ajax({
                    type: "POST",
                    url: "{{ route('updatestudent') }}",
                    data: new FormData(this),
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // alert('data inserted');
                        window.location = "{{ route('studentdata') }}"
                       
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            if (errors.roll_no) {
                                $('#rollno-error').text(errors.roll_no[0]);
                            }
                        } else {
                            console.error('Error:', error);
                        }
                    }
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            var addSubjectButton = document.getElementById('addSubject');
            var subjectList = document.getElementById('subjectList');
            var subjectIndex = 1;

            addSubjectButton.addEventListener('click', function() {
                var newSubjectInput = document.createElement('div');
                newSubjectInput.classList.add('row', 'g-3', 'mb-3');
                newSubjectInput.innerHTML = `
                 <div class="col-md-4">
                    <select id="subjectname" name="subject[${subjectIndex}][name]" class="form-control"">
                        <option value="">Select Subject</option>
                        <option value="Maths">Maths</option>
                        <option value="English">English</option>
                        <option value="Hindi">Hindi</option>
                        <option value="Science">Science</option>
                        <option value="Social Science">Social Science</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="number" name="subject[${subjectIndex}][marks]" class="form-control" placeholder="Marks">
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-danger removeSubject">Remove</button>
                </div>
            `;
                subjectList.appendChild(newSubjectInput);
                subjectIndex++;
            });

            // Event delegation to remove dynamically added subject inputs
            subjectList.addEventListener('click', function(event) {
                if (event.target.classList.contains('removeSubject')) {
                    event.target.closest('.row.g-3').remove();
                }
            });
        });
    </script>

@endsection
