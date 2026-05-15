<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::latest()->get();
        return view('admin.templates.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.templates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'view_path' => 'required|string',
            'preview_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('preview_image')) {
            $imagePath = $request->file('preview_image')->store('template-previews', 'public');
        }

        Template::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'view_path' => $request->view_path,
            'description' => $request->description,
            'preview_image' => $imagePath,
        ]);

        return redirect()->route('admin.templates.index')->with('success', 'Template berhasil ditambahkan.');
    }

    public function destroy(Template $template)
    {
        if ($template->preview_image) {
            Storage::disk('public')->delete($template->preview_image);
        }
        $template->delete();
        return back()->with('success', 'Template berhasil dihapus.');
    }
}