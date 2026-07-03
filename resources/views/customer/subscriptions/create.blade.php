<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Request for new subscription
    </h2>
</x-slot>

<div class="container">

    <br><br>

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
                <td>
                    <form action="{{ route('customer.subscriptions.store_new_request') }}" method="POST">
                        @csrf
                        <input type="hidden" name="package_id" value="{{ $package->package_id }}">
                        <button type="submit" class="btn btn-success"> Subscribe </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>

</x-app-layout>