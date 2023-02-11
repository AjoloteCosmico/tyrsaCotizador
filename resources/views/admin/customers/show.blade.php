@extends('adminlte::page')

@section('title', 'EDITAR CLIENTES')

@section('content_header')
    <h1 class="font-bold"><i class="fas fa-building"></i>&nbsp; Cliente</h1>
@stop

@section('content')
    <div class="container bg-gray-300 shadow-lg rounded-lg">
        <div class="row rounded-b-none rounded-t-lg shadow-xl bg-white">
            <h5 class="card-title p-2">
                <i class="fas fa-edit"></i>&nbsp; Editar Datos del Cliente:
            </h5>
        </div>
        <form action="{{ route('customers.update', $Sucursal->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row rounded-b-lg rounded-t-none mb-4 shadow-xl bg-gray-300">
            <div class="col-xs-12 p-2 shadow-lg gap-2">
                <input type="hidden" name="id" value="{{$Sucursal->id}}"/>
                <div class="form-group">
                    <x-jet-label value="* Tipo de Cliente" />
                    <select class="form-capture w-full text-xs" name="company_type">
                        <option value="">Seleccionar Cliente</option>
                        <option value="{{ $Sucursal->company_type }}" selected>{{ $Sucursal->company_type }}</option>
                        <option value="">Seleccionar Tipo de Cliente</option>
                        <option value="TRIPLE A">TRIPLE A</option>
                        <option value="MEDIANA">MEDIANA</option>
                        <option value="PEQUEÑA">PEQUEÑA</option>
                        <option value="GRANDE">GRANDE</option>
                    </select>
                    <x-jet-input-error for='company_type' />
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 p-2 shadow-lg gap-2">
                <div class="form-group">
                    <x-jet-label value="* Cliente" />
                    <x-jet-input type="text" name="company" class="w-full text-xs uppercase" value="{{$Sucursal->company}}" />
                    <x-jet-input-error for='company' />
                </div>
                <div class="form-group">
                    <x-jet-label value="RFC" />
                    <x-jet-input type="text" name="rfc" class="w-full text-xs uppercase" value="{{$Sucursal->rfc}}" />
                    <x-jet-input-error for='rfc' />
                </div>
                <div class="form-group">
                    <x-jet-label value="* Email Coorporativo" />
                    <x-jet-input type="text" name="email" class="w-full text-xs uppercase" value="{{$Sucursal->email}}" />
                    <x-jet-input-error for='email' />
                </div>
                <div class="form-group">
                    <x-jet-label value="* Teléfono" />
                    <x-jet-input type="text" name="telephone" class="w-full text-xs uppercase" value="{{$Sucursal->telephone}}" />
                    <x-jet-input-error for='telephone' />
                </div>
                <div class="form-group">
                    <x-jet-label value="* Cliente o Distribuidor" />
                    <select class="form-capture w-full text-xs" name="distrib_or_client">
                        <option value="{{ $Sucursal->distrib_or_client }}" selected>{{ $Sucursal->distrib_or_client }}</option>
                        <option value="">Seleccionar</option>
                        <option value="CLIENTE">CLIENTE</option>
                        <option value="DISTRIBUIDOR">DISTRIBUIDOR</option>
                        <option value="CLIENTE Y DISTRIBUIDOR">CLIENTE Y DISTRIBUIDOR</option>
                    </select>
                    <x-jet-input-error for='distrib_or_client' />
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 p-2 shadow-lg gap-2">
                <div class="form-group">
                    <x-jet-label value="* Estado" />
                    <x-jet-input type="text" name="state" class="w-full text-xs uppercase" value="{{$Sucursal->state}}" />
                    <x-jet-input-error for='state' />
                </div>
                <div class="form-group">
                    <x-jet-label value="* Ciudad" />
                    <x-jet-input type="text" name="city" class="w-full text-xs uppercase" value="{{$Sucursal->city}}" />
                    <x-jet-input-error for='city' />
                </div>
                <div class="form-group">
                    <x-jet-label value="* Colonia" />
                    <x-jet-input type="text" name="suburb" class="w-full text-xs uppercase" value="{{$Sucursal->suburb}}" />
                    <x-jet-input-error for='suburb' />
                </div>
                <div class="form-group">
                    <x-jet-label value="* C.P." />
                    <x-jet-input type="text" name="postal_code" class="w-full text-xs uppercase" value="{{$Sucursal->postal_code}}" />
                    <x-jet-input-error for='postal_code' />
                </div>
                <div class="form-group">
                    <x-jet-label value="* Dirección" />
                    <x-jet-input type="text" name="address" class="w-full text-xs uppercase" value="{{$Sucursal->address}}" />
                    <x-jet-input-error for='address' />
                </div>
                <div class="form-group">
                    <x-jet-label value="* Número Exterior" />
                    <x-jet-input type="text" name="extern_number" class="w-full text-xs uppercase" value="{{$Sucursal->extern_number}}"/>
                    <x-jet-input-error for='extern_number' />
                </div>
                <div class="form-group">
                    <x-jet-label value="Número Interior" />
                    <x-jet-input type="text" name="intern_number" class="w-full text-xs uppercase" value="{{$Sucursal->intern_number}}"/>
                    <x-jet-input-error for='intern_number' />
                </div>
            </div>
            
            
            
            <div class="col-12 text-right p-2 shadow-lg gap-2">
                <a href="{{ route('customers.index')}}" class="btn btn-green mb-2">
                    <i class="fas fa-times fa-2x"></i>&nbsp;&nbsp; Cancelar
                </a>
                <button type="submit" class="btn btn-red mb-2">
                    <i class="fas fa-save fa-2x"></i>&nbsp; &nbsp; Guardar
                </button>
            </div>
        </div>
        </form>
    </div>
    <div class="w-100 mb-4"><hr></div>
    <div class="container bg-gray-300 shadow-lg rounded-lg">
        <div class="row rounded-b-none rounded-t-lg shadow-xl bg-white">
            <h5 class="card-title p-2">
                <i class="fas fa-edit"></i>&nbsp; Agregar Contactos:
            </h5>
        </div>
        <div class="row rounded-b-lg rounded-t-none mb-4 shadow-xl bg-gray-300">
            <div class="col-xs-12 col-sm-9 p-3 table-responsive bg-white">
                <table class="table tablemembers table-responsive table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Sede</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Contacts as $row)
                            <tr>
                                <td>{{$row->contact}}</td>
                                <td>{{$row->telephone}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->campus}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-xs-12 col-sm-3 p-3 text-center items-center inline-flex bg-white">
                {{-- <a href="{{ route('miembros.principal', $Sucursal->id)}}" class="btn btn-green">
                    <i class="fas fa-edit"></i>&nbsp; Miembros
                </a> --}}
                <a href="" class="btn btn-green">
                    <i class="fas fa-edit"></i>&nbsp; Contactos
                </a>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .image-wrapper{
            position: relative;
            padding-bottom: 60%;
        }

        .image-wrapper img{
            position: absolute;
            object-fit:scale-down;
            width: 100%;
            height: 100%;
            max-width: 180px;
            max-height: 180px
        }
    </style>
@stop

@section('js')
<script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/tablemembers.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/refresh_image.js') }}"></script>
@stop