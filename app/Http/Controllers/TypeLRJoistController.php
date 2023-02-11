<?php

namespace App\Http\Controllers;

use App\Models\Joist;
use App\Models\SelectiveJoistLr;
use App\Models\TypeLRJoist;
use App\Models\TypeLRJoistCaliber;
use App\Models\TypeLRJoistCamber;
use App\Models\TypeLRJoistCrossbarLength;
use App\Models\TypeLRJoistLength;
use App\Models\TypeLRJoistLoadingCapacity;
use Illuminate\Http\Request;

class TypeLRJoistController extends Controller
{
    public function caliber14_show($id)
    {
        $Quotation_Id = $id;
        $Joists = Joist::where('joist', 'Tipo LR')->first();
        $Calibers = TypeLRJoistCaliber::where('caliber', '14')->get();
        $Lengths = TypeLRJoistLength::all();
        $Cambers = TypeLRJoistCamber::all();
        $CrossbarLengths = TypeLRJoistCrossbarLength::all();
        $LoadingCapacities = TypeLRJoistLoadingCapacity::all();
        $TypeLJoists = TypeLRJoist::where('caliber', '14')->get();

        return view('quotes.selectivo.joists.typelrjoists.caliber14.index', compact(
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
        $Cambers = TypeLRJoistLoadingCapacity::where('crossbar_length', '>=', $Length)->where('loading_capacity', '>=', $WeightIncrement)->first();
        if($Cambers){
            $TypeLJoists = TypeLRJoist::where('caliber','14')->where('camber', $Cambers->camber)->where('length', $Length)->first();
            $Import = $request->amount * $TypeLJoists->price;

            $SJLR = SelectiveJoistLr::where('quotation_id', $Quotation_Id)->first();
            if($SJLR){
                $SJLR->amount = $Amount;
                $SJLR->caliber = $Caliber;
                $SJLR->loading_capacity = $Weight;
                $SJLR->type_joist = $JoistType;
                $SJLR->length_meters = $Length;
                $SJLR->camber = $TypeLJoists->camber;
                $SJLR->weight_kg = $TypeLJoists->weight;
                $SJLR->m2 = $TypeLJoists->m2;
                $SJLR->length = $TypeLJoists->length;
                $SJLR->sku = $TypeLJoists->sku;
                $SJLR->unit_price = $TypeLJoists->price;
                $SJLR->total_price = $Import;
                $SJLR->save();
            }else{
                $SJLR = new SelectiveJoistLr();
                $SJLR->quotation_id = $Quotation_Id;
                $SJLR->amount = $Amount;
                $SJLR->caliber = $Caliber;
                $SJLR->loading_capacity = $Weight;
                $SJLR->type_joist = $JoistType;
                $SJLR->length_meters = $Length;
                $SJLR->camber = $TypeLJoists->camber;
                $SJLR->weight_kg = $TypeLJoists->weight;
                $SJLR->m2 = $TypeLJoists->m2;
                $SJLR->length = $TypeLJoists->length;
                $SJLR->sku = $TypeLJoists->sku;
                $SJLR->unit_price = $TypeLJoists->price;
                $SJLR->total_price = $Import;
                $SJLR->save();
            }

            return view('quotes.selectivo.joists.typelrjoists.caliber14.store', compact(
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
            return redirect()->route('menujoists.show')->with('no_existe', 'ok');
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
        
        $TypeLJoists = TypeLRJoist::where('caliber',$Caliber)->where('camber', $Camber)->where('length', $Length)->first();
        $Import = $Amount * $TypeLJoists->price;

        $SJLR = SelectiveJoistLr::where('quotation_id', $Quotation_Id)->first();
        if($SJLR){
            $SJLR->amount = $Amount;
            $SJLR->caliber = $Caliber;
            $SJLR->skate = $Skate;
            $SJLR->loading_capacity = $Weight;
            $SJLR->type_joist = $JoistType;
            $SJLR->length_meters = $Length;
            $SJLR->camber = $TypeLJoists->camber;
            $SJLR->weight_kg = $TypeLJoists->weight;
            $SJLR->m2 = $TypeLJoists->m2;
            $SJLR->length = $TypeLJoists->length;
            $SJLR->sku = $TypeLJoists->sku;
            $SJLR->unit_price = $TypeLJoists->price;
            $SJLR->total_price = $Import;
            $SJLR->save();
        }else{
            $SJLR = new SelectiveJoistLr();
            $SJLR->quotation_id = $Quotation_Id;
            $SJLR->amount = $Amount;
            $SJLR->caliber = $Caliber;
            $SJLR->skate = $Skate;
            $SJLR->loading_capacity = $Weight;
            $SJLR->type_joist = $JoistType;
            $SJLR->length_meters = $Length;
            $SJLR->camber = $TypeLJoists->camber;
            $SJLR->weight_kg = $TypeLJoists->weight;
            $SJLR->m2 = $TypeLJoists->m2;
            $SJLR->length = $TypeLJoists->length;
            $SJLR->sku = $TypeLJoists->sku;
            $SJLR->unit_price = $TypeLJoists->price;
            $SJLR->total_price = $Import;
            $SJLR->save();
        }

        return view('quotes.selectivo.joists.typelrjoists.store', compact(
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
    }

    public function show($id)
    {
        $Quotation_Id = $id;
        $Joists = Joist::where('joist', 'Tipo LR')->first();
        $Calibers = TypeLRJoistCaliber::where('caliber', '<>', '14')->get();
        $Lengths = TypeLRJoistLength::all();
        $Cambers = TypeLRJoistCamber::all();
        $CrossbarLengths = TypeLRJoistCrossbarLength::all();
        $LoadingCapacities = TypeLRJoistLoadingCapacity::all();
        $TypeLJoists = TypeLRJoist::all();

        return view('quotes.selectivo.joists.typelrjoists.index', compact(
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
