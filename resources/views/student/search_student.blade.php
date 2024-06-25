@extends('layouts')
@section('title', 'Student')
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
    </style>
    <div class="container-form">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('view-students') }}" method="GET">
            <div class="form-group mb-3">
                <label for="standard" class="form-label">Select Standard:</label>
                <select name="standard" id="standard" class="form-select">
                    <option value="">Select Standard</option>
                    @foreach (range(1, 12) as $std)
                        <option value="{{ $std }}">{{ $std }}th</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="division" class="form-label">Select Division:</label>
                <select name="division" id="division" class="form-select">
                    <option value="">Select Division</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>

                </select>
            </div>

            <button type="submit" class="btn btn-primary">View Students</button>
        </form>

        @if (isset($students))
        <h4>Students in {{ $standard }} {{ $division }}:</h4>
        @if (isset($students) && $students->count() > 0)
    

        <table class="table container table-hover mt-2">
            <thead>
                <tr>
                    <th scope="col">Sr No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Roll No</th>
                    @foreach (optional($students->first())->subjects as $subject)
                        <th scope="col">{{ $subject['subject'] }}</th>
                    @endforeach
                    <th scope="col">Total Marks</th>
                    <th scope="col">Percentage:</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalMarks = 0;
                @endphp
                @foreach ($students as $student)
                    @php
                        $studentTotalMarks = 0;
                        $subjects = [];
                        foreach ($student->subjects as $subject) {
                            $subjects[$subject['subject']] = $subject['marks'];
                            $studentTotalMarks += $subject['marks'];
                        }
                        $totalMarks += $studentTotalMarks;
                    @endphp
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->roll_no }}</td>
                        @foreach ($students->first()->subjects as $subject)
                            <td>{{ isset($subjects[$subject['subject']])? $subjects[$subject['subject']] : '-' }}</td>
                        @endforeach
                        <td>{{ $studentTotalMarks }}</td>
                        <td>{{ number_format(($studentTotalMarks / 500) * 100, 2) }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
    <p>No students found for the selected standard and division.</p>
@endif
    @endif
    </div>
@endsection
