<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class ElectricalConsumptionExport implements FromView, ShouldAutoSize, WithColumnWidths, WithStyles, WithEvents, WithDrawings, WithTitle
{
    protected $report;


    public function __construct($report)
    {
        $this->report = $report;
    }

    public function title(): string
    {
        return 'Consumo de electricidad'; // CAMBIA "Consumo de electricidad" POR EL NOMBRE QUE DESEES
    }

    public function styles(Worksheet $sheet)
    {
        // ESTABLECER EL TIPO DE LETRA Y TAMAÑO POR DEFECTO PARA TODO EL DOCUMENTO;
        $sheet->getParent()->getDefaultStyle()->getFont()->setName('Arial')->setSize(12);

        // SIRVE PARA CENTRAR EN TODO EL ESPACIO DE LA CELDA
        $sheet->getStyle('A1:J1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // PROCESO
        $sheet->getStyle('B2:J2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // FORMATO
        $sheet->getStyle('A3:J3')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // FECHA DE APROBADO
        $sheet->getStyle('A4:J4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // OBJETIVO DEL FORMATO
        $sheet->getStyle('A7:J7')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // CENTRADO DE ENCABEZADOS
        $sheet->getStyle('A8:J8')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // CENTRADO DE ENCABEZADOS

        // SIRVE PARA AUTOAJUSTAR EL TEXTO CUANDO EL TEXTO ES MUY GARNDE EN LA CELDA
        $sheet->getStyle('A')->getAlignment()->setWrapText(true);
        $sheet->getStyle('B')->getAlignment()->setWrapText(true);
        $sheet->getStyle('E')->getAlignment()->setWrapText(true);
        $sheet->getStyle('F')->getAlignment()->setWrapText(true);
        $sheet->getStyle('G')->getAlignment()->setWrapText(true);
        $sheet->getStyle('H')->getAlignment()->setWrapText(true);
        $sheet->getStyle('I')->getAlignment()->setWrapText(true);
        $sheet->getStyle('J')->getAlignment()->setWrapText(true);
    }

    public function drawings()
    {
        // UBICACIÓN DE LA IMAGEN EN TU PROYECTO
        $imagePath = public_path('images\register-logo-for-export.jpg');

        // CREAR OBJETO DRAWING
        $drawing = new Drawing();
        $drawing->setPath($imagePath);
        $drawing->setHeight(90);
        $drawing->setCoordinates('A1');

        // AJUSTAR LA ALINEACIÓN DE LA IMAGEN PARA CENTRARLA EN LA CELDA
        $drawing->setOffsetX(29); // AJUSTAR SEGÚN SEA NECESARIO PARA CENTRAR HORIZONTALMENTE
        $drawing->setOffsetY(17); // AJUSTAR SEGÚN SEA NECESARIO PARA CENTRAR VERTICAL

        return [$drawing];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                // ESTABLECE LA ALTURA DE LA FILA NÚMERO 6 EN 100 UNIDADES EN LA HOJA DE CÁLCULO ACTUAL.
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(45); // FILLAS DEL LOGO
                $event->sheet->getDelegate()->getRowDimension('2')->setRowHeight(45); // FILLAS DEL LOGO
                $event->sheet->getDelegate()->getRowDimension('4')->setRowHeight(56); // OBJETIVO DEL FORMATO
                $event->sheet->getDelegate()->getRowDimension('8')->setRowHeight(56); // ENCABEZADOS DE LA TABLA

                // ESTÁS LÍNEAS ESPECIFICAN LOS RANGOS DE CELDAS QUE QUIERO UNIR
                $event->sheet->mergeCells('A1:A2');
                $event->sheet->mergeCells('A3:J3');
                $event->sheet->mergeCells('B4:J4');
                $event->sheet->mergeCells('A5:J5');
                $event->sheet->mergeCells('A7:A8');
                $event->sheet->mergeCells('B7:B8');
                $event->sheet->mergeCells('C7:C8');
                $event->sheet->mergeCells('D7:D8');
                $event->sheet->mergeCells('E6:F6');
                $event->sheet->mergeCells('J7:J8');

                // // MERGE DE LAS FILAS DE "Nombre Gestor"
                // $report = $this->report;
                // $count = count($report);
                // for ($i = 9; $i < (9 + $count); $i += $count) $event->sheet->mergeCells('A' . $i . ':A' . ($i + ($count - 1)));

                // // MERGE DE LAS FILAS DE "Delegación o sede"
                // $report = $this->report;
                // $count = count($report);
                // for ($i = 9; $i < (9 + $count); $i += $count) $event->sheet->mergeCells('B' . $i . ':B' . ($i + ($count - 1)));

                // // MERGE DE LAS FILAS DE "Año"
                // $report = $this->report;
                // $count = count($report);
                // for ($i = 9; $i < (9 + $count); $i += $count) $event->sheet->mergeCells('C' . $i . ':C' . ($i + ($count - 1)));

                // // MERGE DE LAS FILAS DE "(KW) Anual"
                // $report = $this->report;
                // $count = count($report);
                // for ($i = 9; $i < (9 + $count); $i += $count) $event->sheet->mergeCells('F' . $i . ':F' . ($i + ($count - 1)));


                // ELIMINAR LA FILA(S) NÚMERO 6
                $worksheet = $event->sheet->getDelegate();  // OBTIENE EL OBJETO PHPSPREADSHEET WORKSHEET
                $worksheet->removeRow(6); // ELIMINA LA FILA NÚMERO 6

                // APLICA EL FORMATO NUMÉRICO CON 2 DECIMALES A LAS CELDAS EN EL RANGO
                $event->sheet->getStyle('H8:H1000')->getNumberFormat()->setFormatCode('0.00');
            },
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 22,
            'B' => 17,
            'C' => 11,
            'D' => 40,
            'E' => 11,
            'F' => 11,
            'G' => 11,
            'H' => 11,
            'I' => 12,
            'J' => 14,
        ];
    }

    public function view(): View
    {

        $report = $this->report;
        return view('reports.electrical-consumptions-report', ['report' => $report]);
    }
}
