<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public function index(){
        $subscriptions = DB::select("SELECT s.subscription_id, u.name, u.email, p.package_name
            FROM subscriptions s
            JOIN users u ON s.user_id = u.id
            JOIN packages p ON s.package_id = p.package_id");
        return view('admin.subscriptions', ['subscriptions' => $subscriptions]);
    }
    public function remove($subscription_id){
        
        DB::delete("DELETE FROM subscriptions WHERE subscription_id = ?", [$subscription_id]);
        return redirect()->route('admin.subscriptions.index')->with('success','Subscription removed');
    }
}
