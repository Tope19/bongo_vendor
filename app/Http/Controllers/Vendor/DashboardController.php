<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Referral;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Constants\AppConstants;
use App\Models\ServiceProvider;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('dashboard.index');
    }

}
