@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                </tr>
                            </thead>
                            @foreach ($categories as $category)
                            <tbody>
                                <tr class="">
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>

                   

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
