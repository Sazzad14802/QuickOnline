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