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
                            </div>
                        </div>
                
                        <h2>Comments</h2>
                        <ul id="commentList" class="list-group"></ul>
                    </div>
                
                    <script>
                        const postId = window.location.pathname.split('/').pop();
                
                        axios.get(`http://127.0.0.1:8000/api/posts/${postId}`)
                            .then(response => {
                                const post = response.data;
                
                                // Actualizar los elementos HTML con los datos del post
                                const postTitleElement = document.getElementById('postTitle');
                                postTitleElement.textContent = post.title;
                
                                const postContentElement = document.getElementById('postContent');
                                postContentElement.textContent = post.content;
                
                                const postImageElement = document.getElementById('postImage');
                                postImageElement.src = 'http://127.0.0.1:8000/images/' + post.img;
                                postImageElement.alt = post.title;
                            })
                            .catch(error => {
                                console.error(error);
                            });
                
                        axios.get(`http://127.0.0.1:8000/api/posts/${postId}/comments`)
                            .then(response => {
                                const comments = response.data;
                
                                // Obtener el elemento de la lista de comentarios
                                const commentListElement = document.getElementById('commentList');
                
                                // Iterar sobre los comentarios y crear elementos HTML para cada uno
                                comments.forEach(comment => {
                                    const commentItem = document.createElement('li');
                                    commentItem.className = 'list-group-item';
                                    commentItem.textContent = comment.content;
                
                                    commentListElement.appendChild(commentItem);
                                });
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    </script>





                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- resources/views/posts/show.blade.php -->
