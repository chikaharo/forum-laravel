<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrdersResource;
use App\Models\Order;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    // Gate::before(function (User $user, string $ability) {
    //     if ($user->isAdministrator()) {
    //         return true;
    //     }
    // });

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['priceFrom', 'priceTo', 'beds', 'baths']);
        $query = Order::latest()->filter($filters);


        // if($filters['priceFrom'] ?? false) {
        //     $query->where('price', '>=', $filters['priceFrom']);
        // }
        // if($filters['priceTo'] ?? false) {
        //     $query->where('price', '<=', $filters['priceTo']);
        // }
        // if($filters['beds'] ?? false) {
        //     $query->where('beds', (int)$filters['beds'] < 6 ? '=' : '>=', $filters['beds']);
        // }
        // if($filters['baths'] ?? false) {
        //     $query->where('baths',  (int)$filters['baths'] < 6 ? '=' : '>=', $filters['baths']);
        // }
        return Inertia::render('Order/Index', [
            'filters' => $filters,
            'orders' => OrdersResource::collection($query->paginate(10)->withQueryString())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return Inertia::render('Order/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->user()->orders()->create(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|min:1|max:1000',
                'price' => 'required|min:1|max:2000000',
            ])
            );

        return redirect('/orders')->with('success', 'Order created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
        return Inertia::render('Order/Show', [
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
