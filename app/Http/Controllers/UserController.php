<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuModel;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;




class UserController extends Controller
{
    // Tampilan Page Pertama: Pilih Kategori
    public function index()
    {
        $categories = Category::with('menus')->get();

        return view('user.page1', compact('categories'));
    }

    // Tampilan Page Kedua: Menampilkan Menu Berdasarkan Kategori
    public function show($id)
    {
        $category = Category::find($id); // Mengambil data berdasarkan ID
        $menus = MenuModel::where('category_id', $id)->get(); // Relasi dengan menu
        return view('user.page2', [
            'categoryName' => $category->name,
            'menus' => $menus,
        ]);
    }
    public function detail($id)
{   
    // dd($id);
    // Ambil data menu berdasarkan ID
    $menu = MenuModel::with('recipe')->findOrFail($id);
    // @dd($menu->recipe->ingredients);

    // Kirim data menu dan resep ke view
    return view('user.page_detail', compact('menu'));
}
public function loginForm()
{
    return view('admin_login');
}

public function loginSubmit(Request $request)
{
    // dd($request);
    // Log::info('Input login:', $request->all());
    $validator = Validator::make($request->all(), [
        'username' => 'required|string',
        'password' => 'required|string',
    ]);
    // dd($validator);
    Log::info('Validasi input berhasil.');
    // Cek data admin di database
    $admin = Admin::where('username', $request->username)->first();
    if ($admin) {
        Log::info('Admin ditemukan:', $admin->toArray());
    } else {
        Log::warning('Query tidak menemukan admin:', [
            'query' => Admin::where('username', $request->username)->toSql(),
            'bindings' => [$request->username],
        ]);
    }
    if ($admin && Hash::check($request->password, $admin->password)) {
        // Jika username cocok dan password benar
        session(['admin_logged_in' => true, 'admin_id' => $admin->id]);
        // Redirect ke dashboard admin
        Log::info('Redirecting to admin.menus.index');
        return redirect()->route('menus.index');
    } else {
        // Jika username atau password salah
        return back()->with('error', 'Username atau password salah.');
    }
}

}
