<?php

$idcliente = isset($_GET["idcliente"]) ? $_GET["idcliente"] : null;
$op = isset($_GET["op"]) ? $_GET["op"] : null;


try {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdgames";
    $con = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $senha);

    if ($op == "del") {
        $sql = "delete  FROM  tblclientes where idcliente= :idcliente";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idcliente", $idcliente);
        $stmt->execute();
        header("Location:listarclientes.php");
    }


    if ($idcliente) {
        //estou buscando os dados do cliente no BD
        $sql = "SELECT * FROM  tblclientes where idcliente= :idcliente";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idcliente", $idcliente);
        $stmt->execute();
        $cliente = $stmt->fetch(PDO::FETCH_OBJ);
        //var_dump($cliente);
    }
    if ($_POST) {
        if ($_POST["idcliente"]) {
            $sql = "UPDATE tblclientes SET cliente=:cliente, satisfacao=:satisfacao,compra=:compra WHERE idcliente =:idcliente";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":cliente", $_POST["cliente"]);
            $stmt->bindValue(":satisfacao", $_POST["satisfacao"]);
            $stmt->bindValue(":compra", $_POST["compra"]);
            $stmt->bindValue(":idcliente", $_POST["idcliente"]);
            $stmt->execute();
        } else {
            $sql = "INSERT INTO tblclientes(cliente,satisfacao,compra) VALUES (:cliente,:satisfacao,:compra)";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":cliente", $_POST["cliente"]);
            $stmt->bindValue(":satisfacao", $_POST["satisfacao"]);
            $stmt->bindValue(":compra", $_POST["compra"]);
            $stmt->execute();
        }
        header("Location:listarclientes.php");
    }
} catch (PDOException $e) {
    echo "erro" . $e->getMessage;
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projeto Senac</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <h1>Cadastro de Clientes</h1>
    <form method="POST">
        Clientes <input type="text" name="cliente" required value="<?php echo isset($cliente) ? $cliente->cliente : null ?>"><br>
        Satisfação <input type="text" name="satisfacao" required value="<?php echo isset($cliente) ? $cliente->satisfacao : null ?>"><br>
        Compra <input type="text" name="compra" required value="<?php echo isset($cliente) ? $cliente->compra : null ?>"><br>
        <input type="hidden" name="idcliente"  value="<?php echo isset($cliente) ? $cliente->idcliente : null ?>">
        <input type="submit" value="Cadastrar">
    </form>
    <a href="index.html">Voltar</a>
</body>

</html>