@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="container">
                        <h1>Crear Categoría</h1>
                        <form id="category-form">
                            <div class="form-group">
                                <label for="category-name">Nombre de la categoría</label>
                                <input type="text" class="form-control" id="category-name" required>
                            </div>
                            <div class="form-group">
                                <label for="category-image">Imagen de la categoría</label>
                                <input type="file" class="form-control-file" id="category-image" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Obtener una referencia al formulario de creación de categorías
    const form = document.getElementById('category-form');

    // Escuchar el evento submit del formulario
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar que el formulario se envíe de manera predeterminada

        // Obtener los valores del formulario
        const name = document.getElementById('category-name').value;
        const image = document.getElementById('category-image').files[0];

        // Crear un objeto FormData para enviar los datos del formulario
        const formData = new FormData();
        formData.append('name', name);
        formData.append('image', image);

        // Realizar la solicitud POST a la API
        axios.post('http://127.0.0.1:8000/api/categories', formData)
            .then(function(response) {
                // Manejar la respuesta exitosa de la API
                console.log(response.data); // Aquí puedes realizar otras acciones, como actualizar la interfaz con los datos devueltos

                // Limpiar el formulario después de guardar la categoría
                form.reset();

                // Mostrar notificación de éxito
                const notification = document.createElement('div');
                notification.className = 'alert alert-success';
                notification.textContent = 'Categoría guardada exitosamente.';
                document.body.appendChild(notification);

                // Desaparecer la notificación después de 3 segundos
                setTimeout(function() {
                    notification.remove();
                }, 3000);
            })
            .catch(function(error) {
                // Manejar errores en caso de que ocurra alguno
                console.error(error);
            });
    });
</script>
@endsection
