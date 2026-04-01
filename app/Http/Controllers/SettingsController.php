<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        $defaults = Setting::getDefaults();

        return view('settings.index', compact('settings', 'defaults'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'library_name' => 'required|string|max:255',
            'library_address' => 'nullable|string|max:500',
            'borrowing_days' => 'required|integer|min:1|max:90',
            'fine_per_day' => 'required|integer|min:0|max:100000',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('settings.index')
            ->with('success', 'Pengaturan berhasil disimpan.');
    }
}
