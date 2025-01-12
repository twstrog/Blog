<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\CategoryFormRequest;
use PhpParser\Node\Stmt\TryCatch;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('admin.category.index', compact('category'));
    }

    public function create()
    {
        return view('admin.category.add');
    }

    // Lưu dữ liệu lên db
    public function store(CategoryFormRequest $request)
    {
        // Kiểm tra các dữ liệu đầu vào

        try {
            $data = $request->validated();

            $category = new Category();
            $category->name = $data['name'];
            // $category->slug = Str::slug($data['slug']);
            $category->slug = Str::slug($data['name']);
            $category->description = $data['description'];

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/category/', $filename);
                $category->image = $filename;
            }

            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keyword = $data['meta_keyword'];

            $category->navbar_status = $request->navbar_status == true ? '1' : '0';
            $category->status = $request->status == true ? '1' : '0';
            $category->created_by = Auth::user()->id;

            $category->save();
            return redirect()->back()->with('status', 'Add Category Successful');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function edit($category_id)
    {
        $category = Category::find($category_id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category_id)
    {
        // Validate input data
        $data = $request->validated();

        // Find the category by ID
        $category = Category::find($category_id);
        $category->name = $data['name'];
        // $category->slug = Str::slug($data['slug']);
        $category->slug = Str::slug($data['name']);
        $category->description = $data['description'];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Get the Uploaded File:
            $file = $request->file('image');

            // Construct the Old Image Path
            $old_image = 'uploads/category/' . $category->image;
            // Check if the Old Image Exists and Delete It
            if (File::exists($old_image)) {
                File::delete($old_image);
            }

            // Add .jpg or png or ... to filename of image
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/category/', $filename);
            $category->image = $filename;
        }

        // Update other fields
        $category->meta_title = $data['meta_title'];
        $category->meta_description = $data['meta_description'];
        $category->meta_keyword = $data['meta_keyword'];
        $category->navbar_status = $request->navbar_status == true ? '1' : '0';
        $category->status = $request->status == true ? '1' : '0';
        $category->created_by = Auth::user()->id;

        // Save the updated category
        $category->save();

        // Redirect with success message
        return redirect()->route('admin.category')->with('status', 'Update Category Successful');
    }

    public function destroy($category_id)
    {
        try {
            $category = Category::find($category_id);
            if ($category) {
                $destination = 'uploads/category/' . $category->image;
                if (File::exists($destination)) {
                    File::delete($destination);
                }
                $category->posts()->delete();
                $category->delete();
                return redirect('admin/category')->with('status', 'Delete Category with its Posts Successful');
            } else {
                return redirect('admin/category')->with('status', 'Delete Category Failed');
            }
        } catch (\Exception $e) {
            return redirect('admin/category')->with('status', 'An error occurred: ' . $e->getMessage());
        }
    }
}
