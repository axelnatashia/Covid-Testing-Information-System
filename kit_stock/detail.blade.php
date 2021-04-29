<div class="table-responsive">
    <table class="table">
        <tr>
            <td scope="row">Code</td>
            <td>{{ $data->code }}</td>
        </tr>
        <tr>
            <td scope="row">Name</td>
            <td>{{ $data->name }}</td>
        </tr>
        <tr>
            <td scope="row">Stock</td>
            <td>{{ $data->stock }}</td>
        </tr>
        <tr>
            <td scope="row">Made</td>
            <td>{{ $data->created_at }}</td>
        </tr>
        <tr>
            <td scope="row">Updated</td>
            <td>{{ $data->updated_at }}</td>
        </tr>
    </table>
</div>
