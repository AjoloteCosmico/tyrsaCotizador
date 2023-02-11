@extends('adminlte::page')

@section('title', 'USUARIOS')

@section('content_header')
    <h1 class="font-bold"><i class="fas fa-edit"></i>&nbsp; Editar Usuario</h1>
@stop

@section('content')
    <div class="container bg-gray-300 shadow-lg rounded-lg">
        <div class="row p-4 rounded-b-none rounded-t-lg shadow-xl bg-white">
            <h5 class="card-title p-2">
                <i class="fas fa-edit"></i>&nbsp; Editar Usuario
            </h5>
        </div>
        {!! Form::open(['method'=>'PUT','route'=>['users.update',$usuario->id]]) !!}
        <div class="row p-4 rounded-b-lg rounded-t-none mb-4 shadow-xl bg-gray-300">
            <div class="col-xs-12 p-2 gap-2">
                <div class="form-group">
                    <x-jet-label value="* Nombre" />
                    {!! Form::text('name', $usuario->name, ['class'=>'inputjet w-full text-xs uppercase']) !!}
                    <x-jet-input-error for='name' />
                </div>
            </div>
            <div class="col-xs-12 p-2 gap-2">
                <div class="form-group">
                    <x-jet-label value="* Email" />
                    {!! Form::text('email', $usuario->email, ['class'=>'inputjet w-full text-xs uppercase']) !!}
                    <x-jet-input-error for='email' />
                </div>
            </div>
            <div class="col-xs-12 p-2 gap-2">
                <div class="form-group">
                    <x-jet-label value="* Rol" />
                    {!! Form::select('roles[]', $roles, $usuarioRole, ['class'=>'inputjet w-full text-xs uppercase']) !!}
                    <x-jet-input-error for='roles' />
                </div>
            </div>
            <div class="col-xs-12 p-2 gap-2">
                <div class="form-group">
                    <x-jet-label value="* Zona" />
                    @if (empty($usuarioZone))
                        <select name="zones" id="zones" class="inputjet w-full text-xs uppercase">
                            @foreach ($Zonas as $row)
                            <option value="{{$row->id}}">{{$row->zone}}</option>
                            @endforeach
                        </select>
                    @else
                        <select name="zones" id="zones" class="inputjet w-full text-xs uppercase">
                            <option selected value="{{$usuarioZoneid}}">{{$usuarioZone}}</option>
                            @foreach ($Zonas as $row)
                            <option value="{{$row->id}}">{{$row->zone}}</option>
                            @endforeach
                        </select>
                    @endif
                    <x-jet-input-error for='zones' />
                </div>
            </div>
            <div class="col-xs-12 p-2 gap-2">
                <div class="form-group">
                    <x-jet-label value="* Password" />
                    {!! Form::password('password', ['class'=>'inputjet w-full text-xs uppercase']) !!}
                    <x-jet-input-error for='password' />
                </div>
            </div>
            <div class="col-xs-12 p-2 gap-2">
                <div class="form-group">
                    <x-jet-label value="* Confirmar Password" />
                    {!! Form::password('confirm-password', ['class'=>'inputjet w-full text-xs uppercase']) !!}
                    <x-jet-input-error for='confirm-password' />
                </div>
            </div>
            <div class="col-12 text-right p-2 gap-2">
                <a href="{{ route('users.index')}}" class="btn btn-green mb-2">
                    <i class="fas fa-times fa-2x"></i>&nbsp;&nbsp; Cancelar
                </a>
                <button type="submit" class="btn btn-red mb-2">
                    <i class="fas fa-save fa-2x"></i>&nbsp; &nbsp; Guardar
                </button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop

@section('css')
    
@stop

@section('js')
    
@stop