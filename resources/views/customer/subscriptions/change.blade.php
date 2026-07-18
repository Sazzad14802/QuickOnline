<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Change subscription
    </h2>
</x-slot>


<div class="container">
    <div class="card mb-4 mt-3">
        <div class="card-header">
            <strong>Current Subscription</strong>
        </div>

        <div class="card-body">
            <p><strong>Package:</strong> {{ $subscription->package_name }}</p>
            <p><strong>Speed:</strong> {{ $subscription->download_speed }} / {{ $subscription->upload_speed }} Mbps</p>
            <p><strong>Connection:</strong> {{ ucfirst($subscription->connection_type) }}</p>
            <p><strong>IP Type:</strong> {{ ucfirst($subscription->ip_type) }}</p>
            <p><strong>Price:</strong> ৳{{ $subscription->price }}</p>
        </div>
    </div>

    <form method="GET" action="{{ route('customer.subscriptions.change', $subscription->subscription_id) }}" class="mb-4">
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
                <a href="{{ route('customer.subscriptions.change', $subscription->subscription_id) }}" class="btn btn-secondary w-100">Clear</a>
            </div>
        </div>
    </form>

    <div class="mb-3 text-muted">
        <strong>Showing {{ count($packages) }} {{ Str::plural('row', count($packages)) }}</strong>
    </div>

    <table class="table table-bordered">
        <strong>Change into :</strong>
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
                    <form action="{{ route('customer.subscriptions.store_change_request') }}" method="POST">
                        @csrf
                        <input type="hidden" name="subscription_id" value="{{ $subscription->subscription_id }}">
                        <input type="hidden" name="current_package_id" value="{{ $subscription->package_id }}">
                        <input type="hidden" name="new_package_id" value="{{ $package->package_id }}">
                        <button type="submit" class="btn btn-success">Request Change</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
</x-app-layout>