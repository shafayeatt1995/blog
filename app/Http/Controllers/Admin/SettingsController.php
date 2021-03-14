<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Theme;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    public function index()
    {
        $themes = Theme::all();
        return view('admin.settings',compact('themes'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'required|image',
        ]);

        //Get Image From Form
        $images = $request->file('image');
        $slug = str_slug($request->name);
        $user = User::findOrFail(Auth::id());
        if (isset($images)) {
            //make unique name for image
            $currentdate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentdate . '-' . uniqid() . '.' . $images->getClientOriginalExtension();

            //Check Category folder if exist
            if (!Storage::disk('public')->exists('user')) {
                Storage::disk('public')->makeDirectory('user');
            }
            //delete old image
            if (Storage::disk('public')->exists('user/' . $user->image)) {
                Storage::disk('public')->delete('category/' . $user->image);
            }
            //resize image for category & Upload
            $userImage = Image::make($images)->save($images->getClientOriginalExtension());
            Storage::disk('public')->put('user/' . $imagename, $userImage);
        } else {
            $imagename = $user->image;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $imagename;
        $user->about = $request->about;
        $user->save();
        Toastr::success('Profile Successfully Updated', 'Success');
        return redirect()->route('admin.setting');
    }

    public function password(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password,$hashedPassword))
        {
            if (!Hash::check($request->password,$hashedPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Password Successfully Updated','Success');
                Auth::logout();
                return redirect()->back();
            }
            else
            {
                Toastr::error('New Password Can not be same as Old Password','Error');
                return redirect()->back();
            }
        }
        else
        {
            Toastr::error('Current Password not match','Error');
            return redirect()->back();
        }
    }

    public function theme(Request $request)
    {
        $user = User::find(Auth::id());
        $user->theme = $request->class;
        $user->save();
        Toastr::success('New Theme Successfully Selected','Success');
        return redirect()->back();
    }
}
