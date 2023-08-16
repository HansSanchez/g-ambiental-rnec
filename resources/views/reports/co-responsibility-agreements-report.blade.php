{{-- @dd($report); --}}
<table class="table">
    <thead>
        <tr>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>DELEGACIÓN</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>MUNICIPIO</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>GESTOR(ES) AMBIENTAL(ES)</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>OPERADOR AMBIENTAL (ASOCIACIÓN DE RECICLADORES / EMPRESA / GESTOR AUTORIZADO)</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>FECHA DE LA FIRMA DEL ACUERDO</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>OBSERVACIONES Y CAMBIOS</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>REPORTANTE</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>REPORTADO</b>
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
                    {{ $item->m_city_name ?: '-o-' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-left; text-align: -webkit-left; text-align: left">
                    <ul>
                        @foreach ($item->users as $key => $user)
                            <li>
                                {{ $user->u_full_name ?: '-o-' }}
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    {{ $item->cra_environmental_operator ?: '-o-' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    {{ $item->cra_date ?: '-o-' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-justify; text-align: -webkit-justify; text-align: justify;">
                    {{ $item->cra_observations ?: '-o-' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    {{ $item->u_full_name ?: '-o-' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    {{ $item->cra_created_at ?: '-o-' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{-- @dd(1) --}}
