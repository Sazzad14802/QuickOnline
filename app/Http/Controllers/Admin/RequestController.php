<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    public function index()
    {
        $requests = DB::select(" SELECT r.request_id, u.email, r.request_type, r.subscription_id,
            cp.package_name AS current_package_name, np.package_name AS new_package_name
            FROM requests r
            JOIN users u ON r.user_id = u.id
            LEFT JOIN subscriptions s ON r.subscription_id = s.subscription_id
            LEFT JOIN packages cp ON s.package_id = cp.package_id
            LEFT JOIN packages np ON r.new_package_id = np.package_id");
        return view('admin.requests', ['requests' => $requests]);
    }

    public function approve($request_id)
    {
        DB::statement("BEGIN approve_request(?); END;", [$request_id]);

        return redirect()->route('admin.requests.index')->with('success', 'Request approved');
    }

    public function reject($request_id)
    {
        DB::delete(" DELETE FROM requests WHERE request_id = ? ", [$request_id]);
        return redirect()->route('admin.requests.index')->with('success', 'Request rejected');
    }
}
