{{-- @extends('layouts')

@section('title', 'View')

@section('content')
    <style>
        .table {
            border: 2px solid black;
        }

        td,
        th {
            border: 1px solid black;
        }

        .table {
            background-color: #b1d8ab;
        }

        .table th,
        .table td {
            color: #333;
        }
        .modal-backdrop {
        background-color: rgba(0, 0, 0, 0);
    }
    </style>

    <div class="container-form">
        <h3>All students</h3>
        <table class="table container table-hover mt-2">
            <thead>
                <tr>
                    <th scope="col">Sr No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Standard</th>
                    <th scope="col">Division</th>
                    <th scope="col">Roll No</th>
                    <th scope="col">Actions</th>
                    <th scope="col">Add subjects</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->age }}</td>
                        <td>{{ $student->standard }}</td>
                        <td>{{ $student->division }}</td>
                        <td>{{ $student->roll_no }}</td>

                        <td>
                            <a href="editstudent/{{ $student->id }}" class="btn btn-dark btn-sm">Edit</a>
                            <a href="deletestudent/{{ $student->id }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary add-subject" data-toggle="modal"
                                data-target="#exampleModal" data-student-id="{{ $student->id }}">
                                Add subject
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true"  data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                        @foreach ($subjects as $subject)
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <input type="text" name="subject[{{ $loop->index + 1 }}][name]" class="form-control"
                                    placeholder="Subject Name" value="{{ $subject->subjectname}}">
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="subject[{{ $loop->index + 1 }}][marks]" class="form-control"
                                    placeholder="Marks" value="{{ $subject->marks }}">
                            </div>
                        
                        </div>
                    @endforeach
                  
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   
    </script>
@endsection --}}
{{-- @extends('layouts')

@section('title', 'View Students')

@section('content')
    <style>
        .table {
            border: 2px solid black;
        }

        td,
        th {
            border: 1px solid black;
        }

        .table {
            background-color: #b1d8ab;
        }

        .table th,
        .table td {
            color: #333;
        }

        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0);
        }
    </style>

    <div class="container-form">
        <h3>All students</h3>
        <table class="table container table-hover mt-2">
            <thead>
                <tr>
                    <th scope="col">Sr No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Standard</th>
                    <th scope="col">Division</th>
                    <th scope="col">Roll No</th>
                    <th scope="col">Actions</th>
                    <th scope="col">Add subjects</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->age }}</td>
                        <td>{{ $student->standard }}</td>
                        <td>{{ $student->division }}</td>
                        <td>{{ $student->roll_no }}</td>

                        <td>
                            <a href="editstudent/{{ $student->id }}" class="btn btn-dark btn-sm">Edit</a>
                            <a href="deletestudent/{{ $student->id }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary add-subject" data-toggle="modal"
                                    data-target="#exampleModal" data-student-id="{{ $student->id }}">
                                Add subject
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="subject-list">
                    <!-- Subjects will be loaded dynamically here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="save-subjects" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.add-subject').click(function () {
                var studentId = $(this).data('student-id');
                $.ajax({
                    url: '/subject_data/' + studentId, // Replace with your route to fetch subjects
                    type: 'GET',
                    success: function (response) {
                        $('#subject-list').html(response);
                    }
                });
            });

            $('#save-subjects').click(function () {
                // Handle saving subjects here if needed
                // For example, collect data from modal fields and submit via AJAX
                // This part depends on your application logic
                alert('Save changes clicked');
            });
        });
    </script>
@endsection --}}
@extends('layouts')

@section('title', 'View Students')

@section('content')
<style>
    .table {
        border: 2px solid black;
    }

    td,
    th {
        border: 1px solid black;
    }

    .table {
        background-color: #b1d8ab;
    }

    .table th,
    .table td {
        color: #333;
    }

    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0);
    }
</style>

<div class="container-form">
    <h3>All students</h3>
    <table class="table container table-hover mt-2">
        <thead>
            <tr>
                <th scope="col">Sr No.</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Standard</th>
                <th scope="col">Division</th>
                <th scope="col">Roll No</th>
                <th scope="col">Actions</th>
                <th scope="col">Add subjects</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->age }}</td>
                    <td>{{ $student->standard }}</td>
                    <td>{{ $student->division }}</td>
                    <td>{{ $student->roll_no }}</td>

                    <td>
                        <a href="editstudent/{{ $student->id }}" class="btn btn-dark btn-sm">Edit</a>
                        <a href="deletestudent/{{ $student->id }}" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary add-subject" data-toggle="modal"
                                data-target="#exampleModal" data-student-id="{{ $student->id }}">
                            Add subject
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="subject-list">
                    <!-- Subjects will be loaded dynamically here -->
                    <div id="subjects-container"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="save-subjects" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.add-subject').click(function () {
                var studentId = $(this).data('student-id');
                $.ajax({
                    url: '{{ route("subjectdata", ":id") }}'.replace(':id', studentId),
                    type: 'GET',
                    success: function (response) {
                        if (response.error) {
                            alert(response.error);
                        } else {
                            var subjectsHtml = '';
                            response.subjects.forEach(function (subject, index) {
                                subjectsHtml += '<div class="row g-3 mb-3">' +
                                    '<div class="col-md-4">' +
                                    '<input type="text" class="form-control" placeholder="Subject Name" value="' + subject.subjectname + '">' +
                                    '</div>' +
                                    '<div class="col-md-4">' +
                                    '<input type="number" class="form-control" placeholder="Marks" value="' + subject.marks + '">' +
                                    '</div>' +
                                    '</div>';
                            });
                            $('#subjects-container').html(subjectsHtml);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert('Failed to fetch subjects: ' + error);
                    }
                });
            });

            $('#save-subjects').click(function () {
                // Handle saving subjects here if needed
                // For example, collect data from modal fields and submit via AJAX
                // This part depends on your application logic
                alert('Save changes clicked');
            });
        });
    </script>
@endsection
