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
                <b>SEDE(S) A LA(S) CUAL(ES) LE(S) APLICA</b>
            </th>
            <th
                style="background-color: #D9D9D9; color: #000000;  border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                <b>ESTADO</b>
            </th>
            <th
                style="background-color: #D9D9D9; color: #000000;  border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                <b>GESTOR(ES) AMBIENTAL(ES)</b>
            </th>
            <th
                style="background-color: #D9D9D9; color: #000000;  border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                <b>OPERADOR AMBIENTAL (ASOCIACIÓN DE RECICLADORES / EMPRESA / GESTOR AUTORIZADO)</b>
            </th>
            <th
                style="background-color: #D9D9D9; color: #000000;  border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                <b>FECHA DE LA FIRMA DEL ACUERDO</b>
            </th>
            <th
                style="background-color: #D9D9D9; color: #000000;  border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                <b>OBSERVACIONES Y CAMBIOS</b>
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
        @foreach ($report as $key_1 => $item)
            <tr>
                <td style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: 'Arial Black'; font-size: 9px;"
                    colspan="9">
                    <b>{{ $key_1 }}</b>
                </td>
            </tr>
            @foreach ($item as $key_2 => $value)
                <tr>
                    <td
                        style="border: 1px solid #000000; text-align: -moz-left; text-align: -webkit-left; text-align: left; font-family: Arial; font-size: 9;">
                        {{ $value->h_full_name ?: '-o-' }}
                    </td>
                    <td
                        style="border: 1px solid #000000; text-align: -moz-left; text-align: -webkit-left; text-align: left; font-family: Arial; font-size: 9;">
                        <ul>
                            @foreach ($value->headquarters as $key => $headquarter)
                                <li>
                                    {{ $headquarter->h_full_name ?: '-o-' }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td
                        style="border: 1px solid #000000; text-align: -moz-left; text-align: -webkit-left; text-align: left; font-family: Arial; font-size: 9;">
                        {{ $value->cra_state ?: '-o-' }}
                    </td>
                    <td
                        style="border: 1px solid #000000; text-align: -moz-left; text-align: -webkit-left; text-align: left; font-family: Arial; font-size: 9;">
                        <ul>
                            @foreach ($value->users as $key => $user)
                                <li>
                                    {{ $user->u_full_name_g ?: '-o-' }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td
                        style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                        {{ $value->cra_environmental_operator ?: '-o-' }}
                    </td>
                    <td
                        style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                        {{ $value->cra_date ?: '-o-' }}
                    </td>
                    <td
                        style="border: 1px solid #000000; text-align: -moz-justify; text-align: -webkit-justify; text-align: justify; font-family: Arial; font-size: 9;">
                        {{ $value->cra_observations ?: '-o-' }}
                    </td>
                    <td
                        style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                        {{ $value->u_full_name_r ?: '-o-' }}
                    </td>
                    <td
                        style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center; font-family: Arial; font-size: 9;">
                        {{ $value->cra_created_at ?: '-o-' }}
                    </td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
{{-- @dd(1) --}}
