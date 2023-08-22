{{-- @dd($report) --}}
<table class="table">
    <thead>
        <tr>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>ACCIÓN</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>FECHA</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>MÓDULO</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>ID DEL USUARIO</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>CÉDULA</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>CARGO</b>
            </th>
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
                <b>NOMBRE DEL USUARIO</b>
            </th>
            <th
                style="background-color: #002D55; color: #FFFFFF; border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                <b>CORREO DEL USUARIO</b>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($report as $key => $item)
            <tr>
                <td
                    style="border: 1px solid #000000; text-align: -moz-left; text-align: -webkit-left; text-align: left">
                    {{ $item->au_action ?: '-o-' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    {{ $item->au_created_at ?: '-o-' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    {{ $item->au_module ?: '-o-' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    {{ $item->u_id ?: '-o-' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    {{ $item->u_personal_id ?: 'SIN CÉDULA' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    {{ $item->u_position ?: 'SIN CARGO' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    @php
                        $delegation = \App\Models\Delegation::where('id', $item->u_delegation_id)
                            ->pluck('name')
                            ->first();
                    @endphp
                    {{ $delegation != null ? $delegation : 'SIN DELEGACIÓN' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    @php
                        $municipality = \App\Models\Municipality::where('id', $item->u_municipality_id)
                            ->pluck('city_name')
                            ->first();
                    @endphp
                    {{ $municipality != null ? $municipality : 'SIN MUNICIPIO' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    {{ $item->u_first_name
                        ? $item->u_first_name .
                            ' ' .
                            $item->u_second_name .
                            ' ' .
                            $item->u_first_last_name .
                            ' ' .
                            $item->u_second_last_name
                        : '-o-' }}
                </td>
                <td
                    style="border: 1px solid #000000; text-align: -moz-center; text-align: -webkit-center; text-align: center">
                    {{ $item->u_email ?: '-o-' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{-- @dd(1) --}}
