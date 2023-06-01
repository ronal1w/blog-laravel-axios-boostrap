<!DOCTYPE html>
<html>
<head>
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Crear Usuario</h1>

        @if(session('success'))
            <div class="alert alert-success mt-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Formulario de Registro</h5>

                <form id="create-user-form" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="img">Imagen:</label>
                        <input type="file" name="img" class="form-control-file" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('create-user-form').addEventListener('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            axios.post('http://127.0.0.1:8000/api/crear-users', formData)
                .then(function(response) {
                    // Limpiar campos
                    document.getElementById('create-user-form').reset();

                    // Mostrar alerta de éxito
                    var successAlert = document.createElement('div');
                    successAlert.className = 'alert alert-success mt-4';
                    successAlert.textContent = 'Usuario guardado';

                    document.querySelector('.container').appendChild(successAlert);

                    setTimeout(function() {
                        successAlert.style.display = 'none';
                    }, 3000);
                })
                .catch(function(error) {
                    console.log(error);
                    // Manejar el error aquí
                });
        });
    </script>
</body>
</html>
