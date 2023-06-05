@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="container">
                        <h1>Detalles del Post</h1>
                        <div id="postDetails" class="card">
                            <div class="card-body">
                                <h5 id="postTitle" class="card-title"></h5>
                                <img id="postImage" class="img-fluid" alt="">
                                <p id="postContent" class="card-text"></p>

                                <h2>Usuario</h2>
                                <p id="userName" class="card-text"></p>
                                <p id="userEmail" class="card-text"></p>

                                <h2>Categoría</h2>
                                <p id="categoryName" class="card-text"></p>
                                <img id="categoryImage" class="img-fluid" alt="">

                                <h2>Comentarios</h2>
                                <ul id="commentList" class="list-group"></ul>

                                <h2>Agregar Comentario</h2>
                                <form id="commentForm">
                                    <div class="form-group">
                                        <textarea class="form-control" id="commentContent" rows="3" placeholder="Escribe tu comentario"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                </form>
                            </div>
                        </div>
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

    // Obtener los detalles del post y los comentarios
    const getPostDetails = () => {
        axios.get(`/api/posts/${postId}`)
            .then(response => {
                const post = response.data;

                // Actualizar los elementos HTML con los datos del post
                const postTitleElement = document.getElementById('postTitle');
                postTitleElement.textContent = post.title;

                const postImageElement = document.getElementById('postImage');
                postImageElement.src = '/images/' + post.img;
                postImageElement.alt = post.title;

                const postContentElement = document.getElementById('postContent');
                postContentElement.textContent = post.content;

                const userNameElement = document.getElementById('userName');
                userNameElement.textContent = 'Nombre: ' + post.user.name;

                const userEmailElement = document.getElementById('userEmail');
                userEmailElement.textContent = 'Correo electrónico: ' + post.user.email;

                const categoryNameElement = document.getElementById('categoryName');
                categoryNameElement.textContent = 'Nombre: ' + post.category.name;

                const categoryImageElement = document.getElementById('categoryImage');
                categoryImageElement.src = '/images/' + post.category.image;
                categoryImageElement.alt = post.category.name;

                const commentListElement = document.getElementById('commentList');

                // Limpiar la lista de comentarios
                commentListElement.innerHTML = '';

                post.comments.forEach(comment => {
                    const commentItem = document.createElement('li');
                    commentItem.className = 'list-group-item';
                    commentItem.textContent = 'Contenido: ' + comment.content;

                    commentListElement.appendChild(commentItem);
                });
            })
            .catch(error => {
                console.error(error);
            });
    };

    // Enviar el nuevo comentario
    const submitComment = (event) => {
        event.preventDefault();

        const commentContent = document.getElementById('commentContent').value;

        axios.post('/api/comments', {
        content: commentContent,
        user_id: {{ Auth::id() }}, // Obtener el ID del usuario de la sesión actual
        post_id: postId // Obtener el ID del post de la ruta
    })
        .then(response => {
            // Limpiar el campo de comentario
            document.getElementById('commentContent').value = '';

            // Volver a obtener los detalles del post y los comentarios para mostrar la lista actualizada
            getPostDetails();
        })
        .catch(error => {
            console.error(error);
        });
    };

    // Escuchar el evento de envío del formulario de comentario
    document.getElementById('commentForm').addEventListener('submit', submitComment);

    // Obtener los detalles del post al cargar la página
    getPostDetails();
</script>

@endsection
