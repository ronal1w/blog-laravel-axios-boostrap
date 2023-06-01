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
                </tr>
            </thead>
            <tbody id="categories-list">
                <!-- Categories will be dynamically added here -->
            </tbody>
        </table>
    </div>
    <script>
        axios.get('http://127.0.0.1:8000/api/categories')
            .then(function (response) {
                // Handle the API response
                var categories = response.data;

                var categoriesList = document.getElementById('categories-list');

                // Iterate over the categories and create table rows
                categories.forEach(function (category) {
                    var row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${category.id}</td>
                        <td>${category.name}</td>
                        <td>${category.image ? '<img src="' + category.image + '" alt="Image">' : ''}</td>
                        <td>${category.created_at}</td>
                        <td>${category.updated_at}</td>
                    `;
                    categoriesList.appendChild(row);
                });
            })
            .catch(function (error) {
                console.error(error);
            });
    </script>


                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
