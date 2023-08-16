<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CoResponsibilityAgreementExport implements FromView, ShouldAutoSize, WithColumnWidths, WithStyles, WithEvents
{
    protected $report;


    public function __construct($report)
    {
        $this->report = $report;
    }

    public function styles(Worksheet $sheet)
    {
        // SIRVE PARA CENTRAR EN TODO EL ESPACIO DE LA CELDA
        $sheet->getStyle('A:H')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        // SIRVE PARA AUTOAJUSTAR EL TEXTO CUANDO EL TEXTO ES MUY GARNDE EN LA CELDA
        $sheet->getStyle('F')->getAlignment()->setWrapText(true);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getRowDimension('8')->setRowHeight(100);
                $event->sheet->setAutoFilter('A1:H1'); // RANGO PARA COLOCAR AUTOMATICAMENTE FILTROS
            },
        ];
    }

    public function columnWidths(): array
    {
        return ['F' => 100];
    }

    public function view(): View
    {
        $report = $this->report;
        return view('reports.co-responsibility-agreements-report', ['report' => $report]);
    }
}
