<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Subscriptions
    </h2>
</x-slot>

<div class="container">

    <br><br>

    <table class="table table-bordered">
        <tr>
            <th>Subscription ID</th>
            <th>User name</th>
            <th>User email</th>
            <th>Package</th>
            <th>Action</th>
        </tr>

        @foreach ($subscriptions as $subscription)
            <tr>
                <td>{{ $subscription->subscription_id }}</td>
                <td>{{ $subscription->name }}</td>
                <td>{{ $subscription->email }}</td>
                <td>{{ $subscription->package_name }}</td>
                <td>
                    <form action="{{ route('admin.subscriptions.remove', $subscription->subscription_id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to remove this subscription?')">Remove Subscription</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>

</x-app-layout>