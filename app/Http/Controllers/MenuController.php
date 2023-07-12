<?php

namespace App\Http\Controllers;

use App\Components\MenuRecusive;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    private $menus;
    public function __construct(Menu $menu)
    {
        $this->menus = $menu;
    }

    public function index(){
        $menus = $this->menus->paginate(4);

        return view('admin.menu.index', compact('menus'));
    }

    public function create(MenuRecusive $menuRecusive){
        $htmlSelect = $menuRecusive->recusiveMenu();
        return view('admin.menu.add', compact('htmlSelect'));
    }
    public function store(Request $request)
    {
        $this->menus->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug'=> Str::slug($request->name)
        ]);
        return redirect(route('menus.index'));
    }

    public function edit($id,MenuRecusive $menuRecusive){
        $menuEdit = $this->menus->find($id);
        $htmlSelect = $menuRecusive->recusiveMenuEdit($menuEdit->parent_id);
        return view('admin.menu.edit', compact('htmlSelect','menuEdit'));
    }

    public function update($id, Request $request){
        $this->menus->find($id)->update([
            'name' => $request->name,
            'parent_id'=> $request->parent_id
        ]);
        return redirect((route('menus.index')));
    }

    public function delete($id){
        $this->menus->find($id)->delete();
        return redirect((route('menus.index')));
    }
}
