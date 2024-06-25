@extends('layouts')

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
                            <!-- Button trigger modal -->
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true"  data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form" action="{{ route('subject_store') }}">
                        @csrf
                        <input type="hidden" name="student_id" id="student_id" value="">
                        <div class="form-group">
                            <label for="marks">Subject</label>
                            <select id="subjectname" name="subject" class="form-control">
                                <option value="">Select Subject</option>
                                <option value="Maths">Maths</option>
                                <option value="English">English</option>
                                <option value="Hindi">Hindi</option>
                                <option value="Science">Science</option>
                                <option value="Social Science">Social Science</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="marks">Marks</label>
                            <input type="text" placeholder="Enter Marks" class="form-control" id="marks" name="marks">
                        </div>
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
    <script>
        $(document).ready(function() {
            $('.add-subject').click(function() {
                var studentId = $(this).data('student-id');
                $('#student_id').val(studentId);
                $('#exampleModal').modal('show');
            });

            $("#submit").on('click', function() {
                $.ajax({
                    type: "POST",
                    url: "{{ route('subject_store') }}",
                    data: $('#form').serialize(),
                    dataType: 'json',
                    success: function(response) {
                        $('#exampleModal').modal('hide');
                        location.reload(); 
                    },
                    error: function(error) {
                        console.log('Error:', error);
                        
                    }
                });
            });
        });
    </script>
@endsection
