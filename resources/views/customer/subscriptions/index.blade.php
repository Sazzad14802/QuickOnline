<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        My Subscriptions
    </h2>
</x-slot>

<div class="container">

    <a href="{{ route('customer.subscriptions.create') }}" class="btn btn-primary mt-2"> Request New Subscription </a>

    <br><br>

    <div class="mb-3 text-muted">
        <strong>Showing {{ count($subscriptions) }} {{ Str::plural('row', count($subscriptions)) }}</strong>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Subscription ID</th>
            <th>Name</th>
            <th>Speed (Down/Up)</th>
            <th>Connection</th>
            <th>IP Type</th>
            <th>Price</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        @foreach ($subscriptions as $subscription)
            <tr>
                <td>{{ $subscription->subscription_id }}</td>
                <td>{{ $subscription->package_name }}</td>
                <td>{{ $subscription->download_speed }} / {{ $subscription->upload_speed }} Mbps</td>
                <td>{{ $subscription->connection_type }}</td>
                <td>{{ $subscription->ip_type }}</td>
                <td>{{ $subscription->price }}</td>
                <td>{{ $subscription->status }}</td>
                <td><a href="{{ route('customer.subscriptions.change', $subscription->subscription_id) }}" class="btn btn-success">Change</a> 
                    |
                    <form action="{{ route('customer.subscriptions.destroy', $subscription->subscription_id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to unsubscribe?')">Unsubscribe</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>

</x-app-layout>