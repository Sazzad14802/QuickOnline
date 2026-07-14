<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        $bill = DB::selectOne("
            SELECT subscription_count, total_cost, discount, net_bill 
            FROM bills WHERE user_id = ?
        ", [$userId]);
        
        return view('customer.dashboard', [
            'total_subscriptions' => $bill ? $bill->subscription_count : 0,
            'total_cost' => $bill ? $bill->total_cost : 0,
            'discount' => $bill ? $bill->discount : 0,
            'net_bill' => $bill ? $bill->net_bill : 0
        ]);
    }
}
