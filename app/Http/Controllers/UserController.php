<?php

namespace App\Http\Controllers;
use App\Models\curd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'city' => 'required|string',
            'language' => 'required|array|min:1',
            'gender' => 'required|in:Male,Female',
            'message' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
    
        $curd = new Curd;
    
        $curd->name = $validated['name'];
        $curd->email = $validated['email'];
        $curd->city = $validated['city'];
        $curd->language = implode(',', $validated['language']);
        $curd->gender = $validated['gender'];
        $curd->message = $validated['message'];

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public'); // Store in storage/app/public/photos
            $curd->photo = $photoPath;
        }
    
        $curd->save();
    
        return redirect()->back()->with('success', 'User Form submitted successfully!');
    }

    // ----show data-----------------

    public function index(){
        $curd=curd::get();
        return view('index',['curd'=>$curd]);
    }


    //---------- delete data---------

    public function destroy($id)
    {
        $curd = Curd::find($id);
        $curd->delete();
        return redirect()->back()->with('success', 'User Data deleted successfully!');
    }


    // ------------update data-------------------

    public function edit($id)
    {
        $curd = Curd::find($id);
        return view('edit', ['curd' => $curd]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'city' => 'required|string',
            'language' => 'required|array|min:1',
            'gender' => 'required|in:Male,Female',
            'message' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validate image (max 2MB)
        ]);

        $curd = Curd::find($id);

        $curd->name = $validated['name'];
        $curd->email = $validated['email'];
        $curd->city = $validated['city'];
        $curd->language = implode(',', $validated['language']);
        $curd->gender = $validated['gender'];
        $curd->message = $validated['message'];

        if ($request->hasFile('photo')) {
            // Delete old photo if it exists
            if ($curd->photo && Storage::disk('public')->exists($curd->photo)) {
                Storage::disk('public')->delete($curd->photo);
            }
            // Store new photo
            $photoPath = $request->file('photo')->store('photos', 'public');
            $curd->photo = $photoPath;
        }

        $curd->save();

        return redirect()->route('index')->with('success', 'User Data updated successfully!');
    }
}