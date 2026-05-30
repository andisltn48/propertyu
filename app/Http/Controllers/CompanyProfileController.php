<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HeroImage;
use App\Models\HeroSetting;
use App\Models\About;
use App\Models\Contact;
use App\Models\Map;

use App\Models\Gallery;

use App\Models\Project;

use App\Models\Article;

class CompanyProfileController extends Controller
{
    /**
     * Tampilkan halaman profil perusahaan.
     */
    public function index()
    {
        $heroImages = HeroImage::all();
        $heroSetting = HeroSetting::first();
        $about = About::first();
        $contact = Contact::first();
        $map = Map::first();
        $galleries = Gallery::latest()->limit(5)->get();
        $projects = Project::with('images')->latest()->limit(3)->get();
        $articles = Article::latest('published_at')->limit(3)->get();

        return view('company-profile', compact('heroImages', 'heroSetting', 'about', 'contact', 'map', 'galleries', 'projects', 'articles'));
    }

    public function allGallery(Request $request)
    {
        $galleries = Gallery::latest()->paginate(7);

        if ($request->ajax()) {
            return view('partials.gallery-items', compact('galleries'))->render();
        }

        return view('gallery', compact('galleries'));
    }

    public function allProjects(Request $request)
    {
        $query = Project::with('images')->latest();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $projects = $query->paginate(9);

        if ($request->ajax()) {
            return view('partials.project-items', compact('projects'))->render();
        }

        return view('projects', compact('projects'));
    }

    public function projectDetail(Project $project)
    {
        $project->load('images');
        $contact = Contact::first();
        return view('project-detail', compact('project', 'contact'));
    }

    public function project3DTour(Project $project)
    {
        if (!$project->file_3d_path) {
            abort(404);
        }
        return view('project-3d-tour', compact('project'));
    }

    public function allArticles()
    {
        $articles = Article::latest('published_at')->paginate(9);
        return view('articles', compact('articles'));
    }

    public function articleDetail(Article $article)
    {
        $contact = Contact::first();
        $related = Article::where('id', '!=', $article->id)
            ->latest('published_at')
            ->limit(3)
            ->get();
        return view('article-detail', compact('article', 'contact', 'related'));
    }
}
