@extends('layouts.admin')

@section('content')
        <div class="col bg-success h-100 overflow-auto">
            @if ($errors->any())
                <div class="alert alert-danger ms-2 mt-3 w-50" role="alert">
                    @foreach ($errors->all() as $error)
                        {{$error}}
                    @endforeach
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger ms-2 mt-3 w-50" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success ms-2 mt-3 w-50" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="mt-3 ms-2 w-50 p-3 bg-light shadow">
                <h2>Aggiungi Technology<i class="fa-solid fa-plus"></i></h2>
                <form class="d-flex" action="{{ route('admin.technologies.store') }}" method="POST">
                    @csrf
                    <input class="form-control w-25 mx-1" type="text" placeholder="Name" name="name">
                    <button type="submit" class="btn btn-outline-success mx-1">Aggiungi</button>
                </form>
            </div>
            <table class="table mt-3 ms-2 w-50 shadow">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($technologies as $technology)
                        <tr>
                            <th scope="row">{{ $technology->id }}</th>
                            <td>
                                <form action="{{ route('admin.technologies.update', $technology) }}" method="POST" id="form-edit-{{ $technology->id }}">
                                    @csrf
                                    @method('PUT')
                                    <input class="imp_reed" type="text" value="{{ $technology->name }}" name="name" id="{{ $technology->name }}">
                                </form>
                            </td>
                            <td class="d-flex justify-content-end">
                                <button class="btn btn-warning mx-1" onclick="submitForm({{ $technology->id }})"><i class="fa-solid fa-pen"></i></button>
                                <form action="{{ route('admin.technologies.destroy', $technology) }}" method="POST" onsubmit="return confirm('Sicuro di voler eliminare il progetto {{ $technology->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mx-1" href="#"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            function submitForm(id){
                const form = document.getElementById(`form-edit-${id}`);
                form.submit();
            }
        </script>
@endsection
