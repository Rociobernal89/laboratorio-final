<?php
if ($_POST) {
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Validación de datos
    if (empty($nombre) || empty($apellido1) || empty($apellido2) || empty($email) || empty($usuario) || empty($contraseña)) {
        echo "Todos los campos son obligatorios";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "El correo electrónico no es válido";
    } elseif (strlen($contraseña) < 4 || strlen($contraseña) > 8) {
        echo "La contraseña debe tener entre 4 y 8 caracteres";
    } else {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "registro";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "El correo electrónico ya está registrado";

            
            echo "<button onclick=\"location.href='index.html'\">Volver al formulario</button>";
        } else {
            $insertSql = "INSERT INTO usuarios (nombre, apellido1, apellido2, email, usuario, contraseña) VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$usuario', '$contraseña')";
            if ($conn->query($insertSql) === TRUE) {
                echo "Registro completado con éxito";

                echo "<button onclick=\"location.href='consulta.php'\">Consulta</button>";
            } else {
                echo "Registro no completado: " . $conn->error;
            }
        }

        $conn->close();
    }
}
?>
