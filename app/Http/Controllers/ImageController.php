<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Image::latest()->get()->map(function ($image) {
            return [
                'id'    => $image->id,
                'label' => $image->label,
                'url'   => url(Storage::url($image->path)),
            ];
        });
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'image' => 'required|image', // max 2MB
            'label' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('images', 'public');

        $image = Image::create([
            'path'  => $path,
            'label' => $request->input('label'),
        ]);

        return response($image, 201); // 201 Created
    }

  
    

    public function destroy(Image $image)
    {
        $image->delete();
        return response(null, 204);
    }
}
