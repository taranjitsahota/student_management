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
  background-color: #b1d8ab; /* light gray background */
}

.table th, .table td {
  color: #333; /* dark text color */
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
                    <th scope="col">Subject</th>
                    <th scope="col">Marks</th>
                    <th scope="col">Actions</th>
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
                        <td>{{ $student->subject }}</td>
                        <td>{{ $student->marks }}</td>
                    
                        <td>
                            <a href="editstudent/{{ $student->id }}" class="btn btn-dark btn-sm">Edit</a>
                            <a href="deletestudent/{{ $student->id }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>

@endsection
