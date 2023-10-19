<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processamento de Documentos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <style>
        body {
            color: #FFFFFF;
            background-color: #2d333b;
            margin: 0;
        }

        .navbar {
            background-color: #1c2128;
            position: fixed;
            width: 100%;
        }

        .navbar a {
            color: #FFFFFF !important;
            font-size: 14px !important;
        }

        .container-fluid {
            justify-content: start !important;
        }

        .navbar-brand {
            margin-right: 20px;
        }

        .table {
            background-color: #FFFFFF;
            border-radius: 4px;
            border-collapse: collapse; /* Remove espaçamento entre linhas */
        }

        .table th,
        .table td {
            padding: 8px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Importação</a>
            <a class="navbar-brand" href="{{ url('/process') }}">Processamento</a>
        </div>
    </nav>
    <main class="col">
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="text-center">
                <h1>Processamento de Documentos</h1>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Categoria</th>
                            <th>Título</th>
                            <th>Conteúdo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Cat1</td>
                            <td>Título 1</td>
                            <td>Conteúdo 1</td>
                        </tr>
                        <tr>
                            <td>Cat2</td>
                            <td>Título 2</td>
                            <td>Conteúdo 2</td>
                        </tr>
                        <tr>
                            <td>Cat3</td>
                            <td>Título 3</td>
                            <td>Conteúdo 3</td>
                        </tr>
                    </tbody>
                </table>
                <p class="mt-4">Você pode processar os documentos importados abaixo.</p>
                <button class="btn btn-success" id="process-button">Processar</button>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("process-button").addEventListener("click", function () {
            Swal.fire({
                title: 'Confirmação',
                text: 'Tem certeza de que deseja processar os documentos?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim',
                cancelButtonText: 'Não'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Processamento iniciado!', 'Os documentos estão sendo processados.', 'success');
                }
            });
        });
    </script>
</body>
</html>
