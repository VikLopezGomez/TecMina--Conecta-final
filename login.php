
<?php
$conn = new mysqli("localhost", "root", "", "tecmina");
if ($conn->connect_error) { die("Error de conexión: " . $conn->connect_error); }
$correo = $_POST['correo'];
$password = $_POST['password'];
$sql = "SELECT password FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->bind_result($hash);
    $stmt->fetch();
    if (password_verify($password, $hash)) {
        echo "¡Bienvenido, $correo!";
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Usuario no encontrado.";
}
$conn->close();
?>
