<?php
include 'conexao.php';

// 1. Verifica se foi passado um ID para carregar os dados
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    
    $sqlSelect = "SELECT * FROM alunos WHERE id=$id";
    $result = $conexao->query($sqlSelect);

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        // Variaveis para preencher o formulário
        $nome = $user_data['nome'];
        $data_nascimento = $user_data['data_nascimento'];
        $cidade = $user_data['cidade'];
        $rua = $user_data['rua'];
        $bairro = $user_data['bairro'];
        $numero = $user_data['numero'];
        $cep = $user_data['cep'];
        $nome_responsavel = $user_data['nome_responsavel'];
        $tipo_responsavel = $user_data['tipo_responsavel'];
        $curso = $user_data['curso'];
    } else {
        header('Location: listar_alunos.php');
        exit;
    }
} else {
    // Se não tiver ID e não for um POST de atualização, volta pra lista
    if(!isset($_POST['update'])) {
        header('Location: listar_alunos.php');
        exit;
    }
}

// 2. Lógica para SALVAR as alterações (UPDATE)
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $cidade = $_POST['cidade'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $numero = $_POST['numero'];
    $cep = $_POST['cep'];
    $nome_responsavel = $_POST['nome_responsavel'];
    $tipo_responsavel = $_POST['tipo_responsavel'];
    $curso = $_POST['curso'];

    $sqlUpdate = "UPDATE alunos SET 
        nome='$nome', data_nascimento='$data_nascimento', cidade='$cidade', 
        rua='$rua', bairro='$bairro', numero='$numero', cep='$cep', 
        nome_responsavel='$nome_responsavel', tipo_responsavel='$tipo_responsavel', curso='$curso'
        WHERE id='$id'";

    $result = $conexao->query($sqlUpdate);
    
    // Após atualizar, volta para a lista
    header('Location: listar_alunos.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Aluno</title>
</head>
<body>
    <?php include('navbar.php'); ?>

    <div class="container mt-5 mb-5">
        <h2 class="text-center">Editar Dados do Aluno</h2>
        
        <form action="editar_aluno.php" method="POST">
            
            <div class="row mt-4">
                <div class="col-md-6 mb-3">
                    <label>Nome Completo</label>
                    <input type="text" class="form-control" name="nome" value="<?php echo $nome; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Data Nascimento</label>
                    <input type="date" class="form-control" name="data_nascimento" value="<?php echo $data_nascimento; ?>" required>
                </div>
            </div>

            <fieldset class="mt-4 border p-3 rounded">
                <legend class="h5">Endereço</legend>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Cidade</label>
                        <input type="text" class="form-control" name="cidade" value="<?php echo $cidade; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Rua</label>
                        <input type="text" class="form-control" name="rua" value="<?php echo $rua; ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Bairro</label>
                        <input type="text" class="form-control" name="bairro" value="<?php echo $bairro; ?>" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Número</label>
                        <input type="text" class="form-control" name="numero" value="<?php echo $numero; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>CEP</label>
                        <input type="text" class="form-control" name="cep" value="<?php echo $cep; ?>" required>
                    </div>
                </div>
            </fieldset>

            <div class="row mt-4">
                <div class="col-md-6 mb-3">
                    <label>Nome Responsável</label>
                    <input type="text" class="form-control" name="nome_responsavel" value="<?php echo $nome_responsavel; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Tipo Responsável</label>
                    <input type="text" class="form-control" name="tipo_responsavel" value="<?php echo $tipo_responsavel; ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label>Curso</label>
                    <select class="form-select" name="curso">
                        <option value="Informática" <?php echo ($curso == 'Informática') ? 'selected' : ''; ?>>Informática</option>
                        <option value="Desenvolvimento de Sistemas" <?php echo ($curso == 'Desenvolvimento de Sistemas') ? 'selected' : ''; ?>>Desenvolvimento de Sistemas</option>
                        <option value="Enfermagem" <?php echo ($curso == 'Enfermagem') ? 'selected' : ''; ?>>Enfermagem</option>
                        <option value="Administração" <?php echo ($curso == 'Administração') ? 'selected' : ''; ?>>Administração</option>
                    </select>
                </div>
            </div>

            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="d-grid gap-2 col-6 mx-auto mt-4">
                <button type="submit" name="update" class="btn btn-warning btn-lg">Salvar Alterações</button>
                <a href="listar_alunos.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>