@extends('layouts')
@section('title', 'Student Form')
@section('content')
    <style>
        .error-message {
            color: red;
            font-size: 14px;
        }
    </style>
    {{-- @php
        dd($standards);
    @endphp --}}
    <div class="container-form">
        <form method="POST" id="student_form" action="" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-md-4">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" id="name">
                <span class="error-message" id="name-error"></span>
            </div>
            <div class="col-md-4">
                <label for="age" class="form-label">Age</label>
                <input type="text" class="form-control" name="age" id="age">
                <span class="error-message" id="age-error"></span>
            </div>
            <div class="col-md-4">
                <label for="standard" class="form-label">Standard</label>
                <select class="form-select" name="standard" id="standard">
                    <option value="">...</option>
                    @foreach ($standards as $standard)
                        <option value="{{ $standard->id }}">{{ $standard->standard }}</option>
                    @endforeach
                </select>
                <span class="error-message" id="standard-error"></span>
            </div>
            <div class="col-md-3">
                <label for="division" class="form-label">Division</label>
                <select class="form-select" name="division" id="division">
                    <option selected disabled value="">Choose...</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
                <span class="error-message" id="division-error"></span>
            </div>
            <div class="col-md-6">
                <label for="roll_no" class="form-label">Roll No</label>
                <input type="text" class="form-control" name="roll_no" id="roll_no">
                <span class="error-message" id="rollno-error"></span>

            </div>
            <div class="col-12">
                <div id="subjectList">

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var addSubjectButton = document.getElementById('addSubject');
            var subjectList = document.getElementById('subjectList');
            var subjectIndex = 1;

            addSubjectButton.addEventListener('click', function() {
                var subjectCount = subjectList.children.length;
                if (subjectCount < 5) {
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
            <span class="error-message" id="subject-error"></span>

                </div>

                <div class="col-md-4">
                    <input type="number" id="marks" name="subject[${subjectIndex}][marks]" class="form-control" placeholder="Marks" maxlength="3" onchange="changeHandler(this)">
            <span class="error-message" id="marks-error"></span>

                </div>

                <div class="col-md-4">
                    <button type="button" class="btn btn-danger removeSubject">Remove</button>
                </div>
            `;
                    subjectList.appendChild(newSubjectInput);
                    subjectIndex++;
                    if (subjectList.children.length >= 5) {
                        addSubjectButton.disabled = true;
                    }
                }
            });

            subjectList.addEventListener('click', function(event) {
                if (event.target.classList.contains('removeSubject')) {
                    event.target.closest('.row.g-3').remove();
                }
            });
        });

        function changeHandler(val) {
            if (val.value < 0 || val.value > 100)
                $('#marks-error').text('Value should be between 0 to 100');
            // errors true;
            return false;
        }
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
                var subject = $('#subjectname').val().trim();
                var marks = $('#marks').val().trim();
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

                if (!division || division === "") {
                    $('#division-error').text('Division is required');
                    errors = true;
                }

                if (roll_no.length < 1) {
                    $('#rollno-error').text('Roll no is required');
                    errors = true;
                }

                // if ($('#subjectList').children().length) {
                //     $('#addSubject-error').text('At least one subject is required');
                //     errors = true;
                // }

                if (subjectCount !== 0 && subjectCount < 5) {
                    $('#addSubject-error').text('Either no subjects or at least 5 subjects are required');
                    errors = true;
                }

                if (subject.length < 1) {
                    $('#subject-error').text('Select subject');
                    errors = true;
                }

                if (marks.length < 1) {
                    $('#marks-error').text('Enter Marks');
                    errors = true;
                }

                var subjectsValid = true;
        $('#subjectList').find('.row.g-3').each(function(index, subjectRow, marksRow) {
            var subjectName = $(subjectRow).find('select[name^="subject["]').val().trim();
            var marks = $(marksRow).find('input[name^="subject["]').val().trim();

            if (subjectName.length < 1) {
                subjectsValid = false;
                $(subjectRow).find('.error-message').text('Select subject');
            }

            if (marks.length < 1) {
                subjectsValid = false;
                $(marksRow).find('.error-message').text('Enter Marks');
            }
            if (marks > 100) {
                subjectsValid = false;
                $(marksRow).find('.error-message').text('Marks not more than 100');
            }
        });

        if (!subjectsValid) {
            errors = true;
        }

        if (errors) {
            return;
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

                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        // if (errors) {
                        //     if (errors.false) {
                        //         $('#rollno-error').text(errors.roll_no[0]);
                        //     }
                        // } else {
                        //     console.error('Error:', error);
                        // }
                        if (xhr.status == 422) {
                            var errors = xhr.responseJSON;
                            if (errors && errors.error) {
                                $('#rollno-error').text(errors.error);
                            }
                        } else {
                            console.error('Error:', error);
                        }
                    }
                });
            });
        });
    </script>

@endsection
