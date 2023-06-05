@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container">
                        <h1>Users</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                </tr>
                            </thead>
                            <tbody id="users-table-body">
                                <!-- Aquí se agregarán los datos de los usuarios -->
                            </tbody>
                        </table>
                    </div>
                
                    <!-- Agrega el script de Axios -->
                    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
                    <script>
                        // Realiza una solicitud GET a la API y maneja los datos devueltos
                        axios.get('http://127.0.0.1:8000/api/users')
                            .then(function (response) {
                                var users = response.data;
                                var tableBody = document.getElementById('users-table-body');
                
                                // Itera sobre los usuarios y crea filas en la tabla
                                users.forEach(function (user) {
                                    var row = document.createElement('tr');
                
                                    // Agrega las celdas con los datos del usuario
                                    row.innerHTML = `
                                        <td>${user.id}</td>
                                        <td>${user.name}</td>
                                        <td>${user.email}</td>
                                        <td>${user.img ? user.img : 'N/A'}</td>
                                        <td>${user.created_at}</td>
                                        <td>${user.updated_at}</td>
                                    `;
                
                                    // Agrega la fila a la tabla
                                    tableBody.appendChild(row);
                                });
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    </script>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



