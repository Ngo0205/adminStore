<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Components\Recusive;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    //lấy danh mục theo đệ quy được khai báo trong Recusive
    public function getCategory($parent_id)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->category($parent_id);
        return $htmlOption;
    }

    //function trả về view chính của phần danh mục sanr phẩm
    public function index()
    {

        //phân trang
        $categories = $this->category->latest()->paginate(5);
        return view('admin.category.index', compact('categories'));
    }

    //function trả về view thêm danh muc
    public function create()
    {

        $htmlOption = $this->getCategory($parent_id = '');
        return view('admin.category.add', compact('htmlOption'));
    }

    //function thêm danh mục vào database
    public function store(Request $request)
    {
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect(route('categories.index'));
    }

    //function trả về view edit danh mục
    public function edit($id)
    {
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return view('admin.category.edit', compact('category', "htmlOption"));

    }

    //function update danh mục vào db
    public function update($id, Request $request)
    {
        $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);
        return redirect(route('categories.index'));
    }

    //function xoá danh mục theo id
    public function delete($id)
    {
        $this->category->find($id)->delete();
        return redirect(route('categories.index'));
    }
}
