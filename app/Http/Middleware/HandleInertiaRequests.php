<?php

namespace App\Http\Middleware;

use App\Models\Unit;
use App\Models\Discount;
use App\Models\Dropdown;
use App\Models\Customer;
use App\Models\SupplierBranch;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Http\Resources\UserResource;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => (\Auth::check()) ? new UserResource(\Auth::user()) : '',
            'flash' => [
                'message' => session('message'),
                'data' => session('data'),
                'type' => session('type'),
                'color' => session('color')
            ],
            'categories' => Category::all(),
            'suppliers' => SupplierBranch::with('supplier')->where('is_active',1)->get(),
            'units' => Unit::all(),
            'dropdowns' => Dropdown::all(),
            'products' => Product::all(),
            'customers' => Customer::all(),
            'discounts' => Discount::all()
        ]);
    }
}
