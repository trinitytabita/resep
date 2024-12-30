<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Models\MenuModel;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\support\facades\validator;



class MenuController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $menus = MenuModel::all();
    $categories = Category::all(); // Ambil semua kategori untuk form
    return view('admin.menu_index2', compact('menus', 'categories'));
    
    }

    /** 
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Ambil kategori untuk form
    return view('admin.menu_index2', compact('categories'));
    
    }

    /**
     * Store a newly created resource in storage.
     */ 
    public function store(Request $request)
{
    try {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|unique:menu_models,name',
            'category_id' => 'required',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload image jika ada
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('menu-images', 'public');
        }

        // Simpan menu
        MenuModel::create($validated);

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan.');
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Tangkap error validasi dan kirim kembali ke halaman
        return redirect()->back()
            ->withErrors($e->errors())
            ->withInput(); // Mengirimkan input yang telah dimasukkan sebelumnya
    } catch (\Exception $e) {
        // Tangkap error lainnya
        return redirect()->back()->withErrors(['error' => 'Gagal menambahkan menu: ' . $e->getMessage()]);
    }
}
  /**
     * Update the specified resource in storage.
     */
public function update(Request $request, MenuModel $menu)
{
    try {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|unique:menu_models,name,' . $menu->id,
            'category_id' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload image jika ada
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('menu-images', 'public');
        }

        // Update data menu
        $menu->update($validated);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil diperbarui.');
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Tangkap error validasi dan kirim kembali ke halaman
        return redirect()->back()
            ->withErrors($e->errors())
            ->withInput(); // Mengirimkan input yang telah dimasukkan sebelumnya
    } catch (\Exception $e) {
        // Tangkap error lainnya
        return redirect()->back()->withErrors(['error' => 'Gagal memperbarui menu: ' . $e->getMessage()]);
    }
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuModel $menu)
    {
        // dd($id);
        // $menus = MenuModel::findOrFail($id); // Ambil data menu berdasarkan ID
        $menus = MenuModel::all();
        $categories = Category::all();     // Ambil semua kategori
        // dd($menus,$categories);
        return view('admin.menu_index2', compact( 'menu' ,'categories', 'menus'));
    }

  
   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $menu = MenuModel::findOrFail($id);
            $menu->delete();
            return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus menu: ' . $e->getMessage()]);
        }
    
    }
}
