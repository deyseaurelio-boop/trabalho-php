<?php
// processa_cadastro.php
header('Content-Type: application/json'); // Informa ao navegador que a resposta é JSON

include 'conexao.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Coleta dados
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

    // Prepara SQL
    $sql = "INSERT INTO alunos (nome, data_nascimento, cidade, rua, bairro, numero, cep, nome_responsavel, tipo_responsavel, curso) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conexao->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ssssssssss", $nome, $data_nascimento, $cidade, $rua, $bairro, $numero, $cep, $nome_responsavel, $tipo_responsavel, $curso);

        if ($stmt->execute()) {
            // Sucesso
            $response['success'] = true;
            $response['message'] = 'Aluno cadastrado com sucesso!';
        } else {
            // Erro na execução
            $response['success'] = false;
            $response['message'] = 'Erro ao inserir no banco: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        // Erro na preparação
        $response['success'] = false;
        $response['message'] = 'Erro na preparação SQL: ' . $conexao->error;
    }
    
    $conexao->close();
} else {
    $response['success'] = false;
    $response['message'] = 'Requisição inválida.';
}

// Retorna o JSON para o Javascript
echo json_encode($response);
?>