<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'min:4', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'min:4', 'confirmed'],
            // 'photo_path' => ['required|image']
        ]);

        // $file = $request->get('imgBase64');
        // $file->storeAs('public/posts', $file->hashName());

        // Get the base64 data from the request
        // $base64Data = $request->imgBase64;

        // Decode the base64 data
        // $imageData = str_replace('data:image/png;base64,', '', $base64Data);

        // // Generate a unique file name for the image
        // $fileName = time() . '.png';

        // // Save the image to the desired location
        // $filePath = public_path('uploads/' . $fileName);
        // file_put_contents($filePath, $imageData);


        // $image = Image::make($request->get('imgBase64'));
        // $image->save('public/bar.jpg');

        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            // 'photo_path' => $file->hashName()
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('greeting');
    }
}
