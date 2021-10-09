<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>@yield('title')</title>
</head>
<body>

    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('get.indexAdmin') }}"><i class="bi bi-flower2"></i> Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @auth
                        @can('insere_arquivos')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('get.upload') }}"><i class="bi bi-file-arrow-up"></i> Uploads</a>
                            </li>
                        @endcan
                        @can('edita_arquivos')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('get.editar') }}"><i class="bi bi-pencil-square"></i> Editar</a>
                            </li>
                        @endcan
                    @endauth

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('get.home') }}"><i class="bi bi-camera-reels"></i> Visualizar</a>
                    </li>
                    
                    @guest

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-right"></i> Entrar</a>
                        </li>
                        
                    @endguest

                    @auth
                        @can('edita_usuarios')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.get.principal') }}"><i class="bi bi-people"></i> Usuarios</a>
                            </li>
                        @endcan

                        <li class="nav-item">

                            <form action="{{ route('logout') }}" method="POST">
                            @csrf
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();"><i class="bi bi-box-arrow-in-left"></i> Sair</a>
                            </form>
                        </li>                    
                    @endauth

                </ul>

            </div>
            <div>
            @auth
                <span class="nav-link start-100">
                    Olá! {{ auth()->user()->name }}
                </span>
            @endauth
        </div>
        </div>
    </nav>

    </header>

    <main>
        <div class="container-fluid">
            <div class="row">
                @if (session('msg_sucesso'))
                    <div class="alert alert-primary" role="alert">
                        <p class="msg">{{session('msg_sucesso')}}</p>
                    </div>
                @elseif ((session('msg_erro')))
                    <div class="alert alert-danger" role="alert">
                        <p class="msg">{{session('msg_erro')}}</p>
                    </div>
                     
                @endif

                @yield('content')
            </div>
        </div>
    </main>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <footer>
        <div class="fixed-bottom navbar-light bg-light">
            <p>Unamed &copy @php echo date("Y");@endphp</p>
        </div>
    </footer>

</body>
</html>