<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    private function handleFileUpload($file, $path, $currentFile = null)
    {
        if ($currentFile && File::exists(public_path($path . '/' . $currentFile))) {
            File::delete(public_path($path . '/' . $currentFile));
        }
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($path), $filename);
        return $filename;
    }

    public function index()
    {
        $setting = Setting::find(1);
        return view('admin.settings.index', compact('setting'));
    }

    public function savedata(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'website_name' => 'required|string|max:50',
            'website_logo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:255',
            'website_favicon' => 'nullable|file|mimes:ico|max:255',
            'description' => 'required|string|max:5000',
            'meta_title' => 'required|string|max:100',
            'meta_description' => 'required|string|max:255',
            'meta_keyword' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('error', 'Please fill all the required fields');
        }

        $setting = Setting::where('id', 1)->first();
        if ($setting) {
            $setting->website_name = $request->website_name;

            if ($request->hasFile('website_logo')) {
                $setting->logo = $this->handleFileUpload($request->file('website_logo'), 'uploads/settings', $setting->logo);
            }

            if ($request->hasFile('website_favicon')) {
                $setting->favicon = $this->handleFileUpload($request->file('website_favicon'), 'uploads/settings', $setting->favicon);
            }

            $setting->description = $request->description;
            $setting->meta_title = $request->meta_title;
            $setting->meta_description = $request->meta_description;
            $setting->meta_keyword = $request->meta_keyword;
            $setting->save();

            return redirect('admin/settings')->with('status', 'Setting Updated Successfully');
        } else {
            $setting = new Setting();
            $setting->website_name = $request->website_name;

            if ($request->hasFile('website_logo')) {
                $destinationLogo = 'uploads/settings/' . $setting->logo;
                if (File::exists($destinationLogo)) {
                    File::delete($destinationLogo);
                }
                $file = $request->file('website_logo');
                $fileNameLogo = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/settings'), $fileNameLogo);
                $setting->logo = $fileNameLogo;
            }

            if ($request->hasFile('website_favicon')) {
                $destinationFav = 'uploads/settings/' . $setting->favicon;
                if (File::exists($destinationFav)) {
                    File::delete($destinationFav);
                }
                $file = $request->file('website_favicon');
                $fileNameFav = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/settings'), $fileNameFav);
                $setting->favicon = $fileNameFav;
            }

            $setting->description = $request->description;
            $setting->meta_title = $request->meta_title;
            $setting->meta_description = $request->meta_description;
            $setting->meta_keyword = $request->meta_keyword;
            $setting->save();

            return redirect('admin/settings')->with('status', 'Setting updated successfully');
        }
    }
}
