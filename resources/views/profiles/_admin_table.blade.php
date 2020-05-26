<table id="adminTable" class="table tablesorter table-responsive m-auto">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">NOMBRE</th>
        <th scope="col">EMAIL</th>
        <th scope="col">FOTO PERFIL</th>
        <th scope="col">DESCRIPCIÓN</th>
        <th scope="col">REMEMBER TOKEN</th>
        <th scope="col">CREACIÓN</th>
        <th scope="col">ÚLTIMA ACTUALIZACIÓN</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
    <tr>
        <td scope="row">{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->profile_picture }}</td>
        <td>{{ $user->description }}</td>
        <td>{{ $user->remember_token }}</td>
        <td>{{ $user->created_at }}</td>
        <td>{{ $user->updated_at }}</td>
        <td><button class="btn-danger">ELIMINAR</button></td>
    </tr>
    @endforeach
    </tbody>
</table>
