<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function form()
    {
        // return
        $settings = Setting::pluck('value', 'property')->toArray();

        return view('admin.settings.form', compact('settings'));
    }

    public function save(Request $request)
    {
        // return $request;

        foreach($request->settings as $property => $value) {
            Setting::updateOrCreate(
                [
                    'property' => $property,
                ],
                [
                    'value' => $value,
                ]
            );
        }

        return back()->with('message', 'Updated successfully!');
    }
}
