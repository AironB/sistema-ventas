@extends('layouts.app')
@section('titulo', 'Mi perfil')
<style>
    .contenedor {
        background: white;
        padding: 15px;
        display: flex;
        justify-content: space-around;
        gap: 20px;
        align-items: center;
    }

    .img {
        width: 130px;
        height: 130px;
        border-radius: 250px;
    }

    @media screen and(max-width:600px) {
        .contenedor {
            flex-direction: row;
            justify-content: center;
            flex-wrap: wrap;
            align-items: center;
        }
    }
</style>
@section('content')
    @if (@session('mensaje'))
        <script>
            $(function notification() {
                new PNotify({
                    title: "CORRECTO",
                    type: "success",
                    text: "{{ session('mensaje') }}",
                    styling: "bootstrap3"

                });
            });
        @endif
        </script>
        @if (@session('mensaje'))
            <script>
                $(function notification() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "{{ session('error') }}",
                        styling: "bootstrap3"

                    });
                });
            </script>

        @endif
        <h4 class="text-center text-secondary"> MI PERFIL </h4>
        @foreach ($datos as $item)
            <div class="contenedor">
                <div>
                    @if ($item->foto !=null)
                    <img class="img" src="{{ asset("storage/FOTOS-PERFIL-USUARIO/$item->foto") }}">
                    @else
                    <img class="img" src="{{ asset("/image/img.jpg") }}">
                    @endif

                </div>
                <div>
                    <h6><b>Modificar Imagen</b></h6>
                    <form action="{{ route('usuario.actualizarIMG') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="alert alert-secondary">Seleccionamos una imagen no muy pesada y en un formato valido...
                        </div>
                        <div>
                            <input type="file" name="foto"class="input form-control-file mb-5"
                                accept=".jpg, .png, .jpeg">
                            @error('foto')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success btn-rounded">Modificar </button>
                            <button class="btn btn-danger btn-rounded">Eliminar foto</button>
                        </div>
                        <div>
                            <div class="fl-flex-label col-12 col-lg-6 mb-4">
                                <input type="text" class="input input__text" placeholder="DUI">
                            </div>
                            <div class="fl-flex-label col-12 col-lg-6 mb-4">
                                <input type="text" class="input input__text" placeholder="Nombres"
                                    value="{{ $item->nombre }}">
                            </div>
                            <div class="fl-flex-label col-12 col-lg-6 mb-4">
                                <input type="text" class="input input__text" placeholder="Apellidos"
                                    value="{{ $item->apellido }}">
                            </div>
                            <div class="fl-flex-label col-12 col-lg-6 mb-4">
                                <input type="text" class="input input__text" placeholder="Usuario"
                                    value="{{ $item->usuario }}">
                            </div>
                            <div class="fl-flex-label col-12 col-lg-6 mb-4">
                                <input type="text" class="input input__text" placeholder="Direccion"
                                    value={{ $item->direccion }}>
                            </div>
                            <div class="fl-flex-label col-12 col-lg-6 mb-4">
                                <input type="number" class="input input__text" placeholder="Telefono"
                                    value="{{ $item->telefono }}">
                            </div>
                            <div class="fl-flex-label col-12 col-lg-6 mb-4">
                                <input type="email" class="input input__text" placeholder="Correo"
                                    value="{{ $item->correo }}">
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary btn-rounded"> Guardar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        @endforeach
    @endsection
