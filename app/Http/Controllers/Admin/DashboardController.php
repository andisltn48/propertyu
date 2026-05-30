<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroImage;
use App\Models\Map;
use App\Models\About;
use App\Models\Contact;
use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Article;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'hero_count' => HeroImage::count(),
            'project_count' => Project::count(),
            'article_count' => Article::count(),
            'has_about' => About::exists(),
            'has_contact' => Contact::exists(),
            'has_map' => Map::exists(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
