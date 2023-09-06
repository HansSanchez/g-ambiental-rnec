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
    protected $year;
    protected $delegation;


    public function __construct($report, $year, $delegation)
    {
        $this->report = $report;
        $this->year = $year;
        $this->delegation = $delegation;
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
        $sheet->getStyle('A:J')->getAlignment()->setWrapText(true);
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

                // ESTABLECE LA ALTURA DE LA FILA NÚMERO (X) EN (Y) UNIDADES EN LA HOJA DE CÁLCULO ACTUAL.
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(45); // FILLAS DEL LOGO
                $event->sheet->getDelegate()->getRowDimension('2')->setRowHeight(45); // FILLAS DEL LOGO
                $event->sheet->getDelegate()->getRowDimension('4')->setRowHeight(56); // OBJETIVO DEL FORMATO
                $event->sheet->getDelegate()->getRowDimension('8')->setRowHeight(56); // ENCABEZADOS DE LA TABLA

                // ESTÁS LÍNEAS ESPECIFICAN LOS RANGOS DE CELDAS QUE QUIERO UNIR
                $event->sheet->mergeCells('A1:A2'); // LOGO
                $event->sheet->mergeCells('A3:J3'); // FECHA DE APROBADO
                $event->sheet->mergeCells('B4:J4'); // OBJETIVO DEL FORMATO
                $event->sheet->mergeCells('A5:J5'); // LÍNEA EN BLANCO
                /*
                    MÁS ABAJO SE ELIMINA LA FILA 6,
                    POR ENDE HAY NUEVA INTERPRETACIÓN DE AQUÍ PARA ABAJO EN LOS NÚMERO

                    EN OTRAS PALABRAS, SE SUMAN DE A 1

                    EJEMPLO A6 AHORA ES A7 Y ASÍ SUCESIVAMENTE
                */
                $event->sheet->mergeCells('A7:A8'); // NOMBRE DEL GESTOR
                $event->sheet->mergeCells('B7:B8'); // DELEGACIÓN O SESE
                $event->sheet->mergeCells('C7:C8'); // AÑO
                $event->sheet->mergeCells('D7:D8'); // MES DE CONSUMO

                // ESTOS SON ENCABEZADOS ESPECIALES PORQUE AGRUPAN 2 O 3 COLUMNAS
                $event->sheet->mergeCells('E6:F6'); // CONSUMO DE ELECTRICIDAD
                $event->sheet->mergeCells('J7:J8'); // CONSUMO PER CÁPITA

                // DEFINICIÓN DE VARIABLES PARA OPTIMIZACIÓN DE CÓDIGO
                $report = $this->report; // RESPUESTA DE LA DB
                $year = $this->year; // AÑO QUE ENVIAN POR PARAMETRO
                $delegation = $this->delegation; // DELEGACIÓN QUE ENVIAN POR PARAMETRO
                $countHeasquarters = count($report); // CANTIDAD DE SEDES QUE LLEGAN EN LA RESPUESTA DE LA DB
                $columnsIncrements = ($year < 2023) ? 14 : 15; // INCREMENTO
                $columnsA_B = ($year < 2023) ? 13 : 14; // GRUPO DE COLUMNAS
                $IStart = ($year < 2023) ? 10 : 11; // INICIO DE CICLO
                $leap = ($year < 2023) ? 3 : 4; // SALTO DE COLUMNAS
                $countDefault = ($year < 2023) ? 24 : 25; // CONTEO DE COLUMNAS POR DEFECTO PARA BOGOTÁ

                for ($i = 10; $i < ($columnsIncrements * $countHeasquarters); $i += $columnsIncrements) {
                    // MERGE DE LAS FILAS DE "Nombre Gestor"
                    // $event->sheet->mergeCells('A' . $i . ':A' . ($i + $columnsA_B));
                    // MERGE DE LAS FILAS DE "Delegación o sede"
                    $event->sheet->mergeCells('B' . $i . ':B' . ($i + $columnsA_B));
                    // AGREGAR UN SALTO DE 1 FILA DESPUÉS DE CADA CONJUNTO DE 12 ITERACIONES
                    if (($i + $columnsIncrements) < ($columnsIncrements * $countHeasquarters)) $i += 1;
                }

                for ($i = $IStart; $i < ($columnsIncrements * $countHeasquarters); $i += 12) {
                    // MERGE DE LAS FILAS DE "Año"
                    $event->sheet->mergeCells('C' . $i . ':C' . ($i + 11));
                    // MERGE DE LAS FILAS DE "(KW) Anual"
                    $event->sheet->mergeCells('F' . $i . ':F' . ($i + 11));
                    // AGREGAR UN SALTO DE 2 o 3 FILAS DESPUÉS DE CADA CONJUNTO DE 12 ITERACIONES
                    if (($i + 12) < ($columnsIncrements * $countHeasquarters)) $i += $leap;
                }

                // TOTAL AUXILIAR PARA DETERMINAR EL TOTAL DE REGISTROS
                $totalRecordsAux = $countHeasquarters == 1 ? $countHeasquarters = $countDefault : ($columnsIncrements * $countHeasquarters);
                // TOTAL DE REGISTROS
                $totalRecords = ($totalRecordsAux == $countDefault ? $totalRecordsAux : $totalRecordsAux + 11);

                $pattern = ($year < 2023) ? [2, 3, 3, 3, 3, 1] : [3, 3, 3, 3, 3, 1]; // PATRON DE COMBINACIÓN
                $patternIndex = 0; // ÍNDICE PARA RECORRER EL PATRÓN
                $countMerge  = 1; // CONTADOR PARA DETERMINAR EL VALOR INICIAL DEL MERGE
                $mergeIndex = 10; // ÍNDICE INICIAL PARA COMBINAR CELDAS
                $sheet = $event->sheet; // ACCEDER A LA HOJA DE CÁLCULO

                // ITERAR HASTA QUE SE HAYAN COMBINADO TODAS LAS CELDAS
                while ($mergeIndex < $totalRecords) {
                    // OBTENER EL VALOR ACTUAL DEL PATRÓN
                    $repeat = $pattern[$patternIndex];

                    // AJUSTAR LA REPETICIÓN SI SUPERA EL LÍMITE DE REGISTROS
                    if ($mergeIndex + $repeat > $totalRecords) {
                        $repeat = $totalRecords - $mergeIndex;
                    }

                    // VERIFICAR SI ES LA ÚLTIMA POSICIÓN DEL PATRÓN
                    $isLastPosition = ($patternIndex === count($pattern) - 1);

                    // COMBINAR CELDAS EN FUNCIÓN DEL VALOR DE $REPEAT (excepto en la última posición)
                    if (!$isLastPosition) {
                        $sheet->mergeCells('I' . $mergeIndex . ':I' . ($mergeIndex + $repeat - 1));
                    }

                    $formulaColumn = "I" . $mergeIndex; // Columna I en la que se colocará el resultado de la fórmula
                    $rangeColumn = "G" . $mergeIndex . ":G" . ($mergeIndex + $repeat - 1); // Rango de celdas para la suma en la fórmula
                    $rangeColumn2 = "E" . $mergeIndex . ":E" . ($mergeIndex + $repeat - 1); // Rango de celdas para la segunda suma en la fórmula

                    // CALCULAR LA FÓRMULA SOLO SI NO ESTAMOS EN LA ÚLTIMA POSICIÓN DEL PATRÓN
                    if (!$isLastPosition) {
                        $formula = "=IF(SUM($rangeColumn),SUM($rangeColumn2)/SUM($rangeColumn),0)"; // FÓRMULA DE EXCEL
                        $event->sheet->setCellValue($formulaColumn, $formula);
                    }

                    // ACTUALIZAR EL ÍNDICE DE COMBINACIÓN Y EL PATRÓN
                    $mergeIndex += $repeat;
                    $patternIndex = ($patternIndex + 1) % count($pattern);
                    $countMerge++;
                }

                // ELIMINAR LA FILA(S) NÚMERO 6
                $event->sheet->getDelegate()->removeRow(6);

                // APLICA EL FORMATO NUMÉRICO O CON 2 DECIMALES A LAS CELDAS EN EL RANGO
                $event->sheet->getStyle('E9:E2000')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER); // (KW) MENSUAL
                $event->sheet->getStyle('F9:F2000')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER); // (KW) ANUAL
                $event->sheet->getStyle('G9:G2000')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER); // TOTAL DE PERSONAL
                $event->sheet->getStyle('H9:H2000')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00); // CONSUMO PER CÁPITA (KW) POR MES
                $event->sheet->getStyle('I9:I2000')->getNumberFormat()->setFormatCode('#,0.0000000');; // PROMEDIO TRIMESTRAL DE PER CÁPITA (KW) POR MES

                $startRow = ($year < 2023) ? 9 : 10; // FILA INICIAL
                $rowIncrement = 12; // INCREMENTO DE FILAS

                // FILA FINAL PARA QUE NO APLIQUE SUMATORIA EN LUGARES QUE NO HAY DATOS
                $endRow = ($delegation == 'BOGOTÁ') ?
                    (($countHeasquarters == 24) ? 19 : $countHeasquarters) : ($columnsIncrements * $countHeasquarters);
                $endRow =  $endRow == 2 ? ($columnsIncrements * $countHeasquarters) : $endRow;

                // dd($startRow, $endRow,  $rowIncrement, $columnsIncrements, $countHeasquarters);
                for ($i = $startRow; $i < $endRow; $i += $rowIncrement) {
                    $formulaCell = "F{$i}"; // CELDA EN DONDE SE VA A MOSTRAR LA SUMATORIA
                    $event->sheet->setCellValue($formulaCell, "=SUM(E{$i}:E" . ($i + 11) . ")");
                    // AGREGAR UN SALTO DE 2 o 3 FILAS DESPUÉS DE CADA CONJUNTO DE 12 ITERACIONES
                    if (($i + $rowIncrement) < ($columnsIncrements * $countHeasquarters)) $i += $leap;
                }
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
            'J' => 20,
        ];
    }

    public function view(): View
    {

        $report = $this->report;
        return view('reports.electrical-consumptions-report', ['report' => $report]);
    }
}
