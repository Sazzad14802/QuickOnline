<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    public function index()
    {
        $packages = DB::select(" SELECT * FROM packages ORDER BY price");
        return view('admin.packages.index', ['packages' => $packages]);
    }


    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        DB::insert(
            "INSERT INTO packages(package_name, download_speed, upload_speed, connection_type, ip_type, price) VALUES (?,?,?,?,?,?)",
            [$request->package_name, $request->download_speed, $request->upload_speed, $request->connection_type, $request->ip_type, $request->price]
        );

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully.');
    }

    public function edit($id)
    {
        $package = DB::selectOne(
            "SELECT * FROM packages WHERE package_id = ?",
            [$id]
        );

        return view('admin.packages.edit', ['package' => $package]);
    }
    public function update(Request $request, $id)
    {
        DB::update(
            "UPDATE packages SET package_name = ?, download_speed = ?, upload_speed = ?, connection_type = ?, ip_type = ?, price = ? WHERE package_id = ?",
            [$request->package_name, $request->download_speed, $request->upload_speed, $request->connection_type, $request->ip_type, $request->price, $id]
        );

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }
    public function destroy($id)
    {
        DB::delete(
            "DELETE FROM packages WHERE package_id = ?",
            [$id]
        );

        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully.');
    }
}
