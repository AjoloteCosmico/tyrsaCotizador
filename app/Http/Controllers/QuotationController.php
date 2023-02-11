<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Customer;
use App\Models\DoubleDeepCrossbar;
use App\Models\DoubleDeepFloor;
use App\Models\DoubleDeepFloorReinforcement;
use App\Models\DoubleDeepHeavyLoadFrame;
use App\Models\DoubleDeepJoistBox2;
use App\Models\DoubleDeepJoistBox25;
use App\Models\DoubleDeepJoistBox25Caliber14;
use App\Models\DoubleDeepJoistBox2Caliber14;
use App\Models\DoubleDeepJoistC2;
use App\Models\DoubleDeepJoistChair;
use App\Models\DoubleDeepJoistL2;
use App\Models\DoubleDeepJoistL25;
use App\Models\DoubleDeepJoistL25Caliber14;
use App\Models\DoubleDeepJoistL2Caliber14;
use App\Models\DoubleDeepJoistLrs;
use App\Models\DoubleDeepJoistStructural;
use App\Models\DoubleDeepMiniatureFrame;
use App\Models\DoubleDeepSpacer;
use App\Models\DoubleDeepStructuralFrame;
use App\Models\Questionary;
use App\Models\QuestionaryChart;
use App\Models\QuestionaryImage;
use App\Models\QuestionaryLayout;
use App\Models\Quotation;
use App\Models\SelectiveCrossbar;
use App\Models\SelectiveFloor;
use App\Models\SelectiveFloorReinforcement;
use App\Models\SelectiveHeavyLoadFrame;
use App\Models\SelectiveJoistBox2;
use App\Models\SelectiveJoistBox25;
use App\Models\SelectiveJoistBox25Caliber14;
use App\Models\SelectiveJoistBox2Caliber14;
use App\Models\SelectiveJoistC2;
use App\Models\SelectiveJoistChair;
use App\Models\SelectiveJoistL2;
use App\Models\SelectiveJoistL25;
use App\Models\SelectiveJoistL25Caliber14;
use App\Models\SelectiveJoistL2Caliber14;
use App\Models\SelectiveJoistLr;
use App\Models\SelectiveJoistStructural;
use App\Models\SelectiveMiniatureFrame;
use App\Models\SelectiveSpacer;
use App\Models\SelectiveStructuralFrame;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function index()
    {
        $Quotations = Quotation::all();
        
        return view('quotes.quotations', compact('Quotations'));
    }

    public function show($id)
    {
        $User = auth()->user();
        $Quotations = Quotation::find($id);
        $Customers = Customer::where('id', $Quotations->customer_id)->first();
        $Contacts = Contact::where('customer_id', $Customers->id)->first();
        $Questionaries = Questionary::where('quotation_id', $id)->first();
        $QuestionaryCharts = QuestionaryChart::where('quotation_id', $id)->first();
        $QuestionaryImages = QuestionaryImage::where('quotation_id', $id)->first();
        $QuestionaryLayouts = QuestionaryLayout::where('quotation_id', $id)->first();
        $SelectiveCrossbars = SelectiveCrossbar::where('quotation_id', $id)->first();
        $SelectiveFloorReinforcements = SelectiveFloorReinforcement::where('quotation_id', $id)->first();
        $SelectiveFloors = SelectiveFloor::where('quotation_id', $id)->first();
        $SelectiveHeavyLoadFrames = SelectiveHeavyLoadFrame::where('quotation_id', $id)->first();
        $SelectiveJoistBox2Caliber14S = SelectiveJoistBox2Caliber14::where('quotation_id', $id)->first();
        $SelectiveJoistBox2S = SelectiveJoistBox2::where('quotation_id', $id)->first();
        $SelectiveJoistBox25Caliber14S = SelectiveJoistBox25Caliber14::where('quotation_id', $id)->first();
        $SelectiveJoistBox25S = SelectiveJoistBox25::where('quotation_id', $id)->first();
        $SelectiveJoistC2S = SelectiveJoistC2::where('quotation_id', $id)->first();
        $SelectiveJoistChairs = SelectiveJoistChair::where('quotation_id', $id)->first();
        $SelectiveJoistL2Caliber14S = SelectiveJoistL2Caliber14::where('quotation_id', $id)->first();
        $SelectiveJoistL2S = SelectiveJoistL2::where('quotation_id', $id)->first();
        $SelectiveJoistL25Caliber14S = SelectiveJoistL25Caliber14::where('quotation_id', $id)->first();
        $SelectiveJoistL25S = SelectiveJoistL25::where('quotation_id', $id)->first();
        $SelectiveJoistLrs = SelectiveJoistLr::where('quotation_id', $id)->first();
        $SelectiveJoistStructurals = SelectiveJoistStructural::where('quotation_id', $id)->first();
        $SelectiveMiniatureFrames = SelectiveMiniatureFrame::where('quotation_id', $id)->first();
        $SelectiveSpacers = SelectiveSpacer::where('quotation_id', $id)->first();
        $SelectiveStructuralFrames = SelectiveStructuralFrame::where('quotation_id', $id)->first();
        $Fecha = date('d-m-Y');

        if(is_null($SelectiveCrossbars)){$SelectiveCrossbarsTotalPrice = 0;}else{$SelectiveCrossbarsTotalPrice = $SelectiveCrossbars->total_price;}
        if(is_null($SelectiveFloorReinforcements)){$SelectiveFloorReinforcementsTotalPrice = 0;}else{$SelectiveFloorReinforcementsTotalPrice = $SelectiveFloorReinforcements->total_price;}
        if(is_null($SelectiveFloors)){$SelectiveFloorsTotalPrice = 0;}else{$SelectiveFloorsTotalPrice = $SelectiveFloors->total_price;}
        if(is_null($SelectiveHeavyLoadFrames)){$SelectiveHeavyLoadFramesTotalPrice = 0;}else{$SelectiveHeavyLoadFramesTotalPrice = $SelectiveHeavyLoadFrames->total_price;}
        if(is_null($SelectiveJoistBox2Caliber14S)){$SelectiveJoistBox2Caliber14STotalPrice = 0;}else{$SelectiveJoistBox2Caliber14STotalPrice = $SelectiveJoistBox2Caliber14S->total_price;}
        if(is_null($SelectiveJoistBox2S)){$SelectiveJoistBox2STotalPrice = 0;}else{$SelectiveJoistBox2STotalPrice = $SelectiveJoistBox2S->total_price;}
        if(is_null($SelectiveJoistBox25Caliber14S)){$SelectiveJoistBox25Caliber14STotalPrice = 0;}else{$SelectiveJoistBox25Caliber14STotalPrice = $SelectiveJoistBox25Caliber14S->total_price;}
        if(is_null($SelectiveJoistBox25S)){$SelectiveJoistBox25STotalPrice = 0;}else{$SelectiveJoistBox25STotalPrice = $SelectiveJoistBox25S->total_price;}
        if(is_null($SelectiveJoistC2S)){$SelectiveJoistC2STotalPrice = 0;}else{$SelectiveJoistC2STotalPrice = $SelectiveJoistC2S->total_price;}
        if(is_null($SelectiveJoistChairs)){$SelectiveJoistChairsTotalPrice = 0;}else{$SelectiveJoistChairsTotalPrice = $SelectiveJoistChairs->total_price;}
        if(is_null($SelectiveJoistL2Caliber14S)){$SelectiveJoistL2Caliber14STotalPrice = 0;}else{$SelectiveJoistL2Caliber14STotalPrice = $SelectiveJoistL2Caliber14S->total_price;}
        if(is_null($SelectiveJoistL2S)){$SelectiveJoistL2STotalPrice = 0;}else{$SelectiveJoistL2STotalPrice = $SelectiveJoistL2S->total_price;}
        if(is_null($SelectiveJoistL25Caliber14S)){$SelectiveJoistL25Caliber14STotalPrice = 0;}else{$SelectiveJoistL25Caliber14STotalPrice = $SelectiveJoistL25Caliber14S->total_price;}
        if(is_null($SelectiveJoistL25S)){$SelectiveJoistL25STotalPrice = 0;}else{$SelectiveJoistL25STotalPrice = $SelectiveJoistL25S->total_price;}
        if(is_null($SelectiveJoistLrs)){$SelectiveJoistLrsTotalPrice = 0;}else{$SelectiveJoistLrsTotalPrice = $SelectiveJoistLrs->total_price;}
        if(is_null($SelectiveJoistStructurals)){$SelectiveJoistStructuralsTotalPrice = 0;}else{$SelectiveJoistStructuralsTotalPrice = $SelectiveJoistStructurals->total_price;}
        if(is_null($SelectiveMiniatureFrames)){$SelectiveMiniatureFramesTotalPrice = 0;}else{$SelectiveMiniatureFramesTotalPrice = $SelectiveMiniatureFrames->total_price;}
        if(is_null($SelectiveSpacers)){$SelectiveSpacersTotalPrice = 0;}else{$SelectiveSpacersTotalPrice = $SelectiveSpacers->total_price;}
        if(is_null($SelectiveStructuralFrames)){$SelectiveStructuralFramesTotalPrice = 0;}else{$SelectiveStructuralFramesTotalPrice = $SelectiveStructuralFrames->total_price;}

        $SystemPrice = $SelectiveCrossbarsTotalPrice + $SelectiveFloorReinforcementsTotalPrice + $SelectiveFloorsTotalPrice + $SelectiveHeavyLoadFramesTotalPrice + $SelectiveJoistBox2Caliber14STotalPrice + $SelectiveJoistBox2STotalPrice + $SelectiveJoistBox25Caliber14STotalPrice + $SelectiveJoistBox25STotalPrice + $SelectiveJoistC2STotalPrice + $SelectiveJoistChairsTotalPrice + $SelectiveJoistL2Caliber14STotalPrice + $SelectiveJoistL2STotalPrice + $SelectiveJoistL25Caliber14STotalPrice + $SelectiveJoistL25STotalPrice + $SelectiveJoistLrsTotalPrice + $SelectiveJoistStructuralsTotalPrice + $SelectiveMiniatureFramesTotalPrice + $SelectiveSpacersTotalPrice + $SelectiveStructuralFramesTotalPrice;
        $Quotations->system_price = $SystemPrice;
        $Quotations->save();

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/background.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $BackgroundImage = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/RMARK.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $RMARK = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/ASTM.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $ASTM = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/garantia.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $Garantia = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/cross_bar.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $CrossBar = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/dowel.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $Dowel = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/fit.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $Fit = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/headboard_protector.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $HeadboardProtector = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/mesh.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $Mesh = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/post_protectors.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $PostProtectors = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/spacers.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $Spacers = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/tc.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $Tc = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/vbox.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $Vbox = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/vl.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $Vl = $imagenComoBase64;

        $pdf = Pdf::setOptions([
            'enable_html5_parser' => true,
            'enable_remote' => true,
            'defaultFont' => 'sans-serif',
            'dpi' => 150,
        ])->loadView('quotes.selectivo.reports.report_quotation_pdf', compact(
            'User',
            'Quotations',
            'Customers',
            'Contacts',
            'Questionaries',
            'QuestionaryCharts',
            'QuestionaryImages',
            'QuestionaryLayouts',
            'SelectiveCrossbars',
            'SelectiveFloorReinforcements',
            'SelectiveFloors',
            'SelectiveHeavyLoadFrames',
            'SelectiveJoistBox2Caliber14S',
            'SelectiveJoistBox2S',
            'SelectiveJoistBox25Caliber14S',
            'SelectiveJoistBox25S',
            'SelectiveJoistC2S',
            'SelectiveJoistChairs',
            'SelectiveJoistL2Caliber14S',
            'SelectiveJoistL2S',
            'SelectiveJoistL25Caliber14S',
            'SelectiveJoistL25S',
            'SelectiveJoistLrs',
            'SelectiveJoistStructurals',
            'SelectiveMiniatureFrames',
            'SelectiveSpacers',
            'SelectiveStructuralFrames',
            'Fecha',
            'BackgroundImage',
            'RMARK',
            'ASTM',
            'Garantia',
            'CrossBar',
            'Dowel',
            'Fit',
            'HeadboardProtector',
            'Mesh',
            'PostProtectors',
            'Spacers',
            'Tc',
            'Vbox',
            'Vl',
            'SystemPrice',
        ));

        return $pdf->download('Cotización'.$Quotations->invoice.'_'.$Fecha.'.pdf');
    }

    public function doubledeep($id)
    {
        $User = auth()->user();
        $Quotations = Quotation::find($id);
        $Customers = Customer::where('id', $Quotations->customer_id)->first();
        $Contacts = Contact::where('customer_id', $Customers->id)->first();
        $Questionaries = Questionary::where('quotation_id', $id)->first();
        $QuestionaryCharts = QuestionaryChart::where('quotation_id', $id)->first();
        $QuestionaryImages = QuestionaryImage::where('quotation_id', $id)->first();
        $QuestionaryLayouts = QuestionaryLayout::where('quotation_id', $id)->first();
        $DoubleDeepCrossbars = DoubleDeepCrossbar::where('quotation_id', $id)->first();
        $DoubleDeepFloorReinforcements = DoubleDeepFloorReinforcement::where('quotation_id', $id)->first();
        $DoubleDeepFloors = DoubleDeepFloor::where('quotation_id', $id)->first();
        $DoubleDeepHeavyLoadFrames = DoubleDeepHeavyLoadFrame::where('quotation_id', $id)->first();
        $DoubleDeepJoistBox2Caliber14S = DoubleDeepJoistBox2Caliber14::where('quotation_id', $id)->first();
        $DoubleDeepJoistBox2S = DoubleDeepJoistBox2::where('quotation_id', $id)->first();
        $DoubleDeepJoistBox25Caliber14S = DoubleDeepJoistBox25Caliber14::where('quotation_id', $id)->first();
        $DoubleDeepJoistBox25S = DoubleDeepJoistBox25::where('quotation_id', $id)->first();
        $DoubleDeepJoistC2S = DoubleDeepJoistC2::where('quotation_id', $id)->first();
        $DoubleDeepJoistChairs = DoubleDeepJoistChair::where('quotation_id', $id)->first();
        $DoubleDeepJoistL2Caliber14S = DoubleDeepJoistL2Caliber14::where('quotation_id', $id)->first();
        $DoubleDeepJoistL2S = DoubleDeepJoistL2::where('quotation_id', $id)->first();
        $DoubleDeepJoistL25Caliber14S = DoubleDeepJoistL25Caliber14::where('quotation_id', $id)->first();
        $DoubleDeepJoistL25S = DoubleDeepJoistL25::where('quotation_id', $id)->first();
        $DoubleDeepJoistLrs = DoubleDeepJoistLrs::where('quotation_id', $id)->first();
        $DoubleDeepJoistStructurals = DoubleDeepJoistStructural::where('quotation_id', $id)->first();
        $DoubleDeepMiniatureFrames = DoubleDeepMiniatureFrame::where('quotation_id', $id)->first();
        $DoubleDeepSpacers = DoubleDeepSpacer::where('quotation_id', $id)->first();
        $DoubleDeepStructuralFrames = DoubleDeepStructuralFrame::where('quotation_id', $id)->first();
        $Fecha = date('d-m-Y');

        if(is_null($DoubleDeepCrossbars)){$DoubleDeepCrossbarsTotalPrice = 0;}else{$DoubleDeepCrossbarsTotalPrice = $DoubleDeepCrossbars->total_price;}
        if(is_null($DoubleDeepFloorReinforcements)){$DoubleDeepFloorReinforcementsTotalPrice = 0;}else{$DoubleDeepFloorReinforcementsTotalPrice = $DoubleDeepFloorReinforcements->total_price;}
        if(is_null($DoubleDeepFloors)){$DoubleDeepFloorsTotalPrice = 0;}else{$DoubleDeepFloorsTotalPrice = $DoubleDeepFloors->total_price;}
        if(is_null($DoubleDeepHeavyLoadFrames)){$DoubleDeepHeavyLoadFramesTotalPrice = 0;}else{$DoubleDeepHeavyLoadFramesTotalPrice = $DoubleDeepHeavyLoadFrames->total_price;}
        if(is_null($DoubleDeepJoistBox2Caliber14S)){$DoubleDeepJoistBox2Caliber14STotalPrice = 0;}else{$DoubleDeepJoistBox2Caliber14STotalPrice = $DoubleDeepJoistBox2Caliber14S->total_price;}
        if(is_null($DoubleDeepJoistBox2S)){$DoubleDeepJoistBox2STotalPrice = 0;}else{$DoubleDeepJoistBox2STotalPrice = $DoubleDeepJoistBox2S->total_price;}
        if(is_null($DoubleDeepJoistBox25Caliber14S)){$DoubleDeepJoistBox25Caliber14STotalPrice = 0;}else{$DoubleDeepJoistBox25Caliber14STotalPrice = $DoubleDeepJoistBox25Caliber14S->total_price;}
        if(is_null($DoubleDeepJoistBox25S)){$DoubleDeepJoistBox25STotalPrice = 0;}else{$DoubleDeepJoistBox25STotalPrice = $DoubleDeepJoistBox25S->total_price;}
        if(is_null($DoubleDeepJoistC2S)){$DoubleDeepJoistC2STotalPrice = 0;}else{$DoubleDeepJoistC2STotalPrice = $DoubleDeepJoistC2S->total_price;}
        if(is_null($DoubleDeepJoistChairs)){$DoubleDeepJoistChairsTotalPrice = 0;}else{$DoubleDeepJoistChairsTotalPrice = $DoubleDeepJoistChairs->total_price;}
        if(is_null($DoubleDeepJoistL2Caliber14S)){$DoubleDeepJoistL2Caliber14STotalPrice = 0;}else{$DoubleDeepJoistL2Caliber14STotalPrice = $DoubleDeepJoistL2Caliber14S->total_price;}
        if(is_null($DoubleDeepJoistL2S)){$DoubleDeepJoistL2STotalPrice = 0;}else{$DoubleDeepJoistL2STotalPrice = $DoubleDeepJoistL2S->total_price;}
        if(is_null($DoubleDeepJoistL25Caliber14S)){$DoubleDeepJoistL25Caliber14STotalPrice = 0;}else{$DoubleDeepJoistL25Caliber14STotalPrice = $DoubleDeepJoistL25Caliber14S->total_price;}
        if(is_null($DoubleDeepJoistL25S)){$DoubleDeepJoistL25STotalPrice = 0;}else{$DoubleDeepJoistL25STotalPrice = $DoubleDeepJoistL25S->total_price;}
        if(is_null($DoubleDeepJoistLrs)){$DoubleDeepJoistLrsTotalPrice = 0;}else{$DoubleDeepJoistLrsTotalPrice = $DoubleDeepJoistLrs->total_price;}
        if(is_null($DoubleDeepJoistStructurals)){$DoubleDeepJoistStructuralsTotalPrice = 0;}else{$DoubleDeepJoistStructuralsTotalPrice = $DoubleDeepJoistStructurals->total_price;}
        if(is_null($DoubleDeepMiniatureFrames)){$DoubleDeepMiniatureFramesTotalPrice = 0;}else{$DoubleDeepMiniatureFramesTotalPrice = $DoubleDeepMiniatureFrames->total_price;}
        if(is_null($DoubleDeepSpacers)){$DoubleDeepSpacersTotalPrice = 0;}else{$DoubleDeepSpacersTotalPrice = $DoubleDeepSpacers->total_price;}
        if(is_null($DoubleDeepStructuralFrames)){$DoubleDeepStructuralFramesTotalPrice = 0;}else{$DoubleDeepStructuralFramesTotalPrice = $DoubleDeepStructuralFrames->total_price;}

        $SystemPrice = $DoubleDeepCrossbarsTotalPrice + $DoubleDeepFloorReinforcementsTotalPrice + $DoubleDeepFloorsTotalPrice + $DoubleDeepHeavyLoadFramesTotalPrice + $DoubleDeepJoistBox2Caliber14STotalPrice + $DoubleDeepJoistBox2STotalPrice + $DoubleDeepJoistBox25Caliber14STotalPrice + $DoubleDeepJoistBox25STotalPrice + $DoubleDeepJoistC2STotalPrice + $DoubleDeepJoistChairsTotalPrice + $DoubleDeepJoistL2Caliber14STotalPrice + $DoubleDeepJoistL2STotalPrice + $DoubleDeepJoistL25Caliber14STotalPrice + $DoubleDeepJoistL25STotalPrice + $DoubleDeepJoistLrsTotalPrice + $DoubleDeepJoistStructuralsTotalPrice + $DoubleDeepMiniatureFramesTotalPrice + $DoubleDeepSpacersTotalPrice + $DoubleDeepStructuralFramesTotalPrice;
        $Quotations->system_price = $SystemPrice;
        $Quotations->save();

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/background.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $BackgroundImage = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/RMARK.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $RMARK = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/ASTM.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $ASTM = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/garantia.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $Garantia = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/cross_bar.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $CrossBar = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/dowel.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $Dowel = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/fit.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $Fit = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/headboard_protector.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $HeadboardProtector = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/mesh.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $Mesh = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/post_protectors.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $PostProtectors = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/spacers.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $Spacers = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/tc.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $Tc = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/vbox.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $Vbox = $imagenComoBase64;

        $rutaImagen = $_SERVER['DOCUMENT_ROOT'].('/vendor/img/vl.png');
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);
        $Vl = $imagenComoBase64;

        $pdf = Pdf::setOptions([
            'enable_html5_parser' => true,
            'enable_remote' => true,
            'defaultFont' => 'sans-serif',
            'dpi' => 150,
        ])->loadView('quotes.double_deep.reports.report_quotation_pdf', compact(
            'User',
            'Quotations',
            'Customers',
            'Contacts',
            'Questionaries',
            'QuestionaryCharts',
            'QuestionaryImages',
            'QuestionaryLayouts',
            'DoubleDeepCrossbars',
            'DoubleDeepFloorReinforcements',
            'DoubleDeepFloors',
            'DoubleDeepHeavyLoadFrames',
            'DoubleDeepJoistBox2Caliber14S',
            'DoubleDeepJoistBox2S',
            'DoubleDeepJoistBox25Caliber14S',
            'DoubleDeepJoistBox25S',
            'DoubleDeepJoistC2S',
            'DoubleDeepJoistChairs',
            'DoubleDeepJoistL2Caliber14S',
            'DoubleDeepJoistL2S',
            'DoubleDeepJoistL25Caliber14S',
            'DoubleDeepJoistL25S',
            'DoubleDeepJoistLrs',
            'DoubleDeepJoistStructurals',
            'DoubleDeepMiniatureFrames',
            'DoubleDeepSpacers',
            'DoubleDeepStructuralFrames',
            'Fecha',
            'BackgroundImage',
            'RMARK',
            'ASTM',
            'Garantia',
            'CrossBar',
            'Dowel',
            'Fit',
            'HeadboardProtector',
            'Mesh',
            'PostProtectors',
            'Spacers',
            'Tc',
            'Vbox',
            'Vl',
            'SystemPrice',
        ));

        return $pdf->download('Cotización'.$Quotations->invoice.'_'.$Fecha.'.pdf');
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
