<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $title = "Settings Management - PPKD Sticker";
        $setting = Setting::all()->keyBy('key');
        return view('admin.setting.index', compact('title', 'setting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'site_description' => 'nullable|string|max:255',
            'site_logo' => 'nullable|image|mimes:png,jpeg,webp|max:2048',

            'phone' => 'nullable|string|max:100',
            'email_upload' => 'nullable|string|max:255',
            'email_order' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:1000',

            'url_shopee' => 'nullable|string|max:255',
            'url_facebook' => 'nullable|string|max:255',
            'url_instagram' => 'nullable|string|max:255',
            'url_youtube' => 'nullable|string|max:255',
            'url_tiktok' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('site_logo')) {
            $setting = Setting::where('key', 'site_logo')->first();

            if ($setting && $setting->value) {
                //hapus gambar lalu upload gbr yg baru
                Storage::disk('public')->delete($setting->value);
            }
            $path = $request->file('site_logo')->store('setting', 'public');
            // return $path;
            Setting::updateOrCreate(
                ['key' => 'site_logo'], //nyari datanya dulu ada p gk. klo ada, update. klo gda, create
                [
                    'value' => $path,
                    'label' => "Site Logo", //ucwords(str_replace('_', ' ', $key)),
                    'group' => 'general',
                    'type' => 'image'
                ]
            );
        }
        $ignoreKeys = ['site_logo'];

        foreach ($validated as $key => $value) {
            // return $key;
            if (in_array($key, $ignoreKeys)) {
                continue;
            }

            Setting::updateOrCreate(
                ['key' => $key], //nyari datanya dulu ada p gk. klo ada, update. klo gda, create
                [
                    'value' => $value,
                    'label' => "Site Logo", //ucwords(str_replace('_', ' ', $key)),
                    'group' => 'general',
                    'type' => 'text'
                ]
            );
        }
        return redirect()->route('admin.settings')->with('success', 'Pengaturan website brhasil dsimpan');
    }
}
