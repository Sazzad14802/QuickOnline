<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public function index(Request $request){
        $query = "SELECT s.subscription_id, u.name, u.email, p.package_name
            FROM subscriptions s
            JOIN users u ON s.user_id = u.id
            JOIN packages p ON s.package_id = p.package_id
            WHERE 1=1";
            
        $bindings = [];

        if ($request->filled('email')) {
            $query .= " AND u.email LIKE ?";
            $bindings[] = '%' . $request->input('email') . '%';
        }

        if ($request->filled('package')) {
            $query .= " AND p.package_name LIKE ?";
            $bindings[] = '%' . $request->input('package') . '%';
        }

        $subscriptions = DB::select($query, $bindings);
        return view('admin.subscriptions', ['subscriptions' => $subscriptions]);
    }
    public function remove($subscription_id){
        
        DB::delete("DELETE FROM subscriptions WHERE subscription_id = ?", [$subscription_id]);
        return redirect()->route('admin.subscriptions.index')->with('success','Subscription removed');
    }
}
