<?php

namespace App\Http\Controllers;

use App\Models\Joist;
use App\Models\SelectiveJoistL2;
use App\Models\SelectiveJoistL2Caliber14;
use App\Models\TypeL2Joist;
use App\Models\TypeL2JoistCaliber;
use App\Models\TypeL2JoistCamber;
use App\Models\TypeL2JoistCrossbarLength;
use App\Models\TypeL2JoistLength;
use App\Models\TypeL2JoistLoadingCapacity;
use Illuminate\Http\Request;

class TypeL2JoistController extends Controller
{
    public function caliber14_show($id)
    {
        $Quotation_Id = $id;
        $Joists = Joist::where('joist', 'Tipo L 2.0')->first();
        $Calibers = TypeL2JoistCaliber::where('caliber', '14')->get();
        $Lengths = TypeL2JoistLength::all();
        $Cambers = TypeL2JoistCamber::all();
        $CrossbarLengths = TypeL2JoistCrossbarLength::all();
        $LoadingCapacities = TypeL2JoistLoadingCapacity::all();
        $TypeLJoists = TypeL2Joist::where('caliber', '14')->get();


        return view('quotes.selectivo.joists.typel2joists.caliber14.index', compact(
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
        $Cambers = TypeL2JoistLoadingCapacity::where('crossbar_length', '>=', $Length)->where('loading_capacity', '>=', $WeightIncrement)->first();
        if($Cambers){
            $TypeLJoists = TypeL2Joist::where('caliber','14')->where('camber', $Cambers->camber)->where('length', $Length)->first();
            $Import = $request->amount * $TypeLJoists->price;

            $SJL2 = SelectiveJoistL2Caliber14::where('quotation_id', $Quotation_Id)->first();
            if($SJL2){
                $SJL2->amount = $Amount;
                $SJL2->caliber = $Caliber;
                $SJL2->loading_capacity = $Weight;
                $SJL2->type_joist = $JoistType;
                $SJL2->length_meters = $Length;
                $SJL2->camber = $TypeLJoists->camber;
                $SJL2->weight_kg = $TypeLJoists->weight;
                $SJL2->m2 = $TypeLJoists->m2;
                $SJL2->length = $TypeLJoists->length;
                $SJL2->sku = $TypeLJoists->sku;
                $SJL2->unit_price = $TypeLJoists->price;
                $SJL2->total_price = $Import;
                $SJL2->save();
            }else{
                $SJL2 = new SelectiveJoistL2Caliber14();
                $SJL2->quotation_id = $Quotation_Id;
                $SJL2->amount = $Amount;
                $SJL2->caliber = $Caliber;
                $SJL2->loading_capacity = $Weight;
                $SJL2->type_joist = $JoistType;
                $SJL2->length_meters = $Length;
                $SJL2->camber = $TypeLJoists->camber;
                $SJL2->weight_kg = $TypeLJoists->weight;
                $SJL2->m2 = $TypeLJoists->m2;
                $SJL2->length = $TypeLJoists->length;
                $SJL2->sku = $TypeLJoists->sku;
                $SJL2->unit_price = $TypeLJoists->price;
                $SJL2->total_price = $Import;
                $SJL2->save();
            }

            return view('quotes.selectivo.joists.typel2joists.caliber14.store', compact(
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
        
        $TypeLJoists = TypeL2Joist::where('caliber',$Caliber)->where('camber', $Camber)->where('length', $Length)->first();
        $Import = $Amount * $TypeLJoists->price;

        $SJL2 = SelectiveJoistL2::where('quotation_id', $Quotation_Id)->first();
        if($SJL2){
            $SJL2->amount = $Amount;
            $SJL2->caliber = $Caliber;
            $SJL2->skate = $Skate;
            $SJL2->loading_capacity = $Weight;
            $SJL2->type_joist = $JoistType;
            $SJL2->length_meters = $Length;
            $SJL2->camber = $TypeLJoists->camber;
            $SJL2->weight_kg = $TypeLJoists->weight;
            $SJL2->m2 = $TypeLJoists->m2;
            $SJL2->length = $TypeLJoists->length;
            $SJL2->sku = $TypeLJoists->sku;
            $SJL2->unit_price = $TypeLJoists->price;
            $SJL2->total_price = $Import;
            $SJL2->save();
        }else{
            $SJL2 = new SelectiveJoistL2();
            $SJL2->quotation_id = $Quotation_Id;
            $SJL2->amount = $Amount;
            $SJL2->caliber = $Caliber;
            $SJL2->skate = $Skate;
            $SJL2->loading_capacity = $Weight;
            $SJL2->type_joist = $JoistType;
            $SJL2->length_meters = $Length;
            $SJL2->camber = $TypeLJoists->camber;
            $SJL2->weight_kg = $TypeLJoists->weight;
            $SJL2->m2 = $TypeLJoists->m2;
            $SJL2->length = $TypeLJoists->length;
            $SJL2->sku = $TypeLJoists->sku;
            $SJL2->unit_price = $TypeLJoists->price;
            $SJL2->total_price = $Import;
            $SJL2->save();
        }
        
        return view('quotes.selectivo.joists.typel2joists.store', compact(
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

    public function drive_show($id)
    {
        $Quotation_Id = $id;
        $Joists = Joist::where('joist', 'Tipo L 2.0')->first();
        $Calibers = TypeL2JoistCaliber::where('caliber', '<>', '14')->get();
        $Lengths = TypeL2JoistLength::all();
        $Cambers = TypeL2JoistCamber::all();
        $CrossbarLengths = TypeL2JoistCrossbarLength::all();
        $LoadingCapacities = TypeL2JoistLoadingCapacity::all();
        $TypeLJoists = TypeL2Joist::all();

        return view('quotes.drivein.joists.typel2joists.index', compact(
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
    public function drive_store(Request $request)
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
        
        $TypeLJoists = TypeL2Joist::where('caliber',$Caliber)->where('camber', $Camber)->where('length', $Length)->first();
        $Import = $Amount * $TypeLJoists->price;

        $SJL2 = SelectiveJoistL2::where('quotation_id', $Quotation_Id)->first();
        if($SJL2){
            $SJL2->amount = $Amount;
            $SJL2->caliber = $Caliber;
            $SJL2->skate = $Skate;
            $SJL2->loading_capacity = $Weight;
            $SJL2->type_joist = $JoistType;
            $SJL2->length_meters = $Length;
            $SJL2->camber = $TypeLJoists->camber;
            $SJL2->weight_kg = $TypeLJoists->weight;
            $SJL2->m2 = $TypeLJoists->m2;
            $SJL2->length = $TypeLJoists->length;
            $SJL2->sku = $TypeLJoists->sku;
            $SJL2->unit_price = $TypeLJoists->price;
            $SJL2->total_price = $Import;
            $SJL2->save();
        }else{
            $SJL2 = new SelectiveJoistL2();
            $SJL2->quotation_id = $Quotation_Id;
            $SJL2->amount = $Amount;
            $SJL2->caliber = $Caliber;
            $SJL2->skate = $Skate;
            $SJL2->loading_capacity = $Weight;
            $SJL2->type_joist = $JoistType;
            $SJL2->length_meters = $Length;
            $SJL2->camber = $TypeLJoists->camber;
            $SJL2->weight_kg = $TypeLJoists->weight;
            $SJL2->m2 = $TypeLJoists->m2;
            $SJL2->length = $TypeLJoists->length;
            $SJL2->sku = $TypeLJoists->sku;
            $SJL2->unit_price = $TypeLJoists->price;
            $SJL2->total_price = $Import;
            $SJL2->save();
        }
        
        return view('quotes.drivein.joists.typel2joists.store', compact(
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
        $Joists = Joist::where('joist', 'Tipo L 2.0')->first();
        $Calibers = TypeL2JoistCaliber::where('caliber', '<>', '14')->get();
        $Lengths = TypeL2JoistLength::all();
        $Cambers = TypeL2JoistCamber::all();
        $CrossbarLengths = TypeL2JoistCrossbarLength::all();
        $LoadingCapacities = TypeL2JoistLoadingCapacity::all();
        $TypeLJoists = TypeL2Joist::all();

        return view('quotes.selectivo.joists.typel2joists.index', compact(
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
