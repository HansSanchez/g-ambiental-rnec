{{-- @dd($report); --}}
<table class="table">
    <thead>
        <tr>
            <th
                style="background-color: #D9D9D9; color: #000000;  border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                <b>DELEGACIÓN / MUNICIPIO / SEDE</b>
            </th>
            <th
                style="background-color: #D9D9D9; color: #000000;  border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                <b>NÚMERO DE ÁRBOLES PLANTADOS</b>
            </th>
            <th
                style="background-color: #D9D9D9; color: #000000;  border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                <b>FECHA</b>
            </th>
            <th
                style="background-color: #D9D9D9; color: #000000;  border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                <b>UBICACIÓN</b>
            </th>
            <th
                style="background-color: #D9D9D9; color: #000000;  border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                <b>LATITUD</b>
            </th>
            <th
                style="background-color: #D9D9D9; color: #000000;  border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                <b>LONGITUD</b>
            </th>
            <th
                style="background-color: #D9D9D9; color: #000000;  border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                <b>OBSERVACIONES (ESPECIES PLANTADAS)</b>
            </th>
            <th
                style="background-color: #D9D9D9; color: #000000;  border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                <b>REPORTANTE</b>
            </th>
            <th
                style="background-color: #D9D9D9; color: #000000;  border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                <b>REPORTADO</b>
            </th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalTreesPlanted = 0;
        @endphp
        @foreach ($report as $key_1 => $item)
            <tr>
                <td style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: 'Arial Black'; font-size: 9px;"
                    colspan="9">
                    <b>{{ $key_1 }}</b>
                </td>
            </tr>
            @foreach ($item as $key_2 => $value)
                @php
                    $totalTreesPlanted += $value->tp_number_of_trees_planted ?? 0;
                @endphp
                <tr>
                    <td
                        style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                        {{ $value->h_full_name ?: '-o-' }}
                    </td>
                    <td
                        style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                        {{ $value->tp_number_of_trees_planted ?: '-o-' }}
                    </td>
                    <td
                        style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                        {{ $value->tp_date ?: '-o-' }}
                    </td>
                    <td
                        style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                        {{ $value->tp_address ?: '-o-' }}
                    </td>
                    <td
                        style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                        {{ $value->tp_lat ?: '-o-' }}
                    </td>
                    <td
                        style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                        {{ $value->tp_lng ?: '-o-' }}
                    </td>
                    <td
                        style="border: 1px solid #000000; text-align: -moz-justify; text-align: -webkit-justify; text-align: justify;">
                        {{ $value->tp_observations ?: '-o-' }}
                    </td>
                    <td
                        style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                        {{ $value->u_full_name ?: '-o-' }}
                    </td>
                    <td
                        style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                        {{ $value->tp_created_at ?: '-o-' }}
                    </td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td
                style="background-color: #D9D9D9; color: #000000;  border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                <b>TOTAL</b>
            </td>
            <td
                style="background-color: #D9D9D9; color: #000000;  border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                <b>{{ number_format($totalTreesPlanted) }}</b>
            </td>
        </tr>
    </tfoot>
</table>
{{-- @dd(1) --}}
