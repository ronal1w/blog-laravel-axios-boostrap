<!DOCTYPE html>
<html>
<head>
    <title>Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
      <div class="card">

      
        <h1 class="mt-5">Usuarios</h1>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Imagen</th>
                    <th>Fecha de Creación</th>
                    <th>Fecha de Actualización</th>
                </tr>
            </thead>
            <tbody id="users-table-body">
                
            </tbody>
        </table>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        axios.get('http://127.0.0.1:8000/api/users')
            .then(function(response) {
                var users = response.data;

                var tableBody = document.getElementById('users-table-body');

                users.forEach(function(user) {
                    var row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${user.id}</td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>
                            <img src="{{ asset('images') }}/${user.img}" alt="Imagen del Usuario" style="width: 100px;">
                        </td>
                        <td>${user.created_at}</td>
                        <td>${user.updated_at}</td>
                    `;

                    tableBody.appendChild(row);
                });
            })
            .catch(function(error) {
                console.log(error);
                // Manejar el error aquí
            });
    </script>
</body>
</html>
