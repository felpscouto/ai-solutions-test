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
            min-width: 700px;
            background-color: #FFFFFF;
            border-radius: 4px;
            border-collapse: collapse; /* Remove espaçamento entre linhas */
        }

        .table th,
        .table td {
            padding: 8px;
            vertical-align: middle;
        }

        code {
            display: block;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px 0;
            white-space: pre-wrap;
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
                        @foreach($documents as $document)
                            <tr>
                                <td>{{ $document->category->name }}</td>
                                <td>{{ $document->title }}</td>
                                <td><code>{{ Illuminate\Support\Str::limit($document->contents, 20, $end = '...') }}</code></td>
                            </tr>
                        @endforeach
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
