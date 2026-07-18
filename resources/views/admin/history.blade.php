<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Subscription History
    </h2>
</x-slot>

<div class="container">
    <br><br>

    <form method="GET" action="{{ route('admin.history.index') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-2">
                <input type="text" name="email" class="form-control" placeholder="Email" value="{{ request('email') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="old_package" class="form-control" placeholder="Old Package" value="{{ request('old_package') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="new_package" class="form-control" placeholder="New Package" value="{{ request('new_package') }}">
            </div>
            <div class="col-md-2">
                <select name="type" class="form-select">
                    <option value="">All Types</option>
                    <option value="new" {{ request('type') == 'new' ? 'selected' : '' }}>New</option>
                    <option value="change" {{ request('type') == 'change' ? 'selected' : '' }}>Change</option>
                    <option value="unsubscribe" {{ request('type') == 'unsubscribe' ? 'selected' : '' }}>Unsubscribe</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
                <a href="{{ route('admin.history.index') }}" class="btn btn-secondary w-100">Clear</a>
            </div>
        </div>
    </form>

    <div class="mb-3 text-muted">
        <strong>Showing {{ count($histories) }} {{ Str::plural('row', count($histories)) }}</strong>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>User</th>
            <th>Email</th>
            <th>Old Package</th>
            <th>New Package</th>
            <th>Type</th>
            <th>Processed At</th>
        </tr>

        @foreach ($histories as $history)
            <tr>
                <td>{{ $history->user_name ?? 'N/A' }}</td>
                <td>{{ $history->user_email ?? 'N/A' }}</td>
                <td>{{ $history->old_package_name ?? 'N/A' }}</td>
                <td>{{ $history->new_package_name ?? 'N/A' }}</td>
                <td>{{ $history->type ?? 'N/A' }}</td>
                <td>{{ $history->processed_at }}</td>
            </tr>
        @endforeach
    </table>
</div>

</x-app-layout>
