@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="container">
                        <h1>Categories</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="categories-list">
                                <!-- Categories will be dynamically added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para eliminar una categoría
    function deleteCategory(categoryId) {
        if (confirm('Are you sure you want to delete this category?')) {
            axios.delete('http://127.0.0.1:8000/api/categories/' + categoryId)
                .then(function (response) {
                    // Manejar la respuesta exitosa de la API
                    console.log(response.data); // Aquí puedes realizar otras acciones, como actualizar la interfaz

                    // Eliminar la fila de la categoría eliminada de la tabla
                    var row = document.getElementById('category-' + categoryId);
                    if (row) {
                        row.remove();
                    }
                })
                .catch(function (error) {
                    // Manejar errores en caso de que ocurra alguno
                    console.error(error);
                });
        }
    }

    axios.get('http://127.0.0.1:8000/api/categories')
        .then(function (response) {
            // Handle the API response
            var categories = response.data;

            var categoriesList = document.getElementById('categories-list');

            // Iterate over the categories and create table rows
            categories.forEach(function (category) {
                var row = document.createElement('tr');
                row.id = 'category-' + category.id;
                row.innerHTML = `
                    <td>${category.id}</td>
                    <td>${category.name}</td>
                    <td>${category.image ? '<img src="/images/' + category.image + '" alt="Image" style="max-width: 100px;">' : ''}</td>
                    <td>${category.created_at}</td>
                    <td>${category.updated_at}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="deleteCategory(${category.id})">Delete</button>
                    </td>
                `;
                categoriesList.appendChild(row);
            });
        })
        .catch(function (error) {
            console.error(error);
        });
</script>
@endsection
