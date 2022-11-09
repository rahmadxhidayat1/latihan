@extends('layouts.dashboard')
@section('content2')
<h3>Jurusan {{ $major->name }}</h3>
<p>Jumlah siswa {{ count ($major->students) }}</p>
<p>Jumlah siswa {{ $major->students->count() }}</p>
<table class="table table-borderless table-dark">
    <thead>
        <tr>
            <th class="table-active" scope="col">#</th>
            <th class="table-active" scope="col">Nama Siswa</th>
        </tr>
    </thead>
    <tbody>
        @foreach($major->students as $student)
            <tr class="text-start">
                <th class="table-warning text-break">{{ $loop->iteration }}</th>
                <td class="table-info">{{ $student->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection()
