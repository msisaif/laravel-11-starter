<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::query()
            ->pluck('value', 'property')
            ->toArray();

        return response()->json($settings);
    }
}
