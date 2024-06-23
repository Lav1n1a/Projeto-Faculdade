<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Consultas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800;900&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&family=Poppins:wght@400;800;900&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Phudu:wght@500&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css"  rel="stylesheet" />
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            font-family: 'Poppins', sans-serif;
            font-family: 'Roboto', sans-serif;

        }
        .conteudo-principal {
            padding-top: 50px;
            
        }
    </style>
</head>

<body>
    <nav id="navegacao" class="navbar navbar-expand-lg bg-body-tertiary" style=" box-shadow: 2px 2px 20px 2px rgba(128, 128, 128, 0.61);">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="margin-left: 34px; font-family: 'Phudu', cursive; font-size: 27px;">Agenda<span style="color: #FF4F5A;"><i class="bi bi-calendar-plus"></i></span>Saude</a>
        </div>
    </nav>
    <div class="conteudo-principal">
       <section class="bg-white dark:bg-gray-900">
            <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                <div class="mr-auto place-self-center lg:col-span-7">
                    <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">Consultas sem sair de casa!</h1>
                    <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Entre na sua conta ou registre-se para fazer agendamento de consultas e entre em contato com profissionais online.</p>
                    <a href="/agendaphp/front/login.php" id="botao-login" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:bg-gray-700 dark:border-gray-700 dark:hover:bg-gray-800 dark:focus:ring-gray-800" style="background-color: #FF4F5A;">
                        Entrar
                    </a>
                    <a href="/agendaphp/front/cadastro.php"  id="botao-cadastrar" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800"  style="background-color: black; color: white;">
                    Cadastrar
                    </a> 
                </div>
                <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                    <img src="/agendaphp/front/assets/img-telainicial.png" style="width: 550px;" alt="Medicos">
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
</body>
</html>