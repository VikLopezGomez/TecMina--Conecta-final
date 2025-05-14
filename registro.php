
<?php
$conn = new mysqli("localhost", "root", "", "tecmina");
if ($conn->connect_error) { die("Error de conexión: " . $conn->connect_error); }
$correo = $_POST['correo'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$sql = "INSERT INTO usuarios (correo, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $correo, $password);
if ($stmt->execute()) { echo "Registro exitoso. <a href='login.html'>Iniciar sesión</a>"; }
else { echo "Error al registrar: " . $conn->error; }
$conn->close();
?>
