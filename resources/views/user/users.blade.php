@extends('layout')

@section('title', 'Lista de Usuários')

@section('content')
    <div class="container mt-4">
        <h1>Lista de Usuários</h1>

        @if ($users->isEmpty())
            <p>Nenhum usuário encontrado.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Data de Criação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
