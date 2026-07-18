<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = "
            SELECT h.history_id, u.name as user_name, u.email as user_email, 
                   op.package_name as old_package_name, 
                   np.package_name as new_package_name, 
                   h.type,
                   h.processed_at
            FROM subscription_history h
            LEFT JOIN users u ON h.user_id = u.id
            LEFT JOIN packages op ON h.old_package_id = op.package_id
            LEFT JOIN packages np ON h.new_package_id = np.package_id
            WHERE 1=1
        ";

        $bindings = [];

        if ($request->filled('email')) {
            $query .= " AND u.email LIKE ?";
            $bindings[] = '%' . $request->input('email') . '%';
        }

        if ($request->filled('old_package')) {
            $query .= " AND op.package_name LIKE ?";
            $bindings[] = '%' . $request->input('old_package') . '%';
        }

        if ($request->filled('new_package')) {
            $query .= " AND np.package_name LIKE ?";
            $bindings[] = '%' . $request->input('new_package') . '%';
        }

        if ($request->filled('type')) {
            $query .= " AND h.type = ?";
            $bindings[] = $request->input('type');
        }

        $query .= " ORDER BY h.processed_at DESC";

        $histories = DB::select($query, $bindings);

        return view('admin.history', ['histories' => $histories]);
    }
}
