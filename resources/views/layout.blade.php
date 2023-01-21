<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .job .card-body {
            height: 300px;
            overflow: auto;
        }

        .job {
            height: 350px;
        }

        .job .card-head {
            height: 60px;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="bg-secondary">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">Careers</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/">Home</a>
                            </li>
                            @if(auth()->check())
                            <li class="nav-item">
                                <a class="nav-link" href="/application">Applications</a>
                            </li>
                            @endif
                        </ul>
                        @if(auth()->check())
                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#createJob">
                            Create Job
                        </button>
                        
                        <a href="/logout" class="mx-2 btn btn-sm btn-primary">Logout</a>
                        @else
                        <a href="/login" class="mx-2 btn btn-sm btn-primary">Login</a>
                        @endif
                    </div>
                </div>
            </nav>
        </header>
        @yield('content')
        </section>
    </div>

</body>

</html>