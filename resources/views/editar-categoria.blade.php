@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Category') }}</div>

                <div class="card-body">
                    <form id="category-form">
                        <div class="form-group">
                            <label for="category-name">Name</label>
                            <input type="text" class="form-control" id="category-name" required>
                        </div>
                        <div class="form-group">
                            <label for="category-image">Image</label>
                            <input type="file" class="form-control-file" id="category-image">
                            <div id="image-preview"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Obtener el ID de la categoría desde la URL
    var categoryId = window.location.pathname.split('/').pop();

    // Obtener una referencia al formulario de edición de categorías
    const form = document.getElementById('category-form');

    // Obtener una referencia al campo de vista previa de imagen
    const imagePreview = document.getElementById('image-preview');

    // Realizar una solicitud GET a la API para obtener los datos de la categoría existente
    axios.get('http://127.0.0.1:8000/api/categories/' + categoryId)
        .then(function(response) {
            const category = response.data;

            // Llenar los campos del formulario con los datos de la categoría existente
            document.getElementById('category-name').value = category.name;

            if (category.image) {
                // Crear una imagen de vista previa para la imagen existente
                const imageURL = 'http://127.0.0.1:8000/images/' + category.image;
                const image = document.createElement('img');
                image.src = imageURL;
                image.alt = 'Image Preview';
                image.style.maxWidth = '200px';
                image.style.maxHeight = '200px';

                // Mostrar la vista previa de la imagen en el campo correspondiente
                imagePreview.appendChild(image);
            }
        })
        .catch(function(error) {
            console.error(error);
        });

    // Escuchar el evento change del campo de imagen
    document.getElementById('category-image').addEventListener('change', function(event) {
        const file = event.target.files[0];

        // Crear un objeto URL para mostrar la vista previa de la imagen
        const imageURL = URL.createObjectURL(file);

        // Mostrar la vista previa de la imagen en el campo correspondiente
        imagePreview.innerHTML = `<img src="${imageURL}" alt="Image Preview" style="max-width: 200px; max-height: 200px;">`;
    });

    // Escuchar el evento submit del formulario
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar que el formulario se envíe de manera predeterminada

        // Obtener los valores del formulario
        const name = document.getElementById('category-name').value;
        const image = document.getElementById('category-image').files[0];

        // Crear un objeto FormData para enviar los datos del formulario
        const formData = new FormData();
        formData.append('name', name);
        if (image) {
            formData.append('image', image);
        }

        // Realizar la solicitud PUT a la API para actualizar la categoría
        axios.put('http://127.0.0.1:8000/api/categories/' + categoryId, formData)
            .then(function(response) {
                // Manejar la respuesta exitosa de la API
                console.log(response.data); // Aquí puedes realizar otras acciones, como mostrar una notificación

                // Redirigir a la página de detalles de la categoría actualizada
                window.location.href = 'http://127.0.0.1:8000/categorias/' + categoryId;
            })
            .catch(function(error) {
                // Manejar errores en caso de que ocurra alguno
                console.error(error);
            });
    });
</script>
@endsection
