<?php

use App\Http\Controllers\CrossbarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoubleDeepController;
use App\Http\Controllers\DoubleDeepCrossbarController;
use App\Http\Controllers\DoubleDeepFloorController;
use App\Http\Controllers\DoubleDeepFloorReinforcementController;
use App\Http\Controllers\DoubleDeepFramesController;
use App\Http\Controllers\DoubleDeepMenuFrameController;
use App\Http\Controllers\DoubleDeepMenuJoistController;
use App\Http\Controllers\DoubleDeepMiniatureFrameController;
use App\Http\Controllers\DoubleDeepSpacerController;
use App\Http\Controllers\DoubleDeepStructuralFrameworksController;
use App\Http\Controllers\DoubleDeepTypeBox25JoistController;
use App\Http\Controllers\DoubleDeepTypeBox2JoistController;
use App\Http\Controllers\DoubleDeepTypeC2JoistController;
use App\Http\Controllers\DoubleDeepTypeChairJoistController;
use App\Http\Controllers\DoubleDeepTypeL25JoistController;
use App\Http\Controllers\DoubleDeepTypeL2JoistController;
use App\Http\Controllers\DoubleDeepTypeLRJoistController;
use App\Http\Controllers\DoubleDeepTypeStructuralJoistController;

use App\Http\Controllers\DriveInController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\FloorReinforcementController;
use App\Http\Controllers\FramesController;
use App\Http\Controllers\MenuFrameController;
use App\Http\Controllers\MenuJoistController;
use App\Http\Controllers\MiniatureFrameController;
use App\Http\Controllers\QuestionaryChartController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\SelectivoController;
use App\Http\Controllers\SinglePieceController;
use App\Http\Controllers\SpacerController;
use App\Http\Controllers\StructuralFrameworksController;
use App\Http\Controllers\TypeBox25JoistController;
use App\Http\Controllers\TypeBox2JoistController;
use App\Http\Controllers\TypeC2JoistController;
use App\Http\Controllers\TypeChairJoistController;
use App\Http\Controllers\TypeL25JoistController;
use App\Http\Controllers\TypeL2JoistController;
use App\Http\Controllers\TypeLJoistController;
use App\Http\Controllers\TypeLRJoistController;
use App\Http\Controllers\TypeStructuralJoistController;
use App\Models\QuestionaryChart;
use App\Models\Quotation;
use App\Models\SinglePiece;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('login'));
});

