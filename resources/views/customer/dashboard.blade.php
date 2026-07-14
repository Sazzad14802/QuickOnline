<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<div class="container-fluid py-5">
    <div class="row g-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card bg-primary text-white h-100 shadow border-0">
                <div class="card-body p-4">
                    <h5 class="card-title text-uppercase fw-bold opacity-75 small">Active Subscriptions</h5>
                    <h2 class="display-5 fw-bold mb-0">{{ $total_subscriptions }}</h2>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card bg-secondary text-white h-100 shadow border-0">
                <div class="card-body p-4">
                    <h5 class="card-title text-uppercase fw-bold opacity-75 small">Total Cost</h5>
                    <h2 class="display-5 fw-bold mb-0">৳{{ number_format($total_cost, 2) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card bg-success text-white h-100 shadow border-0">
                <div class="card-body p-4">
                    <h5 class="card-title text-uppercase fw-bold opacity-75 small">Discount</h5>
                    <h2 class="display-5 fw-bold mb-0">৳{{ number_format($discount, 2) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card bg-info text-dark h-100 shadow border-0">
                <div class="card-body p-4">
                    <h5 class="card-title text-uppercase fw-bold opacity-75 small">Net Bill</h5>
                    <h2 class="display-5 fw-bold mb-0">৳{{ number_format($net_bill, 2) }}</h2>
                </div>
            </div>
        </div>

    </div>
</div>
</x-app-layout>
