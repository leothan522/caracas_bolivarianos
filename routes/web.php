<?php

use App\Http\Controllers\Dashboard\ExportIntencionController;
use App\Http\Controllers\Dashboard\ExportIntencionDeporteController;
use App\Http\Controllers\Dashboard\ExportModalidadController;
use App\Http\Controllers\Dashboard\ExportParticipanteController;
use App\Http\Controllers\Dashboard\ExportReportesController;
use App\Http\Controllers\Dashboard\ExportsExcelController;
use App\Http\Controllers\Web\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
})->name('web.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');
});

Route::get('export/{id}/participante', [ExportParticipanteController::class, 'generarPDF'])->name('export.participante');
Route::get('export/reportes/{filtro}/{id_deporte?}', [ExportReportesController::class, 'generarPDF'])->name('export.reportes');
Route::get('export/reportes/{filtro}/{id_entidad}/inscritos/{id_deporte?}', [ExportReportesController::class, 'generarEntidadPDF'])->name('export.reportes.entidad');
Route::get('export/all/reportes/inscritos/{filtro}/{id_deporte?}', [ExportReportesController::class, 'generarAllPDF'])->name('export.reportes.all');

Route::get('consultar/{cedula}/participante', [WebController::class, 'consultarParticipante'])->name('consultar.participante');

Route::get('export/intencion/participacion/{id_endidad?}', [ExportIntencionController::class, 'exportIntencionParticipacion'])->name('intencion.participacion');
Route::get('export/intencion/deporte/{proceso}/{id_endidad?}', [ExportIntencionDeporteController::class, 'exportIntencionDeporte'])->name('intencion.deporte');
Route::get('export/intencion/reporte/', [ExportIntencionController::class, 'exportIntencionReporteGeneral'])->name('intencion.reporte');
Route::get('export/numerica/reporte/{id?}', [ExportIntencionController::class, 'exportIntencionNumerica'])->name('intencion.numerica');

Route::get('export/deporte/reportes/{id_entidad}/{filtro}/{id_deporte}', [ExportModalidadController::class, 'exportDeporte'])->name('export.deporte');
Route::get('export/modalidad/reportes/{id_entidad}/{filtro}/{id_modalidad}', [ExportModalidadController::class, 'exportModalidad'])->name('export.modalidad');

Route::get('/export/excel/intencion-participacion/{proceso}', [ExportsExcelController::class, 'intencionParticipacion'])->name('excel-exports.intencion-participacion');
Route::get('/export/excel/inscripcion-participacion', [ExportsExcelController::class, 'inscripcionNumerica'])->name('excel-exports.inscripcion-numerica');
