<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = DB::select("SELECT * FROM subscriptions NATURAL JOIN packages WHERE user_id = ?", [Auth::id()]);
        return view('customer.subscriptions.index', ['subscriptions' => $subscriptions]);
    }

    public function create(Request $request){
        $query = "SELECT * FROM packages WHERE 1=1";
        $bindings = [];

        if ($request->filled('min_price')) {
            $query .= " AND price >= ?";
            $bindings[] = $request->input('min_price');
        }
        if ($request->filled('max_price')) {
            $query .= " AND price <= ?";
            $bindings[] = $request->input('max_price');
        }
        if ($request->filled('min_download')) {
            $query .= " AND download_speed >= ?";
            $bindings[] = $request->input('min_download');
        }
        if ($request->filled('min_upload')) {
            $query .= " AND upload_speed >= ?";
            $bindings[] = $request->input('min_upload');
        }
        if ($request->filled('ip_type')) {
            $query .= " AND ip_type = ?";
            $bindings[] = $request->input('ip_type');
        }

        $query .= " ORDER BY price ASC";

        $packages = DB::select($query, $bindings);
        return view('customer.subscriptions.create', ['packages' => $packages]);
    }

    public function store_new_request(Request $request){
        $package_id = $request->input('package_id');
        $pending = DB::selectOne("SELECT * FROM requests WHERE user_id = ? AND new_package_id = ? AND request_type = 'new'", [Auth::id(), $package_id]);
        if ($pending) {
            return redirect()->route('customer.subscriptions.index')->with('error', 'Request for this package is already pending');
        }
        DB::insert("INSERT INTO requests (user_id, new_package_id, request_type) VALUES (?, ?, ?)", [Auth::id(), $package_id,'new']);
        return redirect()->route('customer.subscriptions.index')->with('success', 'Subscription requested');
    }
    
    public function change(Request $request,$subscription_id){
        
        $subscription = DB::selectOne("SELECT * FROM subscriptions NATURAL JOIN packages WHERE subscription_id = ?", [$subscription_id]);
        
        $query = "SELECT * FROM packages WHERE package_id <> ?";
        $bindings = [$subscription->package_id];

        if ($request->filled('min_download')) {
            $query .= " AND download_speed >= ?";
            $bindings[] = $request->input('min_download');
        }
        if ($request->filled('min_upload')) {
            $query .= " AND upload_speed >= ?";
            $bindings[] = $request->input('min_upload');
        }
        if ($request->filled('ip_type')) {
            $query .= " AND ip_type = ?";
            $bindings[] = $request->input('ip_type');
        }
        if ($request->filled('min_price')) {
            $query .= " AND price >= ?";
            $bindings[] = $request->input('min_price');
        }
        if ($request->filled('max_price')) {
            $query .= " AND price <= ?";
            $bindings[] = $request->input('max_price');
        }

        $query .= " ORDER BY price ASC";

        $packages = DB::select($query, $bindings);
        return view('customer.subscriptions.change', ['subscription' => $subscription,'packages' => $packages]);
    }
    
    public function store_change_request(Request $request){
        $new_package_id = $request->input('new_package_id');
        $subscription_id = $request->input('subscription_id');

        $pending = DB::selectOne("SELECT * FROM requests WHERE subscription_id = ?", [$subscription_id]);
        if ($pending) {
            DB::update("UPDATE requests SET new_package_id = ?, request_type = 'change' WHERE request_id = ?", [$new_package_id, $pending->request_id]);
            return redirect()->route('customer.subscriptions.index')->with('warning', 'Request overwritten');
        }
        DB::insert("INSERT INTO requests (user_id, new_package_id, subscription_id, request_type) VALUES (?, ?, ?, ?)", [Auth::id(), $new_package_id, $subscription_id, 'change']);
        return redirect()->route('customer.subscriptions.index')->with('success', 'Subscription change requested');
    }

    public function destroy($subscription_id){
        $pending = DB::selectOne("SELECT * FROM requests WHERE subscription_id = ?", [$subscription_id]);
        if ($pending) {
            DB::update("UPDATE requests SET request_type = 'unsubscribe',new_package_id = NULL WHERE request_id = ?", [$pending->request_id]);
            return redirect()->route('customer.subscriptions.index')->with('warning', 'Request overwritten');
        }
        DB::insert("INSERT INTO requests (user_id, subscription_id, request_type) VALUES (?, ?, ?)", [Auth::id(), $subscription_id,'unsubscribe']);
        return redirect()->route('customer.subscriptions.index')->with('success', 'Subscription delete requested');
    }

}
