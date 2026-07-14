<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = DB::select("
            SELECT h.history_id, u.name as user_name, u.email as user_email, 
                   op.package_name as old_package_name, 
                   np.package_name as new_package_name, 
                   h.type,
                   h.processed_at
            FROM subscription_history h
            LEFT JOIN users u ON h.user_id = u.id
            LEFT JOIN packages op ON h.old_package_id = op.package_id
            LEFT JOIN packages np ON h.new_package_id = np.package_id
            ORDER BY h.processed_at DESC
        ");

        return view('admin.history', ['histories' => $histories]);
    }
}
