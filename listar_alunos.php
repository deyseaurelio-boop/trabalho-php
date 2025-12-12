<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Lista de Alunos</title>
</head>
<body>
    <?php include('navbar.php'); ?>
    <?php include('conexao.php'); ?>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Lista de Alunos Cadastrados</h2>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Curso</th>
                        <th>Cidade</th>
                        <th>Responsável</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // 1. Consulta SQL para pegar todos os alunos
                    $sql = "SELECT * FROM alunos";
                    $result = $conexao->query($sql);

                    // 2. Verifica se há resultados
                    if ($result->num_rows > 0) {
                        // 3. Loop para criar as linhas da tabela
                        while($user_data = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $user_data['id'] . "</td>";
                            echo "<td>" . $user_data['nome'] . "</td>";
                            echo "<td>" . $user_data['curso'] . "</td>";
                            echo "<td>" . $user_data['cidade'] . "</td>";
                            echo "<td>" . $user_data['nome_responsavel'] . "</td>";
                            echo "<td class='text-center'>
                                    <a href='editar_aluno.php?id=$user_data[id]' class='btn btn-warning btn-sm'>
                                        Editar
                                    </a>
                                    
                                    <a href='excluir_aluno.php?id=$user_data[id]' 
                                       class='btn btn-danger btn-sm' 
                                       onclick='return confirm(\"Tem certeza que deseja excluir este aluno?\")'>
                                        Excluir
                                    </a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>Nenhum aluno cadastrado.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <div class="d-grid gap-2 col-3 mx-auto mt-4">
            <a href="cadastroform.php" class="btn btn-primary">Cadastrar Novo Aluno</a>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>