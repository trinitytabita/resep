<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuModel;
use App\Models\Recipe;
use Illuminate\support\facades\validator;



class ResepController extends Controller
{
    public function index()
    {
        

        $recipes = Recipe::with('menu')->get(); // Ambil semua resep beserta menu terkait
        $menus = MenuModel::all(); // Ambil semua menu untuk dropdown di form
        // dd($menus);

        return view('admin.resep_index', compact('recipes', 'menus'));
    }
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'menu_model_id' => 'required',
                'ingredients' => 'required',
                'instructions' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput(); // Kembalikan input yang telah dimasukkan
            }

            // Simpan atau perbarui data resep
            Recipe::updateOrCreate(
                ['id' => $request->id], // Jika ada ID, lakukan update
                $request->only('menu_model_id', 'ingredients', 'instructions')
            );

            return redirect()->route('recipes.index')->with('success', 'Recipe saved successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to save recipe: ' . $e->getMessage()]);
        }
    }

    public function destroy(Recipe $recipe)
    {
        try {
            $recipe->delete();
            return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete recipe: ' . $e->getMessage()]);
        }
    }
}
