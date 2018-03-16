<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use App\Menu;
use File;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::orderBy('created_at', 'DESC')->paginate(6);
        return view('dashboard.menu', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return dd(str_replace(".", "", $request->price));
        if ($request->hasFile('pict') && $request->file('pict')->isValid()) {
            // Uploading
            $extension = $request->pict->extension();
            $filename = md5(time()) . '.' . $extension;
            $path = public_path('assets/pictures/menu');
            $store = $request->pict->move($path, $filename);
            // Saving
            $menu = new Menu;
            $menu->name = $request->name;
            $menu->price = str_replace(".", "", $request->price);
            $menu->description = $request->description;
            $menu->min_order = $request->min_order;
            $menu->pict = $filename;
            $menu->save();
        } else {
            $menu = new Menu;
            $menu->name = $request->name;
            $menu->price = str_replace(".", "", $request->price);
            $menu->description = $request->description;
            $menu->min_order = $request->min_order;
            $menu->save();   
        }
        return redirect()->route('food-menu.index')->with('success', 'New menu has beed added to the menu list.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::find($id);
        return view('dashboard.menu-edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        if ($request->hasFile('pict') && $request->file('pict')->isValid()) {
            // Uploading
            $extension = $request->pict->extension();
            $filename = md5(time()) . '.' . $extension;
            $path = public_path('assets/pictures/menu');
            $store = $request->pict->move($path, $filename);
            // Saving
            $menu->name = $request->name;
            $menu->price = $request->price;
            $menu->description = $request->description;
            $menu->min_order = $request->min_order;
            $menu->pict = $filename;
            $menu->save();
        } else {
            $menu->name = $request->name;
            $menu->price = $request->price;
            $menu->description = $request->description;
            $menu->min_order = $request->min_order;
            $menu->save();   
        }
        return redirect()->route('food-menu.index')->with('success', 'Menu has beed changed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $menu = Menu::find($id);
            $menu->delete();
            $path = public_path('assets/pictures/menu/'.$menu->pict);
            File::delete($path);
            return redirect()->route('food-menu.index')->with('success', 'Menu has been removed from menu list.');   
        } catch (Exception $e) {
            return redirect()->route('food-menu.index')->with('failed', 'Operation terminated.');   
        }
    }
}
