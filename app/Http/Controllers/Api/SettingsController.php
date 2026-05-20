<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppSettingResource;
use App\Models\AppSetting;

class SettingsController extends Controller
{
    public function index(): AppSettingResource
    {
        return new AppSettingResource(AppSetting::current());
    }
}
