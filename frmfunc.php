<?php

$idfunc = isset($_GET["idfunc"]) ? $_GET["idfunc"] : null;
$op = isset($_GET["op"]) ? $_GET["op"] : null;


try {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdgames";
    $con = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $senha);

    if ($op == "del") {
        $sql = "delete  FROM  tblfunc where idfunc=:idfunc";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idfunc", $idfunc);
        $stmt->execute();
        header("Location:listarfunc.php");
    }


    if ($idfunc) {
        //estou buscando os dados do cliente no BD
        $sql = "SELECT * FROM  tblfunc
         where idfunc= :idfunc";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idfunc", $idfunc);
        $stmt->execute();
        $func = $stmt->fetch(PDO::FETCH_OBJ);
        //var_dump($cliente);
    }
    if ($_POST) {
        if ($_POST["idfunc"]) {
            $sql = "UPDATE tblfunc SET func=:func,  salario=:salario, conserta_bug=:conserta_bug WHERE idfunc =:idfunc";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":func", $_POST["func"]);
            $stmt->bindValue(":salario", $_POST["salario"]);
            $stmt->bindValue(":conserta_bug", $_POST["conserta_bug"]);
            $stmt->bindValue(":idfunc", $_POST["idfunc"]);
            $stmt->execute();
        } else {
            $sql = "INSERT INTO tblfunc(func,salario,conserta_bug) VALUES (:func,:salario,:conserta_bug)";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":func", $_POST["func"]);
            $stmt->bindValue(":salario", $_POST["salario"]);
            $stmt->bindValue(":conserta_bug", $_POST["conserta_bug"]);

            $stmt->execute();
        }
        header("Location:listarfunc.php");
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
    <h1>Cadastro de Funcionários</h1>
    <form method="POST">
        Funcinário <input type="text" name="func" required value="<?php echo isset($func) ? $func->func : null ?>"><br>
        Salário <input type="text" name="salario" required value="<?php echo isset($func) ? $func->salario : null ?>"><br>
        Conserto de Bugs <input type="text" name="conserta_bug" required value="<?php echo isset($func) ? $func->conserta_bug : null ?>"><br>

        <input type="hidden" name="idfunc" value="<?php echo isset($func) ? $func->idfunc : null ?>">
        <input type="submit" value="Cadastrar">
    </form>
    <a href="index.html">Voltar</a>
</body>

</html>