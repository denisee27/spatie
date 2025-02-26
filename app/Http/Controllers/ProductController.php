<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index(){
        $data = Product::all();
        $categories = Category::all();
        $parse = [
            'datas' => $data,
            'categories' => $categories,
        ];

        return view('product',$parse);
    }
    
    public function create(Request $request){
        $item = new Product();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->save();

        if ($request->has('categories')) {
            foreach ($request->categories as $categoryId) {
                $productHelper = new CategoryProduct();
                $productHelper->product_id = $item->id;
                $productHelper->category_id = $categoryId;
                $productHelper->save();
            }
        }
        Alert::success('Berhasil', 'Data berhasil di tambahkan');
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();

        
        $product->categories()->sync($request->categories);

        Alert::success('Berhasil', 'Data berhasil di update');
        return back();
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->categories()->detach();

        
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully');
    }


}
