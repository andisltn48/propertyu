<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'detail' => 'nullable',
            'file_3d' => 'nullable|file|mimes:bin,glb|max:20480', // Max 20MB for GLB
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:10000'
        ]);

        $project = Project::create([
            'name' => $request->name,
            'detail' => $request->detail,
        ]);

        if ($request->hasFile('file_3d')) {
            $project->file_3d_path = $request->file('file_3d')->store('projects/3d', 'public');
            $project->save();
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('projects/images', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'detail' => 'nullable',
            'file_3d' => 'nullable|file|mimes:bin,glb|max:20480',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:10000'
        ]);

        $project->update([
            'name' => $request->name,
            'detail' => $request->detail,
        ]);

        if ($request->hasFile('file_3d')) {
            if ($project->file_3d_path) Storage::disk('public')->delete($project->file_3d_path);
            $project->file_3d_path = $request->file('file_3d')->store('projects/3d', 'public');
            $project->save();
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('projects/images', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        // Delete 3D file
        if ($project->file_3d_path) Storage::disk('public')->delete($project->file_3d_path);
        
        // Delete images
        foreach ($project->images as $img) {
            Storage::disk('public')->delete($img->image_path);
        }

        $project->delete();
        return back()->with('success', 'Project deleted.');
    }

    public function deleteImage($id)
    {
        $image = ProjectImage::findOrFail($id);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
        return back()->with('success', 'Image removed.');
    }
}
