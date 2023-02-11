@extends('adminlte::page')

@section('title', 'COTIZADOR')

@section('content_header')
    <x-header-cot>Sistema de Cotización Tyrsa</x-header-cot>
@stop

@section('content')
    <div class="container w-full bg-white p-3 rounded-xl shadow-xl">
        <div class="row m-2">
            <form action="{{route('material_list_engineering')}}" method="post">
                @method('POST')
                @csrf
                <input type="hidden" name="quotations_id" value="{{$Quotations->id}}">
                <div class="container bg-gray-300 shadow-sm rounded-xl p-3">
                    <div class="card p-3">
                        <div class="card-title bg-gray-300 m-2 p-2">
                            <h3 class="text-center font-bold h-5">INFORMACIÓN DEL SISTEMA QUE PREFIERE</h3>
                        </div>
                        <div class="card-body text-sm">
                            <p class="card-text mb-3">PIENSO QUE EL MEJOR SISTEMA PARA MANEJAR MI PRODUCTO ES MEDIANTE UN:</p>
                            <div class="row">
                                <div class="col-xs-12 col-sm-3">&nbsp;</div>
                                <div class="col-xs-12 col-sm-9">
                                    <div class="row">
                                        <div class="col-4 gap-1">
                                            <label><input type="radio" name="a1" value="SISTEMA SELECTIVO" id="a1_1"> SISTEMA SELECTIVO</label><br>
                                            <label><input type="radio" name="a1" value="SIST. CARTON FLOW" id="a1_2"> SIST. CARTON FLOW</label><br>
                                            <label><input type="radio" name="a1" value="CANTILEVER" id="a1_3"> CANTILEVER</label><br>
                                        </div>
                                        <div class="col-4 gap-1">
                                            <label><input type="radio" name="a1" value="SISTEMA DINAMICO" id="a1_4"> SISTEMA DINAMICO</label><br>
                                            <label><input type="radio" name="a1" value="SISTEMA PICKING" id="a1_5"> SISTEMA PICKING</label><br>
                                            <label><input type="radio" name="a1" value="DOBLE PROFUNDIDAD" id="a1_6"> DOBLE PROFUNDIDAD</label><br>
                                        </div>
                                        <div class="col-4 gap-1">
                                            <label><input type="radio" name="a1" value="SISTEMA PUSH BACK" id="a1_7"> SISTEMA PUSH BACK</label><br>
                                            <label><input type="radio" name="a1" value="SISTEMA DRIVE IN & THRU" id="a1_8"> SISTEMA DRIVE IN & THRU</label><br>
                                            <label><input type="radio" name="a1" value="MINI RACK" id="a1_9"> MINI RACK</label><br>
                                        </div>
                                        <div class="col-4 gap-1">
                                            <label><input type="radio" name="a1" value="PASARELA" id="a1_10"> PASARELA</label><br>
                                            <label><input type="radio" name="a1" value="SUGERIR" id="a1_11"> SUGERIR</label><br>
                                        </div>
                                        <div class="col-4 gap-1">
                                            <label><input type="radio" name="a1" value="ENTRE PISO" id="a1_12"> ENTRE PISO</label><br>
                                        </div>
                                        <div class="col-4 gap-1">
                                            <label><input type="radio" name="a1" value="ESTANTERÍA" id="a1_13"> ESTANTERÍA</label><br>
                                        </div>
                                    </div>
                                    <x-jet-input-error for='a1' />
                                </div>
                            </div>
                            <p class="card-text mb-3">MIS RAZONES SON LAS SIGUIENTES:</p>
                            <div class="row">
                                <div class="col-xs-12 col-sm-3">&nbsp;</div>
                                <div class="col-xs-12 col-sm-9">
                                    <div class="form-group">
                                        <textarea name="a2" rows="5" class="inputjet w-full text-xs uppercase">{{old('a2')}}</textarea>
                                        <x-jet-input-error for='a2' />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-title bg-gray-300 m-2 p-2">
                            <h3 class="text-center font-bold">INFORMACION DE LA CARGA</h3>
                        </div>
                        <div class="row">
                            <div class="grid grid-col-3 text-center">
                                <diiv class="col-start-2">
                                    <div class="card-title bg-gray-300 m-2 p-2">
                                        <h3 class="text-center font-bold">INFO. DEL PRODUCTO</h3>
                                    </div>
                                </diiv>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text mb-3">EL 1ER. PRODUCTO QUE VOY ALMACENAR ES:</p>
                            <div class="row">
                                <div class="col-xs-12 col-sm-3">&nbsp;</div>
                                <div class="col-xs-12 col-sm-9">
                                    <div class="form-group">
                                        <textarea name="a3" rows="5" class="inputjet text-sm w-full uppercase">{{old('a3')}}</textarea>
                                        <x-jet-input-error for='a3' />
                                    </div>
                                </div>
                            </div>
                            <p class="card-text mb-3">ESTE PRODUCTO LO VOY A ALMACENAR EN:</p>
                            <div class="row">
                                <div class="col-xs-12 col-sm-3">&nbsp;</div>
                                <div class="col-xs-12 col-sm-9">
                                    <div class="row">
                                        <div class="col-12 gap-2 inline-flex">
                                            <label><input type="checkbox" name="a4" value="BOLSAS" id="a4_1"> BOLSAS</label>
                                            <label><input type="checkbox" name="a5" value="ROLLOS" id="a5_2"> ROLLOS</label>
                                            <label><input type="checkbox" name="a6" value="BARRIL" id="a6_3"> BARRIL</label>
                                            <label><input type="checkbox" name="a7" value="CAJAS" id="a7_4"> CAJAS</label>
                                            <label><input type="checkbox" name="a8" value="TARIMAS" id="a8_5"> TARIMAS</label>
                                        </div>
                                    </div>
                                    <x-jet-input-error for='product_storage' />
                                </div>
                            </div>
                            <p class="card-text mb-3">ESTE PRODUCTO TIENE LAS DIMENSIONES:  (PESO Y ALTURA INCLUYE TARIMA)</p>
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col gap-1 inline-flex">
                                            <div class="form-group">
                                                <x-jet-label value="Frente" />
                                                <x-jet-input type="text" name="a9" class="w-flex uppercase"/>
                                                <x-jet-input-error for='a9' />
                                            </div>
                                            <div class="form-group">
                                                <x-jet-label value="Fondo" />
                                                <x-jet-input type="text" name="a10" class="w-flex uppercase"/>
                                                <x-jet-input-error for='a10' />
                                            </div>
                                            <div class="form-group">
                                                <x-jet-label value="Alto" />
                                                <x-jet-input type="text" name="a11" class="w-flex uppercase"/>
                                                <x-jet-input-error for='a11' />
                                            </div>
                                            <div class="form-group">
                                                <x-jet-label value="Peso" />
                                                <x-jet-input type="text" name="a12" class="w-flex uppercase"/>
                                                <x-jet-input-error for='a12' />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="grid grid-col-3 text-center">
                                <div class="col-start-2">
                                    <div class="card-title bg-gray-300 m-2 p-2">
                                        <h3 class="text-center font-bold">TIPOS DE TARIMA Y DIRECCIÓN DE MOVIMIENTO</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text mb-3">&nbsp;</p>
                            <div class="row p-2">
                                <div class="col-xs-12 col-sm-12">
                                    <div class="row">
                                        <div class="col col-xs-12 text-center">
                                            <img src="{{ asset('vendor/img/rack_engineering/A.png')}}" alt=""><br>
                                            <label><input type="radio" name="a13"  value="A" id="a13_1"></label>&nbsp;&nbsp;<br><br>
                                        </div>
                                        <div class="col col-xs-12 text-center">
                                            <img src="{{ asset('vendor/img/rack_engineering/B.png')}}" alt=""><br>
                                            <label><input type="radio" name="a13"  value="B" id="a13_2"></label>&nbsp;&nbsp;<br><br>
                                        </div>
                                        <div class="col col-xs-12 text-center">
                                            <img src="{{ asset('vendor/img/rack_engineering/C.png')}}" alt=""><br>
                                            <label><input type="radio" name="a13"  value="C" id="a13_3"></label>&nbsp;&nbsp;<br><br>
                                        </div>
                                        <div class="col col-xs-12 text-center">
                                            <img src="{{ asset('vendor/img/rack_engineering/D.png')}}" alt=""><br>
                                            <label><input type="radio" name="a13"  value="D" id="a13_4"></label>&nbsp;&nbsp;<br><br>
                                        </div>
                                        <div class="col col-xs-12 text-center">
                                            <img src="{{ asset('vendor/img/rack_engineering/E.png')}}" alt=""><br>
                                            <label><input type="radio" name="a13"  value="E" id="a13_5"></label>&nbsp;&nbsp;<br><br>
                                        </div>
                                        <div class="col col-xs-12 text-center">
                                            <img src="{{ asset('vendor/img/rack_engineering/F.png')}}" alt=""><br>
                                            <label><input type="radio" name="a13"  value="F" id="a13_6"></label>&nbsp;&nbsp;<br><br>
                                        </div>
                                        <div class="col col-xs-12 text-center">
                                            <img src="{{ asset('vendor/img/rack_engineering/G.png')}}" alt=""><br>
                                            <label><input type="radio" name="a13"  value="G" id="a13_7"></label>&nbsp;&nbsp;<br><br>
                                        </div>
                                        <div class="col col-xs-12 text-center">
                                            <img src="{{ asset('vendor/img/rack_engineering/H.png')}}" alt=""><br>
                                            <label><input type="radio" name="a13"  value="H" id="a13_8"></label>&nbsp;&nbsp;<br><br>
                                        </div>
                                        <div class="col col-xs-12 text-center">
                                            <img src="{{ asset('vendor/img/rack_engineering/I.png')}}" alt=""><br>
                                            <label><input type="radio" name="a13"  value="I" id="a13_9"></label>&nbsp;&nbsp;<br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="card-text mb-3">ESTE PRODUCTO USARÁ UNA TARIMA COMO:</p>
                            <div class="row p-2">
                                <div class="col-xs-12 col-sm-3">&nbsp;</div>
                                <div class="col-xs-12 col-sm-9">
                                    <div class="row">
                                        <div class="col-12 gap-1 inline-flex">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <x-jet-label value="HACE CONTACTO AL SUELO COMO LA LETRA:" />
                                                        <x-jet-input type="text" name="a14" class="w-flex uppercase"/>
                                                        <x-jet-input-error for='a14' />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <x-jet-label value="TIENE UN FRENTE DE:" />
                                                        <x-jet-input type="text" name="a15" class="w-flex uppercase"/>
                                                        <x-jet-input-error for='a15' />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <x-jet-label value="TIENE UN FONDO DE:" />
                                                        <x-jet-input type="text" name="a16" class="w-flex uppercase"/>
                                                        <x-jet-input-error for='a16' />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <x-jet-label value="TIENE UN ALTO DE:" />
                                                        <x-jet-input type="text" name="a17" class="w-flex uppercase"/>
                                                        <x-jet-input-error for='a17' />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 gap-1 inline-flex">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <x-jet-label value="TIENE UN PESO DE:" />
                                                        <x-jet-input type="text" name="a18" class="w-flex uppercase"/>
                                                        <x-jet-input-error for='a18' />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <x-jet-label value="UNA DIRECCIÓN COMO LA LETRA:" />
                                                        <x-jet-input type="text" name="a19" class="w-flex uppercase"/>
                                                        <x-jet-input-error for='a19' />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <x-jet-label value="ESTA FABRICADA DE:" />
                                                        <x-jet-input type="text" name="a20" class="w-flex uppercase"/>
                                                        <x-jet-input-error for='a20' />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <x-jet-label value="ANCHO ESPESOR:" />
                                                        <x-jet-input type="text" name="a21" class="w-flex uppercase"/>
                                                        <x-jet-input-error for='a21' />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="card-text mb-3">OTRAS CONSIDERACIONES DEL MOVIMIENTO DEL PRODUCTO:</p>
                            <div class="row p-2">
                                <div class="col-xs-12 col-sm-3">&nbsp;</div>
                                <div class="col-xs-12 col-sm-9">
                                    <div class="row">
                                        <div class="col-12 gap-1 inline-flex">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group gap-4">
                                                        <x-jet-label value="¿SE PUEDE APILAR DOS ESTIBAS?" />
                                                        <div class="col-12 inline-flex text-center">
                                                            <label><input type="radio" name="a22"  value="SÍ" id="a22_1"> SÍ</label>&nbsp;&nbsp;<br><br>
                                                            <label><input type="radio" name="a22" value="NO" id="a22_2"> NO</label>&nbsp;&nbsp;<br><br>
                                                        </div>
                                                        <x-jet-input-error for='a22' />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group gap-4">
                                                        <x-jet-label value="¿SE PUEDE ALTERAR LA ESTIBA?" />
                                                        <div class="col-12 inline-flex text-center">
                                                            <label><input type="radio" name="a23"  value="SÍ" id="a23_1"> SÍ</label>&nbsp;&nbsp;<br><br>
                                                            <label><input type="radio" name="a23" value="NO" id="a23_2"> NO</label>&nbsp;&nbsp;<br><br>
                                                        </div>
                                                        <x-jet-input-error for='a23' />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group gap-4">
                                                        <x-jet-label value="¿ESTA DISTRIBUIDA LA CARGA?" />
                                                        <div class="col-12 inline-flex text-center">
                                                            <label><input type="radio" name="a24"  value="SÍ" id="a24_1"> SÍ</label>&nbsp;&nbsp;<br><br>
                                                            <label><input type="radio" name="a24" value="NO" id="a24_2"> NO</label>&nbsp;&nbsp;<br><br>
                                                        </div>
                                                        <x-jet-input-error for='a24' />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 gap-1 inline-flex">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group gap-4">
                                                        <x-jet-label value="¿ES ESTABLE LA CARGA?" />
                                                        <div class="col-12 inline-flex text-center">
                                                            <label><input type="radio" name="a25"  value="SÍ" id="a25_1"> SÍ</label>&nbsp;&nbsp;<br><br>
                                                            <label><input type="radio" name="a25" value="NO" id="a25_2"> NO</label>&nbsp;&nbsp;<br><br>
                                                        </div>
                                                        <x-jet-input-error for='a25' />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group gap-4">
                                                        <x-jet-label value="¿TIENE EMBALAJE LA CARGA?" />
                                                        <div class="col-12 inline-flex text-center">
                                                            <label><input type="radio" name="a26"  value="SÍ" id="a26_1"> SÍ</label>&nbsp;&nbsp;<br><br>
                                                            <label><input type="radio" name="a26" value="NO" id="a26_2"> NO</label>&nbsp;&nbsp;<br><br>
                                                        </div>
                                                        <x-jet-input-error for='a26' />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group gap-4">
                                                        <x-jet-label value="¿CON QUE FRECUENCIA ES LA ROTACIÓN?" />
                                                        <div class="col-12 inline-flex text-center">
                                                            <label><input type="radio" name="a27"  value="MUCHA" id="a27_1"> MUCHA</label>&nbsp;&nbsp;<br><br>
                                                            <label><input type="radio" name="a27" value="MEDIANA" id="a27_2"> MEDIANA</label>&nbsp;&nbsp;<br><br>
                                                            <label><input type="radio" name="a27" value="POCA" id="a27_3"> POCA</label>&nbsp;&nbsp;<br><br>
                                                        </div>
                                                        <x-jet-input-error for='a27' />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="grid grid-col-3 text-center">
                                <div class="col-start-2">
                                    <div class="card-title bg-gray-300 m-2 p-2">
                                        <h3 class="text-center font-bold">INFORMACION DE LA OPERACIÓN</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text mb-3">&nbsp;</p>
                            <div class="row p-2">
                                <div class="col-xs-12 col-sm-12">
                                    <div class="row">
                                        <div class="col col-xs-12">
                                            <div class="form-group gap-4">
                                                <x-jet-label value="NUMERO DE TARIMAS ALMACENADAS" />
                                                <x-jet-input type="text" name="a28" class="w-flex uppercase"/>
                                                <x-jet-input-error for='a28' />
                                            </div>
                                        </div>
                                        <div class="col col-xs-12">
                                            <div class="form-group gap-4">
                                                <x-jet-label value="NECESIDAD ACTUAL DE TARIMAS" />
                                                <x-jet-input type="text" name="a29" class="w-flex uppercase"/>
                                                <x-jet-input-error for='a29' />
                                            </div>
                                        </div>
                                        <div class="col col-xs-12">
                                            <div class="form-group gap-4">
                                                <x-jet-label value="INCREMENTO PROYECTADO DE TARIMAS" />
                                                <x-jet-input type="text" name="a30" class="w-flex uppercase"/>
                                                <x-jet-input-error for='a30' />
                                            </div>
                                        </div>
                                        <div class="col col-xs-12">
                                            <div class="form-group gap-4">
                                                <x-jet-label value="NUMERO DE ENTRADAS TARIMAS" />
                                                <x-jet-input type="text" name="a31" class="w-flex uppercase"/>
                                                <x-jet-input-error for='a31' />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-xs-12">
                                            <div class="form-group gap-4">
                                                <x-jet-label value="NUMERO DE SALIDAS TARIMAS" />
                                                <x-jet-input type="text" name="a32" class="w-flex uppercase"/>
                                                <x-jet-input-error for='a32' />
                                            </div>
                                        </div>
                                        <div class="col col-xs-12">
                                            <div class="form-group gap-4">
                                                <x-jet-label value="INCREMENTO DE FLUJO ANUAL ESPERADO" />
                                                <x-jet-input type="text" name="a33" class="w-flex uppercase"/>
                                                <x-jet-input-error for='a33' />
                                            </div>
                                        </div>
                                        <div class="col col-xs-12">
                                            <div class="form-group gap-4">
                                                <x-jet-label value="INCREMENTO DE FLUJO ANUAL INUSUAL ESPERADO" />
                                                <x-jet-input type="text" name="a34" class="w-flex uppercase"/>
                                                <x-jet-input-error for='a34' />
                                            </div>
                                        </div>
                                        <div class="col col-xs-12">
                                            <div class="form-group gap-4">
                                                <x-jet-label value="TEMPERATURA AMBIENTE" />
                                                <x-jet-input type="text" name="a35" class="uppercase w-20"/> MÁX. &nbsp;&nbsp;
                                                <x-jet-input-error for='a35' />
                                                <x-jet-input type="text" name="a36" class="uppercase w-20"/> MIN. &nbsp;&nbsp;
                                                <x-jet-input-error for='a36' />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-xs-12">
                                            <div class="form-group gap-4">
                                                <x-jet-label value="CONDICIONES AMBIENTALES" />
                                                <div class="row">
                                                    <div class="col-12 inline-flex">
                                                        <label><input type="checkbox" name="a37" value="ACEITOSO" id="a37_1"> ACEITOSO</label>&nbsp;&nbsp;<br><br>
                                                        <label><input type="checkbox" name="a38" value="POLVOSO" id="a38_2"> POLVOSO</label>&nbsp;&nbsp;<br><br>
                                                        <label><input type="checkbox" name="a39" value="ABRASIVO" id="a39_3"> ABRASIVO</label>&nbsp;&nbsp;<br><br>
                                                        <label><input type="checkbox" name="a40" value="CORROSIVO" id="a40_4"> CORROSIVO</label>&nbsp;&nbsp;<br><br>
                                                        <label><input type="checkbox" name="a41" value="REFRIGERACION" id="a41_5"> REFRIGERACION</label>&nbsp;&nbsp;<br><br>
                                                        <label><input type="checkbox" name="a42" value="SECO" id="a42_6"> SECO</label>&nbsp;&nbsp;<br><br>
                                                        <label><input type="checkbox" name="a43" value="HUMEDO" id="a43_7"> HUMEDO</label>&nbsp;&nbsp;<br><br>
                                                        <label><input type="checkbox" name="a44" value="OTRO" id="a44_8"> OTRO</label>&nbsp;&nbsp;<br><br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="grid grid-col-3 text-center">
                                <div class="col-start-2">
                                    <div class="card-title bg-gray-300 m-2 p-2">
                                        <h3 class="text-center font-bold">CARACTERÍSTICAS DEL MONTACARGAS</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-xs-12 col-sm-6 gap-2 p-3">
                                    <div class="form-group gap-4 p-2">
                                        <x-jet-label value="TIPO:" />
                                        <x-jet-input type="text" name="a45" class="uppercase w-full"/>
                                        <x-jet-input-error for='a45' />
                                    </div>
                                    <div class="form-group gap-4 p-2">
                                        <x-jet-label value="MARCA:" />
                                        <x-jet-input type="text" name="a46" class="uppercase w-full"/>
                                        <x-jet-input-error for='a46' />
                                    </div>
                                    <div class="form-group gap-4 p-2">
                                        <x-jet-label value="MODELO:" />
                                        <x-jet-input type="text" name="a47" class="uppercase w-full"/>
                                        <x-jet-input-error for='a47' />
                                    </div>
                                    <div class="form-group gap-4 p-2">
                                        <x-jet-label value="RADIO DE GIRO:" />
                                        <x-jet-input type="text" name="a48" class="uppercase w-full"/>
                                        <x-jet-input-error for='a48' />
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 gap-2 p-3">
                                    <div class="row">
                                        <div class="col inline-flex">
                                            <div class="form-group gap-4 p-2">
                                                <x-jet-label value="ALTURA DE ESTIBA:" />
                                                <x-jet-input type="text" name="a49" class="uppercase w-full"/>
                                                <x-jet-input-error for='a49' />
                                            </div>
                                            <div class="form-group gap-4 p-2">
                                                <x-jet-label value="CAPACIDAD CARGA:" />
                                                <x-jet-input type="text" name="a50" class="uppercase w-full"/>
                                                <x-jet-input-error for='a50' />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col inline-flex">
                                            <div class="form-group gap-4 p-2">
                                                <x-jet-label value="FRENTE:" />
                                                <x-jet-input type="text" name="a51" class="uppercase w-full"/>
                                                <x-jet-input-error for='a51' />
                                            </div>
                                            <div class="form-group gap-4 p-2">
                                                <x-jet-label value="FONDO:" />
                                                <x-jet-input type="text" name="a52" class="uppercase w-full"/>
                                                <x-jet-input-error for='a52' />
                                            </div>
                                            <div class="form-group gap-4 p-2">
                                                <x-jet-label value="ALTO:" />
                                                <x-jet-input type="text" name="a53" class="uppercase w-full"/>
                                                <x-jet-input-error for='a53' />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col inline-flex">
                                            <div class="form-group gap-4 p-2">
                                                <x-jet-label value="MEDIDA HORQUILLAS:" />
                                                <x-jet-input type="text" name="a54" class="uppercase w-full"/>
                                                <x-jet-input-error for='a54' />
                                            </div>
                                            <div class="form-group gap-4 p-2">
                                                <x-jet-label value="LARGO:" />
                                                <x-jet-input type="text" name="a55" class="uppercase w-full"/>
                                                <x-jet-input-error for='a55' />
                                            </div>
                                            <div class="form-group gap-4 p-2">
                                                <x-jet-label value="ENTRE:" />
                                                <x-jet-input type="text" name="a56" class="uppercase w-full"/>
                                                <x-jet-input-error for='a56' />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="grid grid-col-3 text-center">
                                <div class="col-start-2">
                                    <div class="card-title bg-gray-300 m-2 p-2">
                                        <h3 class="text-center font-bold">CARACTERÍSTICAS DE LA BODEGA</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group gap-4 ">
                                <x-jet-label value="TIPO DE CONSTRUCCION:" />
                                <div class="row">
                                    <div class="col inline-flex">
                                        <label><input type="radio" name="a57" value="NUEVA" id="a57_1"> NUEVA</label>&nbsp;&nbsp;<br><br>
                                        <label><input type="radio" name="a57" value="EXISTENTE" id="a57_2"> EXISTENTE</label>&nbsp;&nbsp;<br><br>
                                        <label><input type="radio" name="a57" value="PROYECTADA" id="a57_3"> PROYECTADA</label>&nbsp;&nbsp;<br><br>
                                    </div>
                                </div>
                                <x-jet-input-error for='a57' />
                            </div>
                            <div class="form-group gap-4 ">
                                <x-jet-label value="TIPO DE PARED:" />
                                <div class="row">
                                    <div class="col inline-flex">
                                        <label><input type="radio" name="a58"  value="BLOCK" id="a58_1"> BLOCK</label>&nbsp;&nbsp;<br><br>
                                        <label><input type="radio" name="a58"  value="LADRILLO" id="a58_2"> LADRILLO</label>&nbsp;&nbsp;<br><br>
                                        <label><input type="radio" name="a58"  value="OTRO" id="a58_3"> OTRO</label>&nbsp;&nbsp;<br><br>
                                        <x-jet-input type="text" name="a59" class="uppercase w-flex"/>
                                    </div>
                                </div>
                                <x-jet-input-error for='a58' />
                            </div>
                            <div class="form-group gap-4 ">
                                <x-jet-label value="TIPO DE TECHO:" />
                                <div class="row">
                                    <div class="col inline-flex">
                                        <label><input type="radio" name="a60"  value="LÁMINA" id="a60_1"> LÁMINA</label>&nbsp;&nbsp;<br><br>
                                        <label><input type="radio" name="a60"  value="LOSA" id="a60_2"> LOSA</label>&nbsp;&nbsp;<br><br>
                                        <label><input type="radio" name="a60"  value="OTRO" id="a60_3"> OTRO</label>&nbsp;&nbsp;<br><br>
                                        <x-jet-input type="text" name="a61" class="uppercase w-flex"/>
                                    </div>
                                </div>
                                <x-jet-input-error for='a60' />
                            </div>
                            <div class="form-group gap-4 ">
                                <x-jet-label value="TIPO DE PISO:" />
                                <div class="row">
                                    <div class="col inline-flex">
                                        <label><input type="radio" name="a62"  value="TIERRA" id="a62_1"> TIERRA</label>&nbsp;&nbsp;<br><br>
                                        <label><input type="radio" name="a62"  value="PULIDO" id="a62_2"> PULIDO</label>&nbsp;&nbsp;<br><br>
                                        <label><input type="radio" name="a62"  value="OTRO" id="a62_3"> OTRO</label>&nbsp;&nbsp;<br><br>
                                        <x-jet-input type="text" name="a63" class="uppercase w-flex"/>
                                    </div>
                                </div>
                                <x-jet-input-error for='a62' />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-xs-12 col-sm-6 m-1 gap-2">
                        <button type="submit" class="btn btn-green mb-2">
                            <i class="fa-solid fa-circle-arrow-right"></i>&nbsp; &nbsp; Continuar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop