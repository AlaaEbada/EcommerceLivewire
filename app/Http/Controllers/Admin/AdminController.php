<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{


    public function view_product()
    {
        $product = Product::all();
        return view('dashboard.view_product', compact('product'));
    }

    public function show_product()
    {
        return view('dashboard.show_product' , [
            'category' => Category::all(),
        ]);
    }

    public function view_category()
    {
        if (Auth::guard('admin')->check()) { // التحقق من تسجيل دخول الأدمن
            $data = Category::all();
            return view('dashboard.view_category', compact('data'));
        } else {
            return redirect('admin/login')->with('error', 'Unauthorized Access');
        }
    }


    public function delete_category($id)
    {
        $data = Category::find($id);

        $data->delete();

        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }

    public function add_product(Request $request)
    {
        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->discount_price;
        $product->category_id = $request->category;
        $product->quantity = $request->quantity;

        $image = $request->image;

        $imagename = time() . '.' . $image->getClientOriginalExtension();

        $request->image->move('product', $imagename);

        $product->image = $imagename;

        $product->save();

        return redirect()->back()->with('message', 'Product Added Successfully');
    }

    public function add_category(Request $request)
    {
        $data = new Category;

        $data->category_name = $request->category;

        $data->save();

        return redirect()->back()->with('message', 'Category Added Successfully');
    }

    public function delete_product($id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }


    public function update_product($id)
    {
        $product = Product::find($id);

        $category = Category::all();

        return view('admin.update_product', compact('product', 'category'));
    }


    public function update_product_confirm(Request $request, $id)
    {
        if(Auth::check()) {
            $product = Product::find($id);

            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->discount_price = $request->discount_price;
            $product->category = $request->category;
            $product->quantity = $request->quantity;

            $image = $request->image;

            if ($image) {

                $imagename = time() . '.' . $image->getClientOriginalExtension();

                $request->image->move('product', $imagename);

                $product->image = $imagename;
            }

            $product->save();

            return redirect()->back()->with('message', 'Product Updated Successfully');

            } else {

                return redirect('login');
            }

    }
}
