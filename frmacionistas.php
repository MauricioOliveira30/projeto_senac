<?php

$idacionistas = isset($_GET["idacionistas"]) ? $_GET["idacionistas"] : null;
$op = isset($_GET["op"]) ? $_GET["op"] : null;


try {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdgames";
    $con = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $senha);

    if ($op == "del") {
        $sql = "delete  FROM  tblacionistas where idacionistas= :idacionistas";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idacionistas", $idacionistas);
        $stmt->execute();
        header("Location:listaracionistas.php");
    }


    if ($idacionistas) {
        //estou buscando os dados do cliente no BD
        $sql = "SELECT * FROM  tblacionistas where idacionistas= :idacionistas";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idacionistas", $idacionistas);
        $stmt->execute();
        $acionistas = $stmt->fetch(PDO::FETCH_OBJ);
        //var_dump($cliente);
    }
    if ($_POST) {
        if ($_POST["idacionistas"]) {
            $sql = "UPDATE tblacionistas SET acionistas=:acionistas, pagar=:pagar , lucrojogo=:lucrojogo WHERE idacionistas =:idacionistas";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":acionistas", $_POST["acionistas"]);
            $stmt->bindValue(":pagar", $_POST["pagar"]);
            $stmt->bindValue(":lucrojogo", $_POST["lucrojogo"]);
            $stmt->bindValue(":idacionistas", $_POST["idacionistas"]);
            $stmt->execute();
        } else {
            $sql = "INSERT INTO tblacionistas(acionistas,pagar,lucrojogo) VALUES (:acionistas,:pagar,:lucrojogo)";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":acionistas", $_POST["acionistas"]);
            $stmt->bindValue(":pagar", $_POST["pagar"]);
            $stmt->bindValue(":lucrojogo", $_POST["lucrojogo"]);
            $stmt->execute();
        }
        header("Location:listaracionistas.php");
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
   
    <title>Projeto CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <h1>Cadastro de Clientes</h1>
    <form method="POST">
        Acionistas <input type="text" name="acionistas" value="<?php echo isset($acionistas) ? $acionistas->acionistas : null ?>"><br>
        Pagamento <input type="text" name="pagar" value="<?php echo isset($acionistas) ? $acionistas->pagar : null ?>"><br>
        Lucro do Jogo<input type="text" name="lucrojogo" value="<?php echo isset($acionistas) ? $acionistas->lucrojogo : null ?>"><br>
        <input type="hidden" name="idacionistas" value="<?php echo isset($acionistas) ? $acionistas->idacionistas : null ?>">
        <input type="submit" value="Cadastrar">
    </form>
    <a href="index.html">Voltar</a>
</body>

</html>