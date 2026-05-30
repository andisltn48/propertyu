<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Contact;
use App\Models\HeroImage;
use App\Models\HeroSetting;
use App\Models\Map;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    // Gallery Methods
    public function gallery()
    {
        $galleries = Gallery::latest()->get();
        return view('admin.settings.gallery', compact('galleries'));
    }

    public function storeGallery(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10000'
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('gallery', 'public');
                Gallery::create(['image_path' => $path]);
            }
        }

        return back()->with('success', 'Images added to gallery successfully.');
    }

    public function deleteGallery($id)
    {
        $gallery = Gallery::findOrFail($id);
        Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();
        return back()->with('success', 'Image removed from gallery.');
    }

    // Hero Settings
    public function hero()
    {
        $images = HeroImage::all();
        $setting = HeroSetting::first();
        return view('admin.settings.hero', compact('images', 'setting'));
    }

    public function updateHero(Request $request)
    {
        $request->validate([
            'overlay_text' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10000'
        ]);

        // Update overlay text
        HeroSetting::updateOrCreate(['id' => 1], ['overlay_text' => $request->overlay_text]);

        // Handle multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('hero', 'public');
                HeroImage::create(['image_path' => $path]);
            }
        }

        return back()->with('success', 'Hero settings updated successfully.');
    }

    public function deleteHeroImage($id)
    {
        $image = HeroImage::findOrFail($id);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
        return back()->with('success', 'Image deleted.');
    }

    // About Us Settings
    public function about()
    {
        $about = About::first() ?? new About();
        return view('admin.settings.about', compact('about'));
    }

    public function updateAbout(Request $request)
    {
        $request->validate([
            'konten' => 'required',
            'foto' => 'nullable|image|max:10000'
        ]);

        $about = About::first() ?? new About();
        $data = ['konten' => $request->konten];

        if ($request->hasFile('foto')) {
            if ($about->foto) {
                Storage::disk('public')->delete($about->foto);
            }
            $data['foto'] = $request->file('foto')->store('about', 'public');
        }

        About::updateOrCreate(['id' => 1], $data);
        return back()->with('success', 'About Us updated successfully.');
    }

    // Contact Settings
    public function contact()
    {
        $contact = Contact::first() ?? new Contact();
        return view('admin.settings.contact', compact('contact'));
    }

    public function updateContact(Request $request)
    {
        $request->validate(['no_whatsapp' => 'required|string']);
        Contact::updateOrCreate(['id' => 1], ['no_whatsapp' => $request->no_whatsapp]);
        return back()->with('success', 'Contact updated successfully.');
    }

    // Maps Settings
    public function maps()
    {
        $map = Map::first() ?? new Map();
        return view('admin.settings.maps', compact('map'));
    }

    public function updateMaps(Request $request)
    {
        $request->validate([
            'link_maps' => 'nullable|string',
            'alamat_teks' => 'nullable|string'
        ]);

        Map::updateOrCreate(['id' => 1], [
            'link_maps' => $request->link_maps,
            'alamat_teks' => $request->alamat_teks
        ]);
        return back()->with('success', 'Maps and Address updated successfully.');
    }
}
