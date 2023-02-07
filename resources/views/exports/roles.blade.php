<table>
    <thead>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>direccion</th>
        <th>guard_name</th>
        <th>active</th>
        <th>created_at</th>
        <th>updated_at</th>
    </tr>
    </thead>
    <tbody>
    @foreach($roles as $rol)
        <tr>
            <td>{{ $rol->id }}</td>
            <td>{{ $rol->name }}</td>
            <td>{{ $rol->direccion }}</td>
            <td>{{ $rol->guard_name }}</td>
            <td>{{ $rol->active }}</td>
            <td>{{ $rol->created_at }}</td>
            <td>{{ $rol->updated_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>