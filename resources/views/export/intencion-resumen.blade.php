<table>
    <thead>
    <tr>
        <th rowspan="2" style="background-color: #F2F2F2; border: 1px solid #404040; text-align: center; vertical-align: center; font-weight: bold">Nº</th>
        <th rowspan="2" style="background-color: #F2F2F2; border: 1px solid #404040; text-align: center; vertical-align: center; font-weight: bold">DEPORTES - MODALIDAD</th>
        @foreach($clubes as $club)
            <th colspan="2" style="background-color: #F2F2F2; border: 1px solid #404040; text-align: center; vertical-align: center; font-weight: bold">{{ \Illuminate\Support\Str::upper($club->short_nombre) }}</th>
        @endforeach
        <th colspan="2" style="background-color: #F2F2F2; border: 1px solid #404040; text-align: center; vertical-align: center; font-weight: bold">TOTALES</th>
        <th style="background-color: #F2F2F2; border: 1px solid #404040; text-align: center; vertical-align: center; font-weight: bold">ATLETAS</th>
    </tr>
    <tr>
        @foreach($clubes as $club)
            <th style="background-color: #F2F2F2; border: 1px solid #404040; text-align: center; vertical-align: center; font-weight: bold">Fem.</th>
            <th style="background-color: #F2F2F2; border: 1px solid #404040; text-align: center; vertical-align: center; font-weight: bold">Masc.</th>
        @endforeach
            <th style="background-color: #F2F2F2; border: 1px solid #404040; text-align: center; vertical-align: center; font-weight: bold">Fem.</th>
            <th style="background-color: #F2F2F2; border: 1px solid #404040; text-align: center; vertical-align: center; font-weight: bold">Masc.</th>
            <th style="background-color: #F2F2F2; border: 1px solid #404040; text-align: center; vertical-align: center; font-weight: bold">TOTAL</th>
    </tr>
    </thead>
    <tbody>
    @foreach($deportes as $row)
        @if($row->proceso != $proceso)
            @continue
        @endif
        <tr>
            <td style="border: 1px solid #404040; vertical-align: center; text-align: center;">{{ ++$i }}</td>
            <td style="border: 1px solid #404040; vertical-align: center;">
                {{ \Illuminate\Support\Str::upper($row->deporte->deporte) }} -
                {{ \Illuminate\Support\Str::upper($row->categoria) }}</td>
            @foreach($clubes as $club)
                @php

                    $fem = '';
                    $masc = '';

                    $datos = \App\Models\ParticipacionDisciplina::where('proceso', $proceso)->where('id_entidad', $club->id)->where('id_deporte_oficial', $row->id)->first();
                    if ($datos){
                        if ($datos->femenino){
                            $fem = $datos->femenino;
                        }
                        if ($datos->masculino){
                            $masc = $datos->masculino;
                        }
                    }

                @endphp
                <td style="border: 1px solid #404040; vertical-align: center; text-align: center;">{{ $fem }}</td>
                <td style="border: 1px solid #404040; vertical-align: center; text-align: center;">{{ $masc }}</td>
            @endforeach
            @php
                $femenino = \App\Models\ParticipacionDisciplina::where('proceso', $proceso)->where('id_deporte_oficial', $row->id)->sum('femenino');
                $masculino = \App\Models\ParticipacionDisciplina::where('proceso', $proceso)->where('id_deporte_oficial', $row->id)->sum('masculino');
                $totalFemenino = $totalFemenino + $femenino;
                $totalMasculino = $totalMasculino + $masculino;
            @endphp
            <td style="border: 1px solid #404040; vertical-align: center; text-align: center;">{{ $femenino }}</td>
            <td style="border: 1px solid #404040; vertical-align: center; text-align: center;">{{ $masculino }}</td>
            <td style="border: 1px solid #404040; vertical-align: center; text-align: center; font-weight: bold;">{{ $femenino + $masculino }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="2" style="border: 1px solid #404040; vertical-align: center; text-align: center; font-weight: bold;">TOTALES</td>
        @foreach($clubes as $club)
            @php
                $femenino = \App\Models\ParticipacionDisciplina::where('proceso', $proceso)->where('id_entidad', $club->id)->sum('femenino');
                $masculino = \App\Models\ParticipacionDisciplina::where('proceso', $proceso)->where('id_entidad', $club->id)->sum('masculino');
            @endphp
            <td style="border: 1px solid #404040; vertical-align: center; text-align: center; font-weight: bold;">{{ $femenino }}</td>
            <td style="border: 1px solid #404040; vertical-align: center; text-align: center; font-weight: bold;">{{ $masculino }}</td>
        @endforeach
        <td style="border: 1px solid #404040; vertical-align: center; text-align: center; font-weight: bold;">{{ $totalFemenino }}</td>
        <td style="border: 1px solid #404040; vertical-align: center; text-align: center; font-weight: bold;">{{ $totalMasculino }}</td>
        <td style="border: 1px solid #404040; vertical-align: center; text-align: center; font-weight: bold;">{{ $totalFemenino + $totalMasculino }}</td>
    </tr>
    </tbody>
</table>
