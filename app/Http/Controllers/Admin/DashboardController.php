<?php

namespace App\Http\Controllers\Admin;

use App\Models\TestResult;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $title = 'dashboard';
        $user_test_results_count = TestResult::whereHas('appointment', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->count();
        return view('admin.dashboard',compact(
            'title','user_test_results_count'
        ));
    }
}
