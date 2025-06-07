<?php

namespace App\Http\Controllers\Vendor;

use App\Models\User;
use App\Models\Order;
use App\Models\Visitor;
use App\Models\Referral;
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
        $user = auth()->user();
        $userId = $user->id;
        $pendingProducts = $user->products()->where('status', 0)->count();
        $approvedProducts = $user->products()->where('status', 1)->count();
        // $totalCompletedOrders = Order::where('status', 'Completed')
        //     ->whereHas('items.product.product', function ($query) use ($userId) {
        //         $query->where('user_id', $userId);
        //     })
        //     ->distinct('orders.id') // count only unique orders
        //     ->count();

        $totalCompletedOrders = Order::whereHas('items.product.product', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->distinct('orders.id') // count only unique orders
            ->count();

        $orders = Order::with(['user', 'items.product'])
            ->whereHas('items.product.product', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->latest()->get();
        return view('dashboard.index', compact('pendingProducts', 'approvedProducts', 'orders', 'totalCompletedOrders'));
    }

}
