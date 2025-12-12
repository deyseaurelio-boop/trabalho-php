<?php
// 1. Inclui a conexão
include 'conexao.php';

// Configuração: Quantos alunos deseja criar?
$qtd_alunos = 100;

// 2. Arrays de dados para sortear (Dados "Fake")
$nomes = ['Alana', 'Brena', 'Christian', 'Douglas', 'Escarlatte', 'Frederico', 'Gabrielly', 'Heitor', 'Ivone', 'Jussara', 'Leônidas', 'Mariane', 'Nirvana', 'Orlandina', 'Pietro', 'Ravi', 'Sulamita', 'Theo', 'Ursula','Valdir', 'Wladimir', 'Xuxa', 'Yugo', 'Zendaia'];
$sobrenomes = ['Silva', 'Santos', 'Oliveira', 'Souza', 'Rodrigues', 'Ferreira', 'Alves', 'Pereira', 'Lima', 'Gomes', 'Costa', 'Martins', 'Araujo', 'Bernaldino', 'Cordeiro', 'Teixeira', 'Castro', 'Aurelio', 'Nobre', 'Carneiro', 'Marinho', 'Bindá', 'Bezerra', 'Portela'];
$cidades = ['Crateús', 'Independência', 'Tianguá', 'Viçosa do Ceará', 'Ipaporanga', 'Catunda', 'Novo Oriente', 'Nova Russas', 'Jijoca de jericoacuara'];
$bairros = ['Centro', 'Maratoan', 'Venâncios', 'Cidade Nova', 'José rosa', 'Cidade 2000', 'Altamira', 'Planalto', 'Simeão', 'Realejo', 'Ingá', 'Curral do Meio', 'Varzea da Palha', 'Baixa do Juazeiro'];
$cursos = ['Informática', 'Desenvolvimento de Sistemas', 'Enfermagem', 'Administração'];
$tipos_resp = ['Pai', 'Mãe', 'Avó', 'Avô', 'Tio', 'Tia', 'Madrasta'];
$ruas_pref = ['Rua', 'Avenida', 'Alameda', 'Travessa'];

echo "<h3>Iniciando a geração de $qtd_alunos alunos...</h3>";

// Prepara a query (fora do loop para ser mais rápido e seguro)
$sql = "INSERT INTO alunos (nome, data_nascimento, cidade, rua, bairro, numero, cep, nome_responsavel, tipo_responsavel, curso) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conexao->prepare($sql);

if ($stmt === false) {
    die("Erro no prepare: " . $conexao->error);
}

// 3. Loop para criar os registros
for ($i = 0; $i < $qtd_alunos; $i++) {
    
    // Sorteia dados aleatórios
    $nome_completo = $nomes[array_rand($nomes)] . ' ' . $sobrenomes[array_rand($sobrenomes)] . ' ' . $sobrenomes[array_rand($sobrenomes)];
    
    // Gera data de nascimento aleatória (entre 2000 e 2010)
    $timestamp = mt_rand(strtotime('2000-01-01'), strtotime('2010-12-31'));
    $data_nascimento = date('Y-m-d', $timestamp);
    
    $cidade = $cidades[array_rand($cidades)];
    $rua = $ruas_pref[array_rand($ruas_pref)] . ' ' . $nomes[array_rand($nomes)];
    $bairro = $bairros[array_rand($bairros)];
    $numero = rand(10, 500); // Número entre 10 e 500
    $cep = rand(10000, 99999) . '-' . rand(100, 999);
    
    $nome_responsavel = $nomes[array_rand($nomes)] . ' ' . $sobrenomes[array_rand($sobrenomes)];
    $tipo_responsavel = $tipos_resp[array_rand($tipos_resp)];
    $curso = $cursos[array_rand($cursos)];

    // Vincula os parâmetros e executa
    $stmt->bind_param("ssssssssss", 
        $nome_completo, 
        $data_nascimento, 
        $cidade, 
        $rua, 
        $bairro, 
        $numero, 
        $cep, 
        $nome_responsavel, 
        $tipo_responsavel, 
        $curso
    );
    
    $stmt->execute();
}

echo "✅ <strong>Sucesso!</strong> $qtd_alunos alunos foram inseridos no banco de dados.<br>";
echo "<br><a href='listar_alunos.php'>Ver Lista de Alunos</a>";

// Fecha conexão
$stmt->close();
$conexao->close();
?>