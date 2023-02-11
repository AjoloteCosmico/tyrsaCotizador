<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Models\SelectiveFloor;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    public function show($id)
    {
        $Quotation_Id = $id;
        $Floor = Floor::all();

        return view('quotes.selectivo.floors.index', compact(
            'Floor', 
            'Quotation_Id'
        ));
    }

    public function calc(Request $request)
    {
        $rules = [
            'amount' => 'required',
            'length' => 'required',
            'camber' => 'required',
        ];
        $messages = [
            'amount.required' => 'La cantidad de piezas es requerida',
            'length.required' => 'Seleccione el Largo',
            'camber.required' => 'Seleccione el Peralte',
        ];
        $request->validate($rules,$messages);
        $request;
        $Quotation_Id = $request->Quotation_Id;
        $Amount = $request->amount;
        $Piece = Floor::where('length', $request->length)->where('camber', $request->camber)->first();
        if($Piece){
            $SubTotal = $Amount * $Piece->price;

            $SF = SelectiveFloor::where('quotation_id', $Quotation_Id)->first();
            if($SF){
                $SF->amount = $Amount;
                $SF->length = $Piece->length;
                $SF->weight = $Piece->weight;
                $SF->m2 = $Piece->m2;
                $SF->camber = $Piece->camber;
                $SF->sku = $Piece->sku;
                $SF->unit_price = $Piece->price;
                $SF->total_price = $SubTotal;
                $SF->save();
            }else{
                $SF = new SelectiveFloor();
                $SF->quotation_id = $Quotation_Id;
                $SF->amount = $Amount;
                $SF->length = $Piece->length;
                $SF->weight = $Piece->weight;
                $SF->m2 = $Piece->m2;
                $SF->camber = $Piece->camber;
                $SF->sku = $Piece->sku;
                $SF->unit_price = $Piece->price;
                $SF->total_price = $SubTotal;
                $SF->save();
            }

            return view('quotes.selectivo.floors.calc', compact(
                'Amount',
                'Piece',
                'SubTotal',
                'Quotation_Id'
            ));
        }else{
            return redirect()->route('floors.show',$Quotation_Id)->with('no_existe', 'ok');
        }
    }
}
