<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('location: index.php'); // Redirigir si no hay sesión activa
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Kardex</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Kardex
            </div>
            <div class="card-body">
                <h5 class="card-title">Información del Estudiante</h5>
                <p class="card-text">Matricula: <?php echo $_SESSION['usuario'] ?></p>
                <p class="card-text">Carrera: </p>
                <p class="card-text">Carrera: Ingeniería Informática</p>
                <h5 class="card-title mt-4">Materias</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Materia</th>
                            <th scope="col">Calificación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Matemáticas</td>
                            <td>90</td>
                        </tr>   
                        <tr>
                            <td>Programación</td>
                            <td>85</td>
                        </tr>
                        <tr>
                            <td>Física</td>
                            <td>75</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
