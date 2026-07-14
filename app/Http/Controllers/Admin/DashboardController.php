<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totals = DB::selectOne("
            SELECT SUM(subscription_count) as total_subscriptions, 
                   SUM(total_cost) as total_revenue,
                   SUM(discount) as total_discount,
                   SUM(net_bill) as net_revenue
            FROM bills
        ");
        
        return view('admin.dashboard', [
            'total_subscriptions' => $totals->total_subscriptions,
            'total_revenue' => $totals->total_revenue,
            'total_discount' => $totals->total_discount,
            'net_revenue' => $totals->net_revenue
        ]);
    }
}
