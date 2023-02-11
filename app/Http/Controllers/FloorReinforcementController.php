<?php

namespace App\Http\Controllers;

use App\Models\FloorReinforcement;
use App\Models\SelectiveFloorReinforcement;
use Illuminate\Http\Request;

class FloorReinforcementController extends Controller
{
    public function show($id)
    {
        $Quotation_Id = $id;
        $FloorReinforcements = FloorReinforcement::all();

        return view('quotes.selectivo.floor_reinforcements.index', compact(
            'FloorReinforcements', 
            'Quotation_Id'
        ));
    }

    public function calc(Request $request)
    {
        $rules = [
            'amount' => 'required',
        ];
        $messages = [
            'amount.required' => 'La cantidad de piezas es requerida',
        ];
        $request->validate($rules,$messages);
        $Quotation_Id = $request->Quotation_Id;
        $Amount = $request->amount;
        $Piece = FloorReinforcement::find($request->piece);
        $SubTotal = $Amount * $Piece->price;

        $SFR = SelectiveFloorReinforcement::where('quotation_id', $Quotation_Id)->first();
        if($SFR){
            $SFR->amount = $Amount;
            $SFR->height = $Piece->length;
            $SFR->weight = $Piece->weight;
            $SFR->m2 = $Piece->m2;
            $SFR->sku = $Piece->sku;
            $SFR->unit_price = $Piece->price;
            $SFR->total_price = $SubTotal;
            $SFR->save();
        }else{
            $SFR = new SelectiveFloorReinforcement();
            $SFR->quotation_id = $Quotation_Id;
            $SFR->amount = $Amount;
            $SFR->height = $Piece->length;
            $SFR->weight = $Piece->weight;
            $SFR->m2 = $Piece->m2;
            $SFR->sku = $Piece->sku;
            $SFR->unit_price = $Piece->price;
            $SFR->total_price = $SubTotal;
            $SFR->save();
        }

        return view('quotes.selectivo.floor_reinforcements.calc', compact(
            'Amount',
            'Piece',
            'SubTotal',
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

    public function store(Request $request)
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
