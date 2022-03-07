<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard()
    {
        checkPermission('view_dashboard');
        
        return view('pages.admin.dashboard');
    }
}
