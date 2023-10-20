<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importar arquivo JSON</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.css">
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

        /* Estilo para alinhar os botões no centro */
        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Estilo para espaçamento entre os botões */
        .btn-space {
            margin-top: 10px;
        }

        /* Estilo para o elemento "selected-file-name" */
        #selected-file-name {
            font-size: 12px;
            font-weight: bold;
            font-style: italic;
            text-transform: uppercase;
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
                <h1>Importar JSON</h1>
                <!-- Container ao redor dos botões de importação e fila -->
                <div class="container d-flex align-items-center" style="justify-content: space-evenly;">
                    <button class="btn btn-primary btn-block" id="import-button" style="background-color: #9147ff; border-color: #9147ff;">Importar arquivo JSON</button>
                    <button class="btn btn-success btn-block" id="add-to-queue-button">Adicionar na fila</button>
                </div>
                <p class="mt-3">Clique no botão acima para importar um arquivo no formato JSON.</p>
                <input type="file" id="file-input" style="display: none;" accept=".json">
                <p id="selected-file-name" class="mt-2"></p>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.all.min.js"></script>
    <script>
        // Verificando se um arquivo JSON foi carregado
        function isJSONFileLoaded() {
            const selectedFile = document.getElementById("file-input").files[0]
            return selectedFile && selectedFile.name.endsWith('.json')
        }

        // Enviando o arquivo JSON para o servidor via AJAX
        function uploadJSONFile() {
            if(isJSONFileLoaded()) {
                const fileInput = document.getElementById("file-input")
                const selectedFile = fileInput.files[0]

                // Criando um objeto FormData para enviar o arquivo
                const formData = new FormData()
                formData.append('jsonFile', selectedFile)

                // Faça a solicitação POST usando a função fetch
                fetch("{{ url('upload-json-file') }}", {
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    method: 'POST',
                    body: formData,
                })
                .then(response => {
                    if(response.ok) {
                        return response.json()
                    }
                    
                    else {
                        Swal.fire('Erro', 'Erro no servidor.', 'error')
                    }
                })
                .then(data => {
                    Swal.fire('Upload bem-sucedido!', 'Seu arquivo JSON foi adicionado à fila corretamente.', 'success').then((result) => {
                        if(result.isConfirmed) {
                            location.href = "{{ url('process') }}"
                        }
                    })
                })
                .catch(error => {
                    Swal.fire('Erro', 'Ocorreu um erro durante o upload.', 'error')
                })
            }
            
            else {
                Swal.fire('Erro', 'Selecione um arquivo JSON antes de fazer o upload.', 'error')
            }
        }

        // Adicionando a funcionalidade do SweetAlert ao botão "Adicionar na fila"
        document.getElementById("add-to-queue-button").addEventListener("click", uploadJSONFile)

        // Abrindo o seletor de arquivo ao clicar no botão "Importar arquivo JSON"
        document.getElementById("import-button").addEventListener("click", function() {
            document.getElementById("file-input").click()
        })

        // Exibindo o nome do arquivo apenas quando um arquivo for selecionado
        document.getElementById("file-input").addEventListener("change", function() {
            const fileInput = document.getElementById("file-input")
            const selectedFile = fileInput.files[0]
            const selectedFileNameElement = document.getElementById("selected-file-name")

            if(selectedFile) {
                // Exibindo o nome do arquivo abaixo dos botões
                selectedFileNameElement.textContent = "Arquivo selecionado: " + selectedFile.name
                selectedFileNameElement.style.display = "block"
            }
            
            else {
                // Escondendo o elemento quando nenhum arquivo está selecionado
                selectedFileNameElement.style.display = "none"
            }
        })
    </script>
</body>
</html>
