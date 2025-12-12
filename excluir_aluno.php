<?php
include 'conexao.php';

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Usando Prepared Statement para segurança
    $sqlSelect = "SELECT * FROM alunos WHERE id=?";
    $stmt = $conexao->prepare($sqlSelect);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Se o aluno existe, deleta
        $sqlDelete = "DELETE FROM alunos WHERE id=?";
        $stmtDelete = $conexao->prepare($sqlDelete);
        $stmtDelete->bind_param("i", $id);
        $stmtDelete->execute();
    }
}

// Redireciona de volta para a lista
header('Location: listar_alunos.php');
exit;
?>