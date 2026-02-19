<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    // ═══════════════════════════════════════════════════════════════
    //  قواعد التحقق من صحة البيانات (مشتركة بين الإضافة والتعديل)
    // ═══════════════════════════════════════════════════════════════

    /**
     * يُرجع قواعد التحقق للوصفة — نستخدمها في store و update بدون تكرار.
     */
    private function rules(): array
    {
        return [
            'title'        => 'required|max:255',
            'ingredients'  => 'required',
            'instructions' => 'required',
            'prep_time'    => 'required|integer|min:1',
            'cook_time'    => 'nullable|integer|min:0',
            'category'     => 'required|in:Cuisine algérienne,Desserts,Entrées & Salades,Soupes,Cuisine française,Plats principaux,Autres',
            'difficulty'   => 'required|in:سهل,متوسط,صعب',
            'image'        => 'nullable|image|max:2048',
        ];
    }

    /**
     * يحفظ الصورة في التخزين العمومي إن وُجدت، ويُضيف المسار إلى المصفوفة.
     */
    private function addImageIfUploaded(Request $request, array $validated): array
    {
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('recipes', 'public');
        }
        return $validated;
    }

    // ═══════════════════════════════════════════════════════════════
    //  العرض والقراءة (صفحات عامة — بدون تسجيل دخول)
    // ═══════════════════════════════════════════════════════════════

    /**
     * عرض قائمة الوصفات مع إمكانية البحث والتصفية حسب الفئة.
     */
    public function index(Request $request)
    {
        $query = Recipe::with('user');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $recipes = $query->latest()->paginate(30);

        return view('recipes.index', compact('recipes'));
    }

    /**
     * عرض وصفة واحدة بالتفصيل.
     */
    public function show(Recipe $recipe)
    {
        $recipe->load('user');
        return view('recipes.show', compact('recipe'));
    }

    // ═══════════════════════════════════════════════════════════════
    //  إنشاء وصفة جديدة (يتطلب تسجيل الدخول)
    // ═══════════════════════════════════════════════════════════════

    /**
     * عرض نموذج إضافة وصفة جديدة.
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * حفظ الوصفة الجديدة في قاعدة البيانات بعد التحقق من البيانات.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());
        $validated = $this->addImageIfUploaded($request, $validated);
        $validated['user_id'] = Auth::id();

        Recipe::create($validated);

        return redirect()->route('recipes.index')
            ->with('success', 'La recette a été ajoutée avec succès! 🎉');
    }

    // ═══════════════════════════════════════════════════════════════
    //  تعديل وحذف وصفة (يتطلب تسجيل الدخول)
    // ═══════════════════════════════════════════════════════════════

    /**
     * عرض نموذج تعديل وصفة موجودة.
     */
    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', compact('recipe'));
    }

    /**
     * تحديث بيانات الوصفة بعد التحقق من البيانات.
     */
    public function update(Request $request, Recipe $recipe)
    {
        $validated = $request->validate($this->rules());
        $validated = $this->addImageIfUploaded($request, $validated);

        $recipe->update($validated);

        return redirect()->route('recipes.index')
            ->with('success', 'La recette a été modifiée avec succès! ✅');
    }

    /**
     * حذف وصفة (حذف منطقي — تبقى في سلة المحذوفات إن وُجدت).
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->route('recipes.index')
            ->with('success', 'La recette a été supprimée avec succès! 🗑️');
    }
}
