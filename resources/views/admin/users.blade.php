@extends('adminlte::page')

@section('title', 'Daftar Pengguna')

@section('content_header')
    <h1>Daftar Pengguna</h1>
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <form action="{{ route('delete_user', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus akun ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
