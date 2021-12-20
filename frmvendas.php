<?php

$idvendas = isset($_GET["idvendas"]) ? $_GET["idvendas"] : null;
$op = isset($_GET["op"]) ? $_GET["op"] : null;


try {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdgames";
    $con = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $senha);

    if ($op == "del") {
        $sql = "delete  FROM  tblvendas where idvendas=:idvendas";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idvendas", $idvendas);
        $stmt->execute();
        header("Location:listarvendas.php");
    }


    if ($idvendas) {
        //estou buscando os dados do cliente no BD
        $sql = "SELECT * FROM  tblvendas
         where idvendas= :idvendas";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idvendas", $idvendas);
        $stmt->execute();
        $vendas = $stmt->fetch(PDO::FETCH_OBJ);
        //var_dump($cliente);
    }
    if ($_POST) {
        if ($_POST["idvendas"]) {
            $sql = "UPDATE tblvendas SET vendas=:vendas,  vendaip=:vendaip WHERE idvendas =:idvendas";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":vendas", $_POST["vendas"]);
            $stmt->bindValue(":vendaip", $_POST["vendaip"]);
            $stmt->bindValue(":idvendas", $_POST["idvendas"]);
            $stmt->execute();
        } else {
            $sql = "INSERT INTO tblvendas(vendas,vendaip) VALUES (:vendas,:vendaip)";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":vendas", $_POST["vendas"]);
            $stmt->bindValue(":vendaip", $_POST["vendaip"]);
            $stmt->execute();
        }
        header("Location:listarvendas.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Projeto Senac</title>
</head>

<body>
    <h1>Cadastro de Vendas</h1>
    <form method="POST">
        Vendas <input type="text" name="vendas" required value="<?php echo isset($vendas) ? $vendas->vendas : null ?>"><br>
        IP Vendido <input type="text" name="vendaip" required value="<?php echo isset($vendas) ? $vendas->vendaip : null ?>"><br>
        
        <input type="hidden" name="idvendas" value="<?php echo isset($vendas) ? $vendas->idvendas : null ?>">
        <input type="submit" value="Cadastrar">
    </form>
    <a href="index.html">Voltar</a>
</body>

</html>