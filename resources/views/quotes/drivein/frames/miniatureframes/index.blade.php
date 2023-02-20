@extends('adminlte::page')

@section('title', 'COTIZADOR')

@section('content_header')
    <x-header-cot>Sistema de Cotización Tyrsa</x-header-cot>
@stop

@section('content')
    <div class="container w-full bg-white p-3 rounded-xl shadow-xl">
        <div class="row m-3">
            {!! Form::open(['method'=>'POST','route'=>['miniatureframe.store']]) !!}
            <input type="hidden" name="Quotation_Id" value="{{$Quotation_Id}}">
            <div  class="row bg-white p-4 shadow-lg rounded-lg">
                <div class="col-sm-8 col-xs-12">
                    <h2><i class="fa-solid fa-crop-simple"></i>&nbsp;Mini Marcos</h2>
                    <span>Favor de Seleccionar y llenar los campos solicitados para realizar la cotización.</span>
                    <div class="card-body text-center">
                        <img src="{{asset('vendor/img/postes/logo.png')}}" class="img-thumbnail img-fluid max-h-80 rounded mx-auto d-block" alt="">
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="form-group p-2">
                        <x-jet-label value="* Cantidad de Marcos" />
                        <input type="number" name="amount" class="inputjet w-full text-xs uppercase" value="{{ old('amount') }}" />
                        <x-jet-input-error for='amount' /><br>
                        <x-jet-label value="* Seleccione el Calibre" />
                        <select name="caliber" class="inputjet w-full text-xs uppercase">
                            <option value="14" @if (old('caliber')==14) selected @endif>14</option>
                            <option value="16" @if (old('caliber')==16) selected @endif>16</option>
                        </select>
                        <x-jet-input-error for='caliber' /><br>
                        <x-jet-label value="* Altura de Pandeo" />
                        <select name="buckling_mini" class="inputjet w-full text-xs uppercase">
                            @foreach ($buckling_mini as $row)
                                <option value="{{$row->buckling_mini}}" @if (old('buckling_mini')==$row->buckling_mini) selected @endif>{{$row->buckling_mini}}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for='buckling_mini' /><br>
                        <x-jet-label value="* Capacidad de carga por módulo en Kg" />
                        <input type="number" name="weight" class="inputjet w-full text-xs uppercase" />
                        <x-jet-input-error for='weight' /><br>
                        <x-jet-label value="* Fondo" />
                        <select name="depth_mini" class="inputjet w-full text-xs uppercase">
                            @foreach ($depth_mini as $row)
                                <option value="{{$row->depth_mini}}"@if (old('depth_mini')==$row->depth_mini) selected @endif>{{$row->depth_mini}}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for='depth_mini' /><br>
                        <x-jet-label value="* Altura" />
                        <select name="height_mini" class="inputjet w-full text-xs uppercase">
                            @foreach ($height_mini as $row)
                                <option value="{{$row->height_mini}}" @if (old('height_mini')==$row->height_mini) selected @endif>{{$row->height_mini}}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for='height_mini' /><br>
                    </div>
                    <div class="form-group p-2 gap-2 flex items-center">
                        <button type="submit" class="btn btn-blue mb-2">
                            <i class="fa-solid fa-calculator fa-xl"></i>&nbsp; Calcular
                        </button>
                        <a href="{{route('menuframes.show', $Quotation_Id)}}" class="btn btn-black mb-2">
                            <i class="fa-solid fa-rotate-left fa-xl"></i>&nbsp; Cancelar
                        </a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('js')
    @if (session('no_existe') == 'ok')
        <script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/no_existe.js') }}"></script>
    @endif
@stop