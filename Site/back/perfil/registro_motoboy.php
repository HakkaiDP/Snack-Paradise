<?php
include_once 'Conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $vehicle_type = filter_var($_POST['vehicle_type'], FILTER_SANITIZE_STRING);
    $license_plate = filter_var($_POST['license_plate'], FILTER_SANITIZE_STRING);

    try {
        $conn = Conexao::getInstance();
        $sql = $conn->prepare("INSERT INTO motoboys (name, email, senha, vehicle_type, license_plate) VALUES (:name, :email, :senha, :vehicle_type, :license_plate)");
        $sql->bindParam(':name', $name);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':senha', $senha);
        $sql->bindParam(':vehicle_type', $vehicle_type);
        $sql->bindParam(':license_plate', $license_plate);
        $sql->execute();

        header("Location: ../../Tela de login/index.html?success=1");
        exit();
    } catch (PDOException $e) {
        error_log("Erro ao cadastrar motoboy: " . $e->getMessage());
        header("Location: ../../Tela de login/cadastrar_motoboy.php?error=1
");
        exit();
    }
} else {
    header("Location: ../../Tela de login/cadastrar_motoboy.php?error=2");
    exit();
}
?>  
