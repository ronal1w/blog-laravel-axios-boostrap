@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="container">
                        <h1>Post Details</h1>
                        <div id="postDetails" class="card">
                            <div class="card-body">
                                <h5 id="postTitle" class="card-title"></h5>
                                <p id="postContent" class="card-text"></p>
                                <img id="postImage" class="img-fluid" alt="">
                                <p id="postCategory" class="card-text"></p>
                                <p id="postUser" class="card-text"></p>
                            </div>
                        </div>
                
                        <h2>Comments</h2>
                        <ul id="commentList" class="list-group"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Agrega el script de Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const postId = window.location.pathname.split('/').pop();

    // Obtener los detalles del post
    axios.get(`/api/posts/${postId}`)
        .then(response => {
            const post = response.data;

            // Actualizar los elementos HTML con los datos del post
            const postTitleElement = document.getElementById('postTitle');
            postTitleElement.textContent = post.title;

            const postContentElement = document.getElementById('postContent');
            postContentElement.textContent = post.content;

            const postImageElement = document.getElementById('postImage');
            postImageElement.src = '/images/' + post.img;
            postImageElement.alt = post.title;

            const postCategoryElement = document.getElementById('postCategory');
            postCategoryElement.textContent = 'Category: ' + post.category.name;

            const postUserElement = document.getElementById('postUser');
            postUserElement.textContent = 'Created by: ' + post.user.name;
        })
        .catch(error => {
            console.error(error);
        });

    // Obtener los comentarios del post
    axios.get(`/api/posts/${postId}/comments`)
        .then(response => {
            const comments = response.data;

            // Obtener el elemento de la lista de comentarios
            const commentListElement = document.getElementById('commentList');

            // Limpiar la lista de comentarios
            commentListElement.innerHTML = '';

            // Iterar sobre los comentarios y crear elementos HTML para cada uno
            comments.forEach(comment => {
                const commentItem = document.createElement('li');
                commentItem.className = 'list-group-item';
                commentItem.textContent = 'Comment: ' + comment.content;

                commentListElement.appendChild(commentItem);
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>

@endsection
