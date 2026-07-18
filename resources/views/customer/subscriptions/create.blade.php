<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Request for new subscription
    </h2>
</x-slot>

<div class="container">

    <br><br>

    <form method="GET" action="{{ route('customer.subscriptions.create') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-2">
                <input type="number" name="min_download" class="form-control" placeholder="Min Download" value="{{ request('min_download') }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="min_upload" class="form-control" placeholder="Min Upload" value="{{ request('min_upload') }}">
            </div>
            <div class="col-md-2">
                <select name="ip_type" class="form-select">
                    <option value="">Any IP Type</option>
                    <option value="shared" {{ request('ip_type') == 'shared' ? 'selected' : '' }}>Shared</option>
                    <option value="dedicated" {{ request('ip_type') == 'dedicated' ? 'selected' : '' }}>Dedicated</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="min_price" class="form-control" placeholder="Min Price" value="{{ request('min_price') }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="max_price" class="form-control" placeholder="Max Price" value="{{ request('max_price') }}">
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
                <a href="{{ route('customer.subscriptions.create') }}" class="btn btn-secondary w-100">Clear</a>
            </div>
        </div>
    </form>

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