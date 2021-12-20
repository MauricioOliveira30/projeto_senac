<?php
include('conexao.php');

try {
    $sql = "SELECT * from tblfunc";
    $qry = $con->query($sql);
    $func = $qry->fetchAll(PDO::FETCH_OBJ);
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
        <h1>Lista de Funcionários</h1>
        <hr>
        <a href="frmfunc.php" class="btn btn-outline-primary">Novo Cadastro</a>
        <hr>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Funcionário</th>
                    <th>Receber Salário</th>
                    <th>Consertar Bugs</th>

                    <th colspan=2>Ações</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($func as $f) { ?>
                    <tr>
                        <td><?php echo $f->idfunc ?></td>
                        <td><?php echo $f->func ?></td>
                        <td><?php echo $f->salario ?></td>
                        <td><?php echo $f->conserta_bug ?></td>
                        <td><a href="frmfunc.php?idfunc=<?php echo $f->idfunc ?>" class=" btn btn-outline-warning">Editar</a></td>
                        <td><a href="frmfunc.php?op=del&idfunc=<?php echo  $f->idfunc ?>" class=" btn btn-outline-danger">Excluir</a></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="index.html" class="btn btn-outline-secondary">Voltar</a>
    </div>
</body>

</html>