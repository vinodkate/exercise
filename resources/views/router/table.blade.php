<table class="table table-hover table-responsive-lg">
    <thead>
        <tr>
        <th scope="col">Id</th>
        <th scope="col">SapId</th>
        <th scope="col">Type</th>
        <th scope="col">Hostname</th>
        <th scope="col">Loopback</th>
        <th scope="col">Mac Address</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($routers as $router)
        <tr>
            <th scope="row">{{ $router->id }}</th>
            <td>{{ $router->sap_id }}</td>
            <td>{{ $router->type }}</td>
            <td>{{ $router->host_name }}</td>
            <td>{{ $router->loopback }}</td>
            <td>{{ $router->mac_address }}</td>
            <td><button type="button" class="btn btn-secondary edit" id="edit" data-url="{{ route('router.edit', $router->id) }}">Edit</button></td>
            <td><button type="button" class="btn btn-danger delete" id="delete" data-url="{{ route('router.destroy', $router->id) }}">Delete</button></td>
        </tr>  
        @endforeach
    </tbody>
</table>
