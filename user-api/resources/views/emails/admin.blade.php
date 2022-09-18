Correo de notificaion al admin sobre la cantidad de usuarios registrados por pais

<table border="1">
    <thead>
    <tr>
        <td>Nombre del Pais</td>
        <td>Cantidad de ususarios</td>
    </tr>
    </thead>
    <tbody>
    @foreach ($count_customer as $county_count)
        <tr>
            <td>{{ $county_count->country }}</td>
            <td>{{ $county_count->total_users }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