Route::group(['middleware' => ['auth:sanctum'], 'verified'], function()
{
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('open_request', [DashboardController::class, 'open_request'])->name('open_request');
    Route::get('quoter/{id}', [DashboardController::class, 'quoter'])->name('quoter');
    Route::post('rack_engineering', [DashboardController::class, 'rack_engineering'])->name('rack_engineering');
    Route::post('material_list_engineering', [DashboardController::class, 'material_list_engineering'])->name('material_list_engineering');
    Route::post('material_list_engineering_form', [DashboardController::class, 'material_list_engineering_form'])->name('material_list_engineering_form');
    Route::post('layout_quoter', [DashboardController::class, 'layout_quoter'])->name('layout_quoter');
    Route::post('photos_quoter', [DashboardController::class, 'photos_quoter'])->name('photos_quoter');
    Route::get('addphotos/{id}', [DashboardController::class, 'addphotos'])->name('addphotos');
    Route::resource('questionary_charts', QuestionaryChartController::class);
    Route::get('return_material_list/{id}', [DashboardController::class, 'return_material_list'])->name('return_material_list');
    Route::post('product_menu', [DashboardController::class, 'product_menu'])->name('product_menu');

    Route::get('/selectivo', [SelectivoController::class, 'index'])->name('selectivo.index');
    Route::get('/selectivo/{id}', [SelectivoController::class, 'show'])->name('selectivo.show');

    Route::get('/selectivo_marcos/{id}', [MenuFrameController::class, 'show'])->name('menuframes.show');
    Route::get('/selectivo_vigas/{id}', [MenuJoistController::class, 'show'])->name('menujoists.show');

    Route::get('/selectivo_crossbars/{id}', [CrossbarController::class, 'show'])->name('crossbars.show');
    Route::post('/selectivo_crossbars/calc', [CrossbarController::class, 'calc'])->name('crossbars.calc');
    
    Route::post('/selectivo_floors/calc', [FloorController::class, 'calc'])->name('floors.calc');
    Route::get('/selectivo_floors/{id}', [FloorController::class, 'show'])->name('floors.show');

    Route::post('/selectivo_floor_reinforcements/calc', [FloorReinforcementController::class, 'calc'])->name('floor_reinforcements.calc');
    Route::get('/selectivo_floor_reinforcements/{id}', [FloorReinforcementController::class, 'show'])->name('floor_reinforcements.show');
    
    Route::get('/selectivo_spacers/{id}', [SpacerController::class, 'show'])->name('spacers.show');
    Route::post('/selectivo_spacers/calc', [SpacerController::class, 'calc'])->name('spacers.calc');

    Route::get('/selectivo_carga_pesada/{id}', [FramesController::class, 'show'])->name('frames.show');
    Route::post('/selectivo_carga_pesada', [FramesController::class, 'store'])->name('frames.store');

    Route::get('/selectivo_minimarcos/{id}', [MiniatureFrameController::class, 'show'])->name('miniatureframe.show');
    Route::post('/selectivo_minimarcos', [MiniatureFrameController::class, 'store'])->name('miniatureframe.store');
    
    Route::get('/selectivo_marcos_estructurales/{id}', [StructuralFrameworksController::class, 'show'])->name('structuralframeworks.show');
    Route::post('/selectivo_marcos_estructurales', [StructuralFrameworksController::class, 'store'])->name('structuralframeworks.store');

    Route::get('/selectivo_vigas_tipo_L_2/{id}', [TypeL2JoistController::class, 'show'])->name('typel2joists.show');
    Route::post('/selectivo_vigas_tipo_L_2/', [TypeL2JoistController::class, 'store'])->name('typel2joists.store');
    
    Route::get('/selectivo_vigas_tipo_L_2/calibre14/{id}', [TypeL2JoistController::class, 'caliber14_show'])->name('typel2joists_caliber14.show');
    Route::post('/selectivo_vigas_tipo_L_2/calibre14', [TypeL2JoistController::class, 'caliber14_calc'])->name('typel2joists_caliber14.calc');

    Route::get('/selectivo_vigas_tipo_L_2_5/{id}', [TypeL25JoistController::class, 'show'])->name('typel25joists.show');
    Route::post('/selectivo_vigas_tipo_L_2_5/', [TypeL25JoistController::class, 'store'])->name('typel25joists.store');
    
    Route::get('/selectivo_vigas_tipo_L_2_5/calibre14/{id}', [TypeL25JoistController::class, 'caliber14_show'])->name('typel25joists_caliber14.show');
    Route::post('/selectivo_vigas_tipo_L_2_5/calibre14', [TypeL25JoistController::class, 'caliber14_calc'])->name('typel25joists_caliber14.calc');

    Route::get('/selectivo_vigas_tipo_Box_2/{id}', [TypeBox2JoistController::class, 'show'])->name('typebox2joists.show');
    Route::post('/selectivo_vigas_tipo_Box_2/', [TypeBox2JoistController::class, 'store'])->name('typebox2joists.store');
    
    Route::get('/selectivo_vigas_tipo_Box_2/calibre14/{id}', [TypeBox2JoistController::class, 'caliber14_show'])->name('typebox2joists_caliber14.show');
    Route::post('/selectivo_vigas_tipo_Box_2/calibre14', [TypeBox2JoistController::class, 'caliber14_calc'])->name('typebox2joists_caliber14.calc');

    Route::get('/selectivo_vigas_tipo_Box_25/{id}', [TypeBox25JoistController::class, 'show'])->name('typebox25joists.show');
    Route::post('/selectivo_vigas_tipo_Box_25/', [TypeBox25JoistController::class, 'store'])->name('typebox25joists.store');
    
    Route::get('/selectivo_vigas_tipo_Box_25/calibre14/{id}', [TypeBox25JoistController::class, 'caliber14_show'])->name('typebox25joists_caliber14.show');
    Route::post('/selectivo_vigas_tipo_Box_25/calibre14', [TypeBox25JoistController::class, 'caliber14_calc'])->name('typebox25joists_caliber14.calc');

    Route::get('/selectivo_vigas_tipo_Structural/{id}', [TypeStructuralJoistController::class, 'show'])->name('typestructuraljoists.show');
    Route::post('/selectivo_vigas_tipo_Structural/', [TypeStructuralJoistController::class, 'store'])->name('typestructuraljoists.store');
    
    Route::get('/selectivo_vigas_tipo_Structural/calibre14/{id}', [TypeStructuralJoistController::class, 'caliber14_show'])->name('typestructuraljoists_caliber14.show');
    Route::post('/selectivo_vigas_tipo_Structural/calibre14', [TypeStructuralJoistController::class, 'caliber14_calc'])->name('typestructuraljoists_caliber14.calc');

    Route::get('/selectivo_vigas_tipo_C2/{id}', [TypeC2JoistController::class, 'show'])->name('typec2joists.show');
    Route::post('/selectivo_vigas_tipo_C2/', [TypeC2JoistController::class, 'store'])->name('typec2joists.store');
    
    Route::get('/selectivo_vigas_tipo_C2/calibre14/{id}', [TypeC2JoistController::class, 'caliber14_show'])->name('typec2joists_caliber14.show');
    Route::post('/selectivo_vigas_tipo_C2/calibre14', [TypeC2JoistController::class, 'caliber14_calc'])->name('typec2joists_caliber14.calc');

    Route::get('/selectivo_vigas_tipo_LR/{id}', [TypeLRJoistController::class, 'show'])->name('typelrjoists.show');
    Route::post('/selectivo_vigas_tipo_LR/', [TypeLRJoistController::class, 'store'])->name('typelrjoists.store');
    
    Route::get('/selectivo_vigas_tipo_LR/calibre14/{id}', [TypeLRJoistController::class, 'caliber14_show'])->name('typelrjoists_caliber14.show');
    Route::post('/selectivo_vigas_tipo_LR/calibre14', [TypeLRJoistController::class, 'caliber14_calc'])->name('typelrjoists_caliber14.calc');

    Route::get('/selectivo_vigas_tipo_Chair/{id}', [TypeChairJoistController::class, 'show'])->name('typechairjoists.show');
    Route::post('/selectivo_vigas_tipo_Chair/', [TypeChairJoistController::class, 'store'])->name('typechairjoists.store');
    
    Route::get('/selectivo_vigas_tipo_Chair/calibre14/{id}', [TypeChairJoistController::class, 'caliber14_show'])->name('typechairjoists_caliber14.show');
    Route::post('/selectivo_vigas_tipo_Chair/calibre14', [TypeChairJoistController::class, 'caliber14_calc'])->name('typechairjoists_caliber14.calc');


    Route::get('/double_deep', [DoubleDeepController::class, 'index'])->name('double_deep.index');
    Route::get('/double_deep/{id}', [DoubleDeepController::class, 'show'])->name('double_deep.show');

    Route::get('/double_deep_marcos/{id}', [DoubleDeepMenuFrameController::class, 'show'])->name('double_deep_menuframes.show');
    Route::get('/double_deep_vigas/{id}', [DoubleDeepMenuJoistController::class, 'show'])->name('double_deep_menujoists.show');

    Route::get('/double_deep_crossbars/{id}', [DoubleDeepCrossbarController::class, 'show'])->name('double_deep_crossbars.show');
    Route::post('/double_deep_crossbars/calc', [DoubleDeepCrossbarController::class, 'calc'])->name('double_deep_crossbars.calc');
    
    Route::post('/double_deep_floors/calc', [DoubleDeepFloorController::class, 'calc'])->name('double_deep_floors.calc');
    Route::get('/double_deep_floors/{id}', [DoubleDeepFloorController::class, 'show'])->name('double_deep_floors.show');

    Route::post('/double_deep_floor_reinforcements/calc', [DoubleDeepFloorReinforcementController::class, 'calc'])->name('double_deep_floor_reinforcements.calc');
    Route::get('/double_deep_floor_reinforcements/{id}', [DoubleDeepFloorReinforcementController::class, 'show'])->name('double_deep_floor_reinforcements.show');
    
    Route::get('/double_deep_spacers/{id}', [DoubleDeepSpacerController::class, 'show'])->name('double_deep_spacers.show');
    Route::post('/double_deep_spacers/calc', [DoubleDeepSpacerController::class, 'calc'])->name('double_deep_spacers.calc');

    Route::get('/double_deep_carga_pesada/{id}', [DoubleDeepFramesController::class, 'show'])->name('double_deep_frames.show');
    Route::post('/double_deep_carga_pesada', [DoubleDeepFramesController::class, 'store'])->name('double_deep_frames.store');

    Route::get('/double_deep_minimarcos/{id}', [DoubleDeepMiniatureFrameController::class, 'show'])->name('double_deep_miniatureframe.show');
    Route::post('/double_deep_minimarcos', [DoubleDeepMiniatureFrameController::class, 'store'])->name('double_deep_miniatureframe.store');
    
    Route::get('/double_deep_marcos_estructurales/{id}', [DoubleDeepStructuralFrameworksController::class, 'show'])->name('double_deep_structuralframeworks.show');
    Route::post('/double_deep_marcos_estructurales', [DoubleDeepStructuralFrameworksController::class, 'store'])->name('double_deep_structuralframeworks.store');

    Route::get('/double_deep_vigas_tipo_L_2/{id}', [DoubleDeepTypeL2JoistController::class, 'show'])->name('double_deep_typel2joists.show');
    Route::post('/double_deep_vigas_tipo_L_2/', [DoubleDeepTypeL2JoistController::class, 'store'])->name('double_deep_typel2joists.store');
    
    Route::get('/double_deep_vigas_tipo_L_2/calibre14/{id}', [DoubleDeepTypeL2JoistController::class, 'caliber14_show'])->name('double_deep_typel2joists_caliber14.show');
    Route::post('/double_deep_vigas_tipo_L_2/calibre14', [DoubleDeepTypeL2JoistController::class, 'caliber14_calc'])->name('double_deep_typel2joists_caliber14.calc');

    Route::get('/double_deep_vigas_tipo_L_2_5/{id}', [DoubleDeepTypeL25JoistController::class, 'show'])->name('double_deep_typel25joists.show');
    Route::post('/double_deep_vigas_tipo_L_2_5/', [DoubleDeepTypeL25JoistController::class, 'store'])->name('double_deep_typel25joists.store');
    
    Route::get('/double_deep_vigas_tipo_L_2_5/calibre14/{id}', [DoubleDeepTypeL25JoistController::class, 'caliber14_show'])->name('double_deep_typel25joists_caliber14.show');
    Route::post('/double_deep_vigas_tipo_L_2_5/calibre14', [DoubleDeepTypeL25JoistController::class, 'caliber14_calc'])->name('double_deep_typel25joists_caliber14.calc');

    Route::get('/double_deep_vigas_tipo_Box_2/{id}', [DoubleDeepTypeBox2JoistController::class, 'show'])->name('double_deep_typebox2joists.show');
    Route::post('/double_deep_vigas_tipo_Box_2/', [DoubleDeepTypeBox2JoistController::class, 'store'])->name('double_deep_typebox2joists.store');
    
    Route::get('/double_deep_vigas_tipo_Box_2/calibre14/{id}', [DoubleDeepTypeBox2JoistController::class, 'caliber14_show'])->name('double_deep_typebox2joists_caliber14.show');
    Route::post('/double_deep_vigas_tipo_Box_2/calibre14', [DoubleDeepTypeBox2JoistController::class, 'caliber14_calc'])->name('double_deep_typebox2joists_caliber14.calc');

    Route::get('/double_deep_vigas_tipo_Box_25/{id}', [DoubleDeepTypeBox25JoistController::class, 'show'])->name('double_deep_typebox25joists.show');
    Route::post('/double_deep_vigas_tipo_Box_25/', [DoubleDeepTypeBox25JoistController::class, 'store'])->name('double_deep_typebox25joists.store');
    
    Route::get('/double_deep_vigas_tipo_Box_25/calibre14/{id}', [DoubleDeepTypeBox25JoistController::class, 'caliber14_show'])->name('double_deep_typebox25joists_caliber14.show');
    Route::post('/double_deep_vigas_tipo_Box_25/calibre14', [DoubleDeepTypeBox25JoistController::class, 'caliber14_calc'])->name('double_deep_typebox25joists_caliber14.calc');

    Route::get('/double_deep_vigas_tipo_Structural/{id}', [DoubleDeepTypeStructuralJoistController::class, 'show'])->name('double_deep_typestructuraljoists.show');
    Route::post('/double_deep_vigas_tipo_Structural/', [DoubleDeepTypeStructuralJoistController::class, 'store'])->name('double_deep_typestructuraljoists.store');
    
    Route::get('/double_deep_vigas_tipo_Structural/calibre14/{id}', [DoubleDeepTypeStructuralJoistController::class, 'caliber14_show'])->name('double_deep_typestructuraljoists_caliber14.show');
    Route::post('/double_deep_vigas_tipo_Structural/calibre14', [DoubleDeepTypeStructuralJoistController::class, 'caliber14_calc'])->name('double_deep_typestructuraljoists_caliber14.calc');

    Route::get('/double_deep_vigas_tipo_C2/{id}', [DoubleDeepTypeC2JoistController::class, 'show'])->name('double_deep_typec2joists.show');
    Route::post('/double_deep_vigas_tipo_C2/', [DoubleDeepTypeC2JoistController::class, 'store'])->name('double_deep_typec2joists.store');
    
    Route::get('/double_deep_vigas_tipo_C2/calibre14/{id}', [DoubleDeepTypeC2JoistController::class, 'caliber14_show'])->name('double_deep_typec2joists_caliber14.show');
    Route::post('/double_deep_vigas_tipo_C2/calibre14', [DoubleDeepTypeC2JoistController::class, 'caliber14_calc'])->name('double_deep_typec2joists_caliber14.calc');

    Route::get('/double_deep_vigas_tipo_LR/{id}', [DoubleDeepTypeLRJoistController::class, 'show'])->name('double_deep_typelrjoists.show');
    Route::post('/double_deep_vigas_tipo_LR/', [DoubleDeepTypeLRJoistController::class, 'store'])->name('double_deep_typelrjoists.store');
    
    Route::get('/double_deep_vigas_tipo_LR/calibre14/{id}', [DoubleDeepTypeLRJoistController::class, 'caliber14_show'])->name('double_deep_typelrjoists_caliber14.show');
    Route::post('/double_deep_vigas_tipo_LR/calibre14', [DoubleDeepTypeLRJoistController::class, 'caliber14_calc'])->name('double_deep_typelrjoists_caliber14.calc');

    Route::get('/double_deep_vigas_tipo_Chair/{id}', [DoubleDeepTypeChairJoistController::class, 'show'])->name('double_deep_typechairjoists.show');
    Route::post('/double_deep_vigas_tipo_Chair/', [DoubleDeepTypeChairJoistController::class, 'store'])->name('double_deep_typechairjoists.store');
    
    Route::get('/double_deep_vigas_tipo_Chair/calibre14/{id}', [DoubleDeepTypeChairJoistController::class, 'caliber14_show'])->name('double_deep_typechairjoists_caliber14.show');
    Route::post('/double_deep_vigas_tipo_Chair/calibre14', [DoubleDeepTypeChairJoistController::class, 'caliber14_calc'])->name('double_deep_typechairjoists_caliber14.calc');

    Route::get('/double_deep_quotations/{id}', [QuotationController::class, 'doubledeep'])->name('double_deep_quotations.show');


    #________________Drive in
    Route::get('/drivein', [DriveInController::class, 'index'])->name('drivein.index');
    Route::get('/drivein/{id}', [DriveInController::class, 'show'])->name('drivein.show');
    Route::get('/drivein/frames/{id}', [MenuFrameController::class, 'drive_show'])->name('menuframes.drive_show');
    Route::get('/drives/joist/{id}', [MenuJoistController::class, 'drive_show'])->name('menujoists.drive_show');

    Route::get('/drivein_carga_pesada/{id}', [FramesController::class, 'drive_show'])->name('frames.drive_show');
    Route::post('/drivein_carga_pesada', [FramesController::class, 'drive_store'])->name('frames.drive_store');

    
    Route::get('/drivein_marcos_estructurales/{id}', [StructuralFrameworksController::class, 'drive_show'])->name('structuralframeworks.drive_show');
    Route::post('/drive_marcos_estructurales', [StructuralFrameworksController::class, 'drive_store'])->name('structuralframeworks.drive_store');

    #________________END Drive IN


    Route::get('/singlepieces/{id}', [SinglePieceController::class, 'show'])->name('singlepieces.show');
    Route::post('/singlepieces/calc', [SinglePieceController::class, 'calc'])->name('singlepieces.calc');

    Route::get('/quotations/{id}', [QuotationController::class, 'show'])->name('quotations.show');
    Route::get('/quotations', [QuotationController::class, 'index'])->name('quotations');
    
});

