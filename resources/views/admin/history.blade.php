<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Subscription History
    </h2>
</x-slot>

<div class="container">
    <br><br>
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
