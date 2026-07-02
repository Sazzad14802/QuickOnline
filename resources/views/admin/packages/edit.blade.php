<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Package
    </h2>
</x-slot>

<div class="container mt-4">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">
                    <h4>Package details</h4>
                </div>

                <div class="card-body">

                    <!-- Form -->
                    <form method="POST" action="{{ route('admin.packages.update', $package->package_id) }}">
                        @csrf
                        @method('PUT')
                        <label>Package Name</label>
                        <input type="text" name="package_name" class="form-control" value="{{ $package->package_name }}" required><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Download Speed (Mbps)</label>
                                <input type="number" name="download_speed" class="form-control" value="{{ $package->download_speed }}" min="1" required><br>
                            </div>
                            <div class="col-md-6">
                                <label>Upload Speed (Mbps)</label><br>
                                <input type="number" name="upload_speed" class="form-control" value="{{ $package->upload_speed }}" min="1" required><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Connection Type</label>
                                <select name="connection_type" class="form-select" required>
                                    <option value="fiber" {{ $package->connection_type == 'fiber' ? 'selected' : '' }}>Fiber</option>
                                    <option value="wireless" {{ $package->connection_type == 'wireless' ? 'selected' : '' }}>Wireless</option>
                                    <option value="copper" {{ $package->connection_type == 'copper' ? 'selected' : '' }}>Copper</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>IP Type</label>
                                <select name="ip_type" class="form-select" required>
                                    <option value="shared" {{ $package->ip_type == 'shared' ? 'selected' : '' }}>Shared</option>
                                    <option value="dedicated" {{ $package->ip_type == 'dedicated' ? 'selected' : '' }}>Dedicated</option>
                                </select>
                            </div>
                        </div>
                        <br>
                    
                        <label>Price</label>
                        <input type="number" name="price" class="form-control" value="{{ $package->price }}" required> <br><br>
                    
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>

                </div>

            </div>

        </div>

    </div>

</div>





</x-app-layout>