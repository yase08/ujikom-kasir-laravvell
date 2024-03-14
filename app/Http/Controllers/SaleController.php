<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DetailSale;
use App\Models\Product;
use App\Models\Sale;
use Exception;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $sales = Sale::all();
        $products = Product::where('stock', '>', 0)->get();

        return view('pages.sale.index', compact('sales', 'products'));
    }

    public function detail()
    {
        $detailSales = DetailSale::all();

        return view('pages.detail_sale.index', compact('detailSales'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required',
                'phone' => 'required',
            ]);

            $totalPrice = 0;
            foreach ($request->products as $productId) {
                $product = Product::findOrFail($productId);
                $index = array_search($productId, $request->products);
                $totalPrice += $product->price * $request->quantities[$index];
            }

            $newCustomer = Customer::create([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);

            $newSale = Sale::create([
                'customer_id' => $newCustomer->id,
                'sale_date' => date('Y-m-d'),
                'total_price' => $totalPrice,
            ]);

            foreach ($request->products as $productId) {
                $product = Product::findOrFail($productId);
                $product->update([
                    'stock' => $product->stock - $request->quantities[array_search($productId, $request->products)],
                ]);
            }

            foreach ($request->products as $productId) {
                $product = Product::findOrFail($productId);
                DetailSale::create([
                    'sale_id' => $newSale->id,
                    'product_id' => $product->id,
                    'total_products' => $request->quantities[array_search($productId, $request->products)],
                    'subtotal' => $product->price * $request->quantities[array_search($productId, $request->products)],
                ]);
            }

            return redirect('/dashboard/detail-sale')->with('success', 'Sale created successfully');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function edit($id)
    {
        $sale = Sale::find($id);
        return view('pages.sale.edit', compact('sale'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        $sale = Sale::find($id);

        $sale->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect('/dashboard/sale')->with('success', 'Sale updated successfully');
    }

    public function destroy($id)
    {
        $sale = DetailSale::find($id);
        $sale->delete();

        return back()->with('success', 'Sale deleted successfully');
    }
}
