
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                   
     <style>
        body {
            background-color: #f2f2f2;
        }

        .container {
            padding-top: 20px;
            max-width: 1400px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .card-deck {
            margin-bottom: 20px;
        }
    </style>
</head>

    <div class="container">
        <a href="crear-post" class="btn btn-primary">Crear Post</a>
        <div class="form-group">
            <label for="categorySelect">Select Category:</label>
            <select class="form-control" id="categorySelect" onchange="filterPostsByCategory()"></select>
        </div>
        <div class="row" id="posts"></div>
    </div>

    <script>
        // Function to get categories from the API and populate the select options
        function getCategories() {
            const categorySelect = document.getElementById('categorySelect');
            categorySelect.innerHTML = '';

            // Make a GET request to the API to get categories
            axios.get('http://127.0.0.1:8000/api/categories')
                .then(response => {
                    const categories = response.data;

                    // Create the "All" option
                    const allOption = document.createElement('option');
                    allOption.value = '';
                    allOption.textContent = 'All';
                    categorySelect.appendChild(allOption);

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

        // Function to filter posts by category
        function filterPostsByCategory() {
            const categorySelect = document.getElementById('categorySelect');
            const selectedCategoryId = categorySelect.value;
            const postsRow = document.getElementById('posts');
            postsRow.innerHTML = '';

            // Make a GET request to the API to get posts
            axios.get('http://127.0.0.1:8000/api/posts')
                .then(response => {
                    const posts = response.data;

                    let cardsHtml = '';
                    let count = 0;
                    posts.forEach(post => {
                        // Check if the post belongs to the selected category
                        if (selectedCategoryId === '' || post.category_id.toString() === selectedCategoryId) {
                            // Create the card for the post
                            const truncatedContent = post.content.substring(0, 200) + '...';

                            cardsHtml += `
                                <div class="col-md-3">
                                    <div class="card mb-3">
                                        <img class="card-img-top" src="http://127.0.0.1:8000/images/${post.img}" alt="${post.title}">
                                        <div class="card-body">
                                            <h5 class="card-title">${post.title}</h5>
                                            <p class="card-text">${truncatedContent}</p>
                                            <a href="post/${post.id}" class="btn btn-primary">Ver más</a>
                                        </div>
                                    </div>
                                </div>
                            `;

                            count++;

                            // Create a new row after every 4 cards
                            if (count % 4 === 0) {
                                const row = document.createElement('div');
                                row.className = 'row';
                                row.innerHTML = cardsHtml;
                                postsRow.appendChild(row);
                                cardsHtml = '';
                            }
                        }
                    });

                    // Create a final row with remaining cards
                    if (cardsHtml !== '') {
                        const row = document.createElement('div');
                        row.className = 'row';
                        row.innerHTML = cardsHtml;
                        postsRow.appendChild(row);
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        }

        // Initial loading of categories and posts
        getCategories();
        filterPostsByCategory();
    </script>

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection









