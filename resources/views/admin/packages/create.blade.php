<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create Package
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
                    <form method="POST" action="{{ route('admin.packages.store') }}">
                        @csrf
                    
                        <label>Package Name</label>
                        <input type="text" name="package_name" class="form-control" required><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Download Speed (Mbps)</label>
                                <input type="number" name="download_speed" class="form-control" min="1" required><br>
                            </div>
                            <div class="col-md-6">
                                <label>Upload Speed (Mbps)</label><br>
                                <input type="number" name="upload_speed" class="form-control" min="1" required><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Connection Type</label>
                                <select name="connection_type" class="form-select" required>
                                    <option value="">-- Select Connection Type --</option>
                                    <option value="fiber">Fiber</option>
                                    <option value="wireless">Wireless</option>
                                    <option value="copper">Copper</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>IP Type</label>
                                <select name="ip_type" class="form-select" required>
                                    <option value="">-- Select IP Type --</option>
                                    <option value="shared">Shared</option>
                                    <option value="dedicated">Dedicated</option>
                                </select>
                            </div>
                        </div>
                        <br>
                    
                        <label>Price</label>
                        <input type="number" name="price" class="form-control" required> <br><br>
                    
                        <button type="submit" class="btn btn-success">Create</button>
                        <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>

                </div>

            </div>

        </div>

    </div>

</div>





</x-app-layout>