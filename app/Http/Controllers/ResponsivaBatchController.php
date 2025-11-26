<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZipArchive;
use Carbon\Carbon;
use App\Models\TipoEquipo;
use Barryvdh\DomPDF\Facade\Pdf;

class ResponsivaBatchController extends Controller
{
    public function index()
    {
        $tipos = TipoEquipo::all();
        return view('responsiva.import', compact('tipos'));
    }

    public function procesar(Request $request)
    {
        $request->validate([
            'tipo_equipo_id' => 'required|exists:tipo_equipos,id',
            'csv' => 'required|mimes:csv,txt'
        ]);

        $tipo = TipoEquipo::find($request->tipo_equipo_id);

        $folder = storage_path('app/responsivas_temp/');
        if (!file_exists($folder)) mkdir($folder, 0777, true);

        array_map('unlink', glob($folder . '*')); // limpiar previos

        $rows = array_map('str_getcsv', file($request->csv));
        
        // Normalizar encabezados: quitar espacios y convertir a minúsculas
        $header = array_map(function($h) {
            return trim(strtolower($h));
        }, array_shift($rows));

        foreach ($rows as $row) {

            $data = array_combine($header, $row);

            $fechaCarbon = \Carbon\Carbon::createFromFormat('d/m/Y', $data['fecha_creacion']);

            $pdfData = [
                'fecha' => $fechaCarbon,
                'nombre_responsable' => $data['nombre'],
                'fecha_entrega_final' => $data['termino_entrega'],

                'tipo_equipo' => $tipo->tipo_equipo,
                'marca' => $tipo->marca,
                'modelo' => $tipo->modelo,
                'numero_serie' => $data['numero_serie'],
                'color' => $tipo->color,
                'accesorios' => $tipo->accesorios,
                'numero_inventario' => $tipo->numero_inventario,
                'valor' => $tipo->valor,
            ];


            $filename = $data['nombre'] . ' - ' . $data['numero_serie'] . '.pdf';

            $pdf = Pdf::loadView('responsiva.pdf', $pdfData)
                    ->setPaper('letter');

            $pdf->save($folder . $filename);
        }

        // Crear ZIP
        $zipPath = storage_path('app/responsivas.zip');
        $zip = new ZipArchive;

        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            foreach (glob($folder . '*.pdf') as $file) {
                $zip->addFile($file, basename($file));
            }
            $zip->close();
        }

        return response()->download($zipPath)->deleteFileAfterSend();
    }
}
