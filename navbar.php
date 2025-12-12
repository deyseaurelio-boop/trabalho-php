<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #d63384">
    <div class="container-fluid">
        
        <a class="navbar-brand" href="home.php">
            Sistema Deyse
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPrincipal" aria-controls="navbarPrincipal" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarPrincipal">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php">
                        <i class="bi bi-house-door-fill me-1"></i> Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="cadastroform.php">
                        <i class="bi bi-person-plus-fill me-1"></i> Cadastro
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link active" href="listar_alunos.php">
                        <i class="bi bi-list-ul me-1"></i> Alunos
                    </a>
                </li>
            </ul>

            <span class="navbar-text me-3 text-white">
                Olá, Pessoa
            </span>

            <a href="logout.php" class="btn btn-danger btn-sm">
                <i class="bi bi-box-arrow-right"></i> Sair
            </a>
        </div>
    </div>
</nav>