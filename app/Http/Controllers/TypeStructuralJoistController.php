<?php

namespace App\Http\Controllers;

use App\Models\Joist;
use App\Models\SelectiveJoistStructural;
use App\Models\TypeStructuralJoist;
use App\Models\TypeStructuralJoistCaliber;
use App\Models\TypeStructuralJoistCamber;
use App\Models\TypeStructuralJoistCrossbarLength;
use App\Models\TypeStructuralJoistLength;
use App\Models\TypeStructuralJoistLoadingCapacity;
use Illuminate\Http\Request;

class TypeStructuralJoistController extends Controller
{
    public function caliber14_show($id)
    {
        $Quotation_Id = $id;
        $Joists = Joist::where('joist', 'Tipo Estructural')->first();
        $Calibers = TypeStructuralJoistCaliber::where('caliber', '14')->get();
        $Lengths = TypeStructuralJoistLength::all();
        $Cambers = TypeStructuralJoistCamber::all();
        $CrossbarLengths = TypeStructuralJoistCrossbarLength::all();
        $LoadingCapacities = TypeStructuralJoistLoadingCapacity::all();
        $TypeLJoists = TypeStructuralJoist::where('caliber', '14')->get();

        return view('quotes.selectivo.joists.typestructuraljoists.caliber14.index', compact(
            'Joists',
            'Calibers',
            'Lengths',
            'Cambers',
            'CrossbarLengths',
            'LoadingCapacities',
            'TypeLJoists',
            'Quotation_Id'
        ));
    }

    public function caliber14_calc(Request $request)
    {
        $rules = [
            'amount' => 'required',
            'weight' => 'required',
            'joist_type' => 'required',
            'caliber' => 'required',
        ];
        $messages = [
            'amount.required' => 'Capture una cantidad válida',
            'weight.required' => 'Capture la carga requerida',
            'joist_type.required' => 'Elija el tipo de Viga',
            'caliber.required' => 'Elija el Calibre de la Viga',
        ];
        $request->validate($rules, $messages);

        $Quotation_Id = $request->Quotation_Id;
        $Amount = $request->amount;
        $Weight = $request->weight;
        $JoistType = $request->joist_type;
        $Length = $request->length;
        $Caliber = $request->caliber;
        $Increment = $Weight * 0.07;
        $WeightIncrement = $Weight + $Increment;
        $Cambers = TypeStructuralJoistLoadingCapacity::where('crossbar_length', '>=', $Length)->where('loading_capacity', '>=', $WeightIncrement)->first();
        if($Cambers){
            $TypeLJoists = TypeStructuralJoist::where('caliber','14')->where('camber', $Cambers->camber)->where('length', $Length)->first();
            $Import = $request->amount * $TypeLJoists->price;

            $SJS = SelectiveJoistStructural::where('quotation_id', $Quotation_Id)->first();
            if($SJS){
                $SJS->amount = $Amount;
                $SJS->caliber = $Caliber;
                $SJS->loading_capacity = $Weight;
                $SJS->type_joist = $JoistType;
                $SJS->length_meters = $Length;
                $SJS->camber = $TypeLJoists->camber;
                $SJS->weight_kg = $TypeLJoists->weight;
                $SJS->m2 = $TypeLJoists->m2;
                $SJS->length = $TypeLJoists->length;
                $SJS->sku = $TypeLJoists->sku;
                $SJS->unit_price = $TypeLJoists->price;
                $SJS->total_price = $Import;
                $SJS->save();
            }else{
                $SJS = new SelectiveJoistStructural();
                $SJS->quotation_id = $Quotation_Id;
                $SJS->amount = $Amount;
                $SJS->caliber = $Caliber;
                $SJS->loading_capacity = $Weight;
                $SJS->type_joist = $JoistType;
                $SJS->length_meters = $Length;
                $SJS->camber = $TypeLJoists->camber;
                $SJS->weight_kg = $TypeLJoists->weight;
                $SJS->m2 = $TypeLJoists->m2;
                $SJS->length = $TypeLJoists->length;
                $SJS->sku = $TypeLJoists->sku;
                $SJS->unit_price = $TypeLJoists->price;
                $SJS->total_price = $Import;
                $SJS->save();
            }

            return view('quotes.selectivo.joists.typestructuraljoists.caliber14.store', compact(
                'Amount',
                'Weight',
                'JoistType',
                'Length',
                'Caliber',
                'WeightIncrement',
                'Cambers',
                'TypeLJoists',
                'Import',
                'Quotation_Id'
            ));
        }else{
            return redirect()->route('menujoists.show', $Quotation_Id)->with('no_existe', 'ok');
        }

        
    }

    public function store(Request $request)
    {
        $rules = [
            'amount' => 'required',
            'caliber' => 'required',
            'length' => 'required',
            'camber' => 'required',
            'skate' => 'required',
            'weight' => 'required',
            'joist_type' => 'required',
        ];
        $messages = [
            'amount.required' => 'Capture una cantidad válida',
            'caliber.required' => 'Seleccione el Calibre de la Viga',
            'lenght.required' => 'Seleccione el Largo',
            'camber.required' => 'Seleccione el Peralte',
            'skate.required' => 'Capture el Patín',
            'weight.required' => 'Capture la Capacidad de carga',            
            'joist_type.required' => 'Seleccione el tipo de Viga',
        ];
        $request->validate($rules, $messages);

        $Quotation_Id = $request->Quotation_Id;
        $Amount = $request->amount;
        $Caliber = $request->caliber;
        $Length = $request->length;
        $Camber = $request->camber;
        $Skate = $request->skate;
        $Weight = $request->weight;
        $JoistType = $request->joist_type;
        $Increment = $Weight * 0.07;
        $WeightIncrement = $Weight + $Increment;
        
        $TypeLJoists = TypeStructuralJoist::where('caliber',$Caliber)->where('camber', $Camber)->where('length', $Length)->first();
        if($TypeLJoists){
            $Import = $Amount * $TypeLJoists->price;

            $SJS = SelectiveJoistStructural::where('quotation_id', $Quotation_Id)->first();
            if($SJS){
                $SJS->amount = $Amount;
                $SJS->caliber = $Caliber;
                $SJS->skate = $Skate;
                $SJS->loading_capacity = $Weight;
                $SJS->type_joist = $JoistType;
                $SJS->length_meters = $Length;
                $SJS->camber = $TypeLJoists->camber;
                $SJS->weight_kg = $TypeLJoists->weight;
                $SJS->m2 = $TypeLJoists->m2;
                $SJS->length = $TypeLJoists->length;
                $SJS->sku = $TypeLJoists->sku;
                $SJS->unit_price = $TypeLJoists->price;
                $SJS->total_price = $Import;
                $SJS->save();
            }else{
                $SJS = new SelectiveJoistStructural();
                $SJS->quotation_id = $Quotation_Id;
                $SJS->amount = $Amount;
                $SJS->caliber = $Caliber;
                $SJS->skate = $Skate;
                $SJS->loading_capacity = $Weight;
                $SJS->type_joist = $JoistType;
                $SJS->length_meters = $Length;
                $SJS->camber = $TypeLJoists->camber;
                $SJS->weight_kg = $TypeLJoists->weight;
                $SJS->m2 = $TypeLJoists->m2;
                $SJS->length = $TypeLJoists->length;
                $SJS->sku = $TypeLJoists->sku;
                $SJS->unit_price = $TypeLJoists->price;
                $SJS->total_price = $Import;
                $SJS->save();
            }

            return view('quotes.selectivo.joists.typestructuraljoists.store', compact(
                'Amount',
                'Caliber',
                'Length',
                'Camber',
                'Skate',
                'Weight',
                'JoistType',
                'Increment',
                'WeightIncrement',
                'TypeLJoists',
                'Import',
                'Quotation_Id'
            ));
        }else{
            return redirect()->route('menujoists.show', $Quotation_Id)->with('no_existe', 'ok');
        }
    }

    public function show($id)
    {
        $Quotation_Id = $id;
        $Joists = Joist::where('joist', 'Tipo Estructural')->first();
        $Calibers = TypeStructuralJoistCaliber::where('caliber', '<>', '14')->get();
        $Lengths = TypeStructuralJoistLength::all();
        $Cambers = TypeStructuralJoistCamber::all();
        $CrossbarLengths = TypeStructuralJoistCrossbarLength::all();
        $LoadingCapacities = TypeStructuralJoistLoadingCapacity::all();
        $TypeLJoists = TypeStructuralJoist::all();


        return view('quotes.selectivo.joists.typestructuraljoists.index', compact(
            'Joists',
            'Calibers',
            'Lengths',
            'Cambers',
            'CrossbarLengths',
            'LoadingCapacities',
            'TypeLJoists',
            'Quotation_Id'
        ));
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
