<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Santo Tomás Escuela de Conducción</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="login-form shadow p-4 rounded bg-white">
            <h3 class="text-center mb-4">Iniciar Sesión</h3>
            <?php
            // Mostrar mensaje de error si existe
            if (isset($_GET['error'])) {
                echo '<div class="alert alert-danger text-center">Usuario o contraseña incorrectos.</div>';
            }
            ?>
            <form action="scripts/login.php" method="POST">
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="scripts/app.js"></script>
</body>
</html>
