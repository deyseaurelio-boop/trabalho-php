<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastro - Escola</title>
</head>
<body>
    <?php include('navbar.php'); ?>

    <div class="container mt-5">
        <h1 class="text-center">FORMULÁRIO DE CADASTRO DO ALUNO</h1>

        <form id="formCadastro" method="POST">
            
            <div class="row justify-content-center mt-4">
                <div class="col-md-6 mb-3">
                    <label for="nome" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="data_nascimento" class="form-label">Data Nascimento</label>
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                </div>
            </div>

            <fieldset class="mt-4 border p-3 rounded">
                <legend class="float-none w-auto px-3 h5">Endereço</legend>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cidade" class="form-label">Cidade:</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="rua" class="form-label">Rua:</label>
                        <input type="text" class="form-control" id="rua" name="rua" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="bairro" class="form-label">Bairro:</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="numero" class="form-label">Número:</label>
                        <input type="text" class="form-control" id="numero" name="numero" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cep" class="form-label">CEP:</label>
                        <input type="text" class="form-control" id="cep" name="cep" required>
                    </div>
                </div>
            </fieldset>

            <div class="row justify-content-center mt-4">
                <div class="col-md-6 mb-3">
                    <label for="nome_responsavel" class="form-label">Nome Responsável</label>
                    <input type="text" class="form-control" id="nome_responsavel" name="nome_responsavel" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tipo_responsavel" class="form-label">Tipo Responsável</label>
                    <input type="text" class="form-control" id="tipo_responsavel" name="tipo_responsavel" required>
                </div>
            </div>

            <div class="row justify-content-center mt-2">
                <div class="col-md-12 mb-3">
                    <label for="curso" class="form-label">Curso</label>
                    <select class="form-select" id="curso" name="curso">
                        <option value="Informática">Informática</option>
                        <option value="Desenvolvimento de Sistemas">Desenvolvimento de Sistemas</option>
                        <option value="Enfermagem">Enfermagem</option>
                        <option value="Administração">Administração</option>
                    </select>
                </div>
            </div>

            <div class="d-grid gap-2 col-6 col-md-4 mx-auto mt-4 mb-5">
                <button type="submit" class="btn btn-primary btn-lg">Cadastrar Aluno</button>
            </div>
        </form>
    </div>

    <div class="modal fade" id="modalSucesso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="exampleModalLabel">Sucesso!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            <p class="fs-5">Aluno cadastrado com sucesso!</p>
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cadastrar Outro</button>
            <a href="#" class="btn btn-primary">Ver Lista</a>
          </div>
        </div>
      </div>
    </div>

    <?php include('footer.php'); ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Seleciona o formulário
        const form = document.getElementById('formCadastro');
        // Cria a instância do Modal do Bootstrap
        const modalSucesso = new bootstrap.Modal(document.getElementById('modalSucesso'));

        form.addEventListener('submit', function(e) {
            e.preventDefault(); // 1. Impede o formulário de recarregar a página

            // 2. Coleta os dados do formulário
            const formData = new FormData(this);

            // 3. Envia para o PHP via fetch (AJAX)
            fetch('processa_cadastro.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json()) // Espera uma resposta JSON
            .then(data => {
                if (data.success) {
                    // 4. Se deu certo: Limpa o formulário e abre o Modal
                    form.reset(); 
                    modalSucesso.show();
                } else {
                    // Se deu erro no banco
                    alert('Erro: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Ocorreu um erro na requisição.');
            });
        });
    </script>

</body>
</html>