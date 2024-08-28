<x-app-layout>

    <style>
        .container {
            max-width: 1250px;
            width: 100%;
        }
        .card-text{
            font-size: 14px;
            text-align: justify;
        }
        .btn{
            background-color: #642D8E;
            border: solid 1px #642D8E;
        }
        .card-img-top{
            margin: auto;
            object-fit: cover;
            width: 80%;
        }
    </style>
    <div class="container mt-5">
        <div class="row">
            @foreach($eventos as $evento)
            <div class="col-sm-12 col-md-6 col-lg-3">
                <a href="">
                    <div class="card">
                        <img src="{{ asset('assets/img/eventos/mes_del_actor.png') }}" class="card-img-top" alt="Logo Mes Del Actor">                        
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-center">{{$evento->nombre}}</h5>
                            <p class="card-text">{{$evento->descripcion}}</p>
                            <a href="/registro" class="btn btn-primary mt-4 w-100">Registro</a>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
    </div>
</x-app-layout>