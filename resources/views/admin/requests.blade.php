<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Requests
    </h2>
</x-slot>

<div class="container">

    <br><br>

    <table class="table table-bordered">
        <tr>
            <th>User email</th>
            <th>Subscription ID</th>
            <th>Current Package</th>
            <th>New Package</th>
            <th>Request Type</th>
            <th>Actions</th>
        </tr>

        @foreach ($requests as $request)
            <tr>
                <td>{{ $request->email }}</td>
                <td>{{ $request->subscription_id ?? 'N/A' }}</td>
                <td>{{ $request->current_package_name ?? 'N/A' }}</td>
                <td>{{ $request->new_package_name ?? 'N/A' }}</td>
                <td>{{ $request->request_type }}</td>   
                <td>
                    <form action="{{ route('admin.requests.approve', $request->request_id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to approve this request?')">Approve</button>
                    </form>|
                    <form action="{{ route('admin.requests.reject', $request->request_id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to reject this request?')">Reject</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>

</x-app-layout>