<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmailsLogController extends Controller
{
    public function index()
    {
        $emails = DB::table('emails_log')->get();
        return view('index', compact('emails'));
    }

    public function delete(Request $request, $id)
    {
        try {
            DB::table('emails_log')->where('id', $id)->delete();
            return back()->with('success', 'Email deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Sorry! Please try again latter');
        }
    }
}
