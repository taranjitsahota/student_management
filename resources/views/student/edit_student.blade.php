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
        dd($standards);
    @endphp --}}
    <div class="container-form">
        <h3>Edit Form</h3>
        <div>
            <form method="POST" id="student_form" action="" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="col-md-4">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $students->name }}">
                    <span class="error-message" id="name-error"></span>
                </div>
                <div class="col-md-4">
                    <label for="age" class="form-label">Age</label>
                    <input type="text" class="form-control" name="age" id="age" value="{{ $students->age }}">
                    <span class="error-message" id="age-error"></span>
                </div>
                <div class="col-md-4">
                    <label for="standard" class="form-label">Standard</label>
                    <select class="form-select" value="{{ $students->standard }}" name="standard" id="standard">
                        <option value="">...</option>
                        @foreach ($standards as $standard)
                            <option value="{{ $standard->id }}" {{ $standard->id == $students->standard ? 'selected' : '' }}>{{ $standard->standard }}</option>
                        @endforeach
                    </select>
                    <span class="error-message" id="standard-error"></span>
                </div>
                <div class="col-md-3">
                    <label for="division" class="form-label">Division</label>
                    <select class="form-select"  name="division" id="division">
                        <option selected disabled value="">Choose...</option>
                        <option value="{{ $students->division == 'A' ? 'selected' : '' }}">A</option>
                        <option value="{{ $students->division == 'B' ? 'selected' : '' }}">B</option>
                        <option value="{{ $students->division == 'C' ? 'selected' : '' }}">C</option>
                        <option value="{{ $students->division == 'D' ? 'selected' : '' }}">D</option>
                    </select>
                    <span class="error-message" id="division-error"></span>
                </div>
                <div class="col-md-6">
                    <label for="roll_no" class="form-label">Roll No</label>
                    <input type="text" class="form-control" name="roll_no" id="roll_no"
                        value="{{ $students->roll_no }}">
                    <span class="error-message" id="rollno-error"></span>

                </div>
                <div class="col-12">
                    <div id="subjectList">
                        <!-- Container for dynamically added subjects -->
                        @foreach ($subjects as $subject)
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <input type="text" name="subject[{{ $loop->index + 1 }}][name]" class="form-control"
                                        placeholder="Subject Name" value="{{ $subject->subjectname }}">
                                </div>
                                <div class="col-md-4">
                                    <input type="number" name="subject[{{ $loop->index + 1 }}][marks]" class="form-control"
                                        placeholder="Marks" value="{{ $subject->marks }}">
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-danger removeSubject">Remove</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12">
                    <button type="button" id="addSubject" class="btn btn-success">+ Add Subject</button>
                </div>
                <span class="error-message" id="addSubject-error"></span>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Submit form</button>
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
                var errors = false;

                if (name.length < 1) {
                    $('#name-error').text('Name is required');
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

                if ($('#subjectList').children().length < 1) {
                    $('#addSubject-error').text('At least one subject is required');
                    errors = true;
                }

                if (errors) {
                    return;
                }


                $.ajax({
                    type: "POST",
                    url: "{{ route('storestudent') }}",
                    data: new FormData(this),
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // alert('data inserted');
                        window.location = "{{ route('studentdata') }}"
                        // $('#name').val('');
                        // $('#registeremail').val('');
                        // $('#registerpassword').val('');
                        // $('#registration_success').text('Registration successful! Please login.');
                        // // Transition to login form
                        // $('#tab-1').prop('checked', true); // Activate the Login tab
                        // $('.login').css('transform', 'rotateY(0)'); // Show the Login form
                        // $('.sign-in').prop('checked',
                        // true); // Ensure Sign-In radio button is selected

                        // // Optionally, you can show a success message or perform other actions
                        // console.log('Registration successful');
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            if (errors.roll_no) {
                                $('#rollno-error').text(errors.roll_no[0]);
                            }
                            // Handle other validation errors similarly
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
                    <input type="text" name="subject[${subjectIndex}][name]" class="form-control" placeholder="Subject Name">
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
