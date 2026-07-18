<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Packages
    </h2>
</x-slot>

<div class="container">

    <a href="{{ route('admin.packages.create') }}" class="btn btn-primary mt-2"> Add New Package </a>

    <br><br>

    <div class="mb-3 text-muted">
        <strong>Showing {{ count($packages) }} {{ Str::plural('row', count($packages)) }}</strong>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Speed (Down/Up)</th>
            <th>Connection</th>
            <th>IP Type</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>

        @foreach ($packages as $package)
            <tr>
                <td>{{ $package->package_name }}</td>
                <td>{{ $package->download_speed }} / {{ $package->upload_speed }} Mbps</td>
                <td>{{ $package->connection_type }}</td>
                <td>{{ $package->ip_type }}</td>
                <td>{{ $package->price }}</td>
                <td><a href="{{ route('admin.packages.edit', $package->package_id) }}" class="btn btn-success">Edit</a> 
                    |
                    <form action="{{ route('admin.packages.destroy', $package->package_id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this package?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>

</x-app-layout>