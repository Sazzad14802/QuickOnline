<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Requests
    </h2>
</x-slot>

<div class="container">

    <br><br>

    <form method="GET" action="{{ route('admin.requests.index') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="email" class="form-control" placeholder="Search by Email" value="{{ request('email') }}">
            </div>
            <div class="col-md-4">
                <select name="type" class="form-select">
                    <option value="">All Request Types</option>
                    <option value="new" {{ request('type') == 'new' ? 'selected' : '' }}>New</option>
                    <option value="change" {{ request('type') == 'change' ? 'selected' : '' }}>Change</option>
                    <option value="unsubscribe" {{ request('type') == 'unsubscribe' ? 'selected' : '' }}>Unsubscribe</option>
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
                <a href="{{ route('admin.requests.index') }}" class="btn btn-secondary w-100">Clear</a>
            </div>
        </div>
    </form>

    <div class="mb-3 text-muted">
        <strong>Showing {{ count($requests) }} {{ Str::plural('row', count($requests)) }}</strong>
    </div>

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