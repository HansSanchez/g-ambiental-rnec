{{-- @dd($report); --}}
<table class="table">
    <thead>
        <tr>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>SEDE / DELEGACIÓN</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>NÚMERO DE ÁRBOLES PLANTADOS</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>FECHA</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>UBICACIÓN</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>LATITUD</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>LONGITUD</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>OBSERVACIONES (ESPECIES PLANTADAS)</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>REPORTANTE</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>GUARDADO</b>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($report as $key => $item)
            <tr>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    {{ $item->d_name ?: '-o-' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    {{ $item->tp_number_of_trees_planted ?: '-o-' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    {{ $item->tp_date ?: '-o-' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    {{ $item->tp_address ?: '-o-' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    {{ $item->tp_lat ?: '-o-' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    {{ $item->tp_lng ?: '-o-' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-justify; text-align: -webkit-justify; text-align: justify;">
                    {{ $item->tp_observations ?: '-o-' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    {{ $item->u_full_name ?: '-o-' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    {{ $item->tp_created_at ?: '-o-' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{-- @dd(1) --}}
