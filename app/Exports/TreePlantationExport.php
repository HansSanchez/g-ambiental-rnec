<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class TreePlantationExport implements FromView, ShouldAutoSize, WithColumnWidths, WithStyles, WithEvents, WithTitle
{
    protected $report;

    public function __construct($report)
    {
        $this->report = $report;
    }

    public function title(): string
    {
        return 'Plantación de árboles'; // CAMBIA "Plantación de árboles" POR EL NOMBRE QUE DESEES
    }

    public function styles(Worksheet $sheet)
    {
        // ESTABLECER EL TIPO DE LETRA Y TAMAÑO POR DEFECTO PARA TODO EL DOCUMENTO;
        $sheet->getParent()->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);

        // SIRVE PARA CENTRAR EN TODO EL ESPACIO DE LA CELDA
        $sheet->getStyle('A:I')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        // SIRVE PARA AUTOAJUSTAR EL TEXTO CUANDO EL TEXTO ES MUY GARNDE EN LA CELDA
        // SIRVE PARA AUTOAJUSTAR EL TEXTO CUANDO EL TEXTO ES MUY GARNDE EN LA CELDA
        $sheet->getStyle('A:I')->getAlignment()->setWrapText(true);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // RANGO PARA COLOCAR AUTOMATICAMENTE FILTROS
                $event->sheet->setAutoFilter('A1:I1');
                // ESTABLECE LA ALTURA DE LA FILA NÚMERO (X) EN (Y) UNIDADES EN LA HOJA DE CÁLCULO ACTUAL.
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(25); // FILLAS DE LOS ENCABEZADOS
                // ESTO FIJARÁ LA COLUMNA AL DESPLAZARSE HORIZONTALMENTE
                $event->sheet->freezePane('B2');
            },
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 42,
            'B' => 39,
            'C' => 17,
            'D' => 29,
            'G' => 103
        ];
    }

    public function view(): View
    {
        $report = $this->report;
        return view('reports.tree-plantations-report', ['report' => $report]);
    }
}
