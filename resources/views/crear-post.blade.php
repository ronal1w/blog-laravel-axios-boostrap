@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Crearte Nuevo Post') }}</div>

                <div class="card-body">
                    <div class="container">
                        <form action="http://127.0.0.1:8000/api/posts" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="content">Content:</label>
                                <textarea class="form-control" id="content" name="content" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="img">Image:</label>
                                <input type="file" class="form-control-file" id="img" name="img" required accept="image/*">
                            </div>
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="form-group">
                                <label for="category_id">Category:</label>
                                <select class="form-control" id="category_id" name="category_id" required></select>
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                
                    <script>
                        // Function to get categories from the API and populate the select options
                        function getCategories() {
                            const categorySelect = document.getElementById('category_id');
                
                            // Make a GET request to the API to get categories
                            axios.get('http://127.0.0.1:8000/api/categories')
                                .then(response => {
                                    const categories = response.data;
                
                                    // Create options for each category
                                    categories.forEach(category => {
                                        const option = document.createElement('option');
                                        option.value = category.id;
                                        option.textContent = category.name;
                                        categorySelect.appendChild(option);
                                    });
                                })
                                .catch(error => {
                                    console.error(error);
                                });
                        }
                
                        // Initial loading of categories
                        getCategories();
                    </script>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection



