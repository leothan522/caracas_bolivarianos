<table>
    <thead>
    <tr>
        <th rowspan="2" style="background-color: #F2F2F2; border: 1px solid #404040; text-align: center; vertical-align: center; font-weight: bold">Nº</th>
        <th rowspan="2" style="background-color: #F2F2F2; border: 1px solid #404040; text-align: center; vertical-align: center; font-weight: bold">DEPORTES - MODALIDAD</th>
        <th colspan="3" style="background-color: #F2F2F2; border: 1px solid #404040; text-align: center; vertical-align: center; font-weight: bold">CLUBES</th>
        <th colspan="2" style="background-color: #F2F2F2; border: 1px solid #404040; text-align: center; vertical-align: center; font-weight: bold">QUORUM</th>
    </tr>
    <tr>
        <th style="background-color: #F2F2F2; border: 1px solid #404040; text-align: center; vertical-align: center; font-weight: bold">Fem.</th>
        <th style="background-color: #F2F2F2; border: 1px solid #404040; text-align: center; vertical-align: center; font-weight: bold">Masc.</th>
        <th style="background-color: #F2F2F2; border: 1px solid #404040; text-align: center; vertical-align: center; font-weight: bold">TOTAL</th>
        <th style="background-color: #F2F2F2; border: 1px solid #404040; text-align: center; vertical-align: center; font-weight: bold">Fem.</th>
        <th style="background-color: #F2F2F2; border: 1px solid #404040; text-align: center; vertical-align: center; font-weight: bold">Masc.</th>
    </tr>
    </thead>
    <tbody>
    @foreach($deportes as $row)
        <tr>
            <td style="border: 1px solid #404040; vertical-align: center; text-align: center;">{{ ++$i }}</td>
            <td style="border: 1px solid #404040; vertical-align: center;">
                {{ \Illuminate\Support\Str::upper($row->deporte->deporte) }} -
                {{ \Illuminate\Support\Str::upper($row->modalidad) }}</td>
            @php
                $femenino = \App\Models\ParticipacionClub::where('id_modalidad', $row->id)->sum('num_atl_fem');
                $masculino = \App\Models\ParticipacionClub::where('id_modalidad', $row->id)->sum('num_atl_mas');
                $totalFemenino = $totalFemenino + $femenino;
                $totalMasculino = $totalMasculino + $masculino;
                $quorum_fem = $femenino < 4 ? 4 - $femenino : null;
                $quorum_masc = $masculino < 4 ? 4 - $masculino : null;
            @endphp
            <td style="border: 1px solid #404040; vertical-align: center; text-align: center; font-weight: bold;">{{ $femenino }}</td>
            <td style="border: 1px solid #404040; vertical-align: center; text-align: center; font-weight: bold;">{{ $masculino }}</td>
            <td style="border: 1px solid #404040; vertical-align: center; text-align: center; font-weight: bold;">{{ $femenino + $masculino }}</td>
            <td style="border: 1px solid #404040; vertical-align: center; text-align: center; font-weight: bold;">{{ $quorum_fem }}</td>
            <td style="border: 1px solid #404040; vertical-align: center; text-align: center; font-weight: bold;">{{ $quorum_masc }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="2" style="border: 1px solid #404040; vertical-align: center; text-align: center; font-weight: bold;">TOTALES</td>
        <td style="border: 1px solid #404040; vertical-align: center; text-align: center; font-weight: bold;">{{ $totalFemenino }}</td>
        <td style="border: 1px solid #404040; vertical-align: center; text-align: center; font-weight: bold;">{{ $totalMasculino }}</td>
        <td style="border: 1px solid #404040; vertical-align: center; text-align: center; font-weight: bold;">{{ $totalFemenino + $totalMasculino }}</td>
    </tr>
    </tbody>
</table>
