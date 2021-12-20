<?php
include('conexao.php');

try {
    $sql = "SELECT * from tblacionistas";
    $qry = $con->query($sql);
    $acionistas = $qry->fetchAll(PDO::FETCH_OBJ);
    //echo "<pre>";
    //print_r($clientes);
    //die();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Documento do Senac</title>
</head>

<body>
    <div class="container">
        <h1>Lista de Acionistas</h1>
        <hr>
        <a href="frmacionistas.php" class="btn btn-outline-primary">Novo Cadastro</a>
        <hr>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Acionistas</th>
                    <th>Pagar Funcionários</th>
                    <th>Lucro do Jogo</th>

                    <th colspan=2>Ações</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($acionistas as $a) { ?>
                    <tr>
                        <td><?php echo $a->idacionistas ?></td>
                        <td><?php echo $a->acionistas ?></td>
                        <td><?php echo $a->pagar ?></td>
                        <td><?php echo $a->lucrojogo ?></td>
                        <td><a href="frmacionistas.php?idacionistas=<?php echo $a->idacionistas ?>" class=" btn btn-outline-warning">Editar</a></td>
                        <td><a href="frmacionistas.php?op=del&idacionistas=<?php echo  $a->idacionistas ?>" class="btn btn-outline-danger">Excluir</a></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="index.html" class="btn btn-outline-secondary">Voltar</a>
    </div>
</body>

</html>