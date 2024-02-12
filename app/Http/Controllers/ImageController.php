<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function destroy($id) {
        $image = Image::find($id);
        if(!$image) {
            return response()->json(['error' => 'Image not found.'], 404);
        }
        Storage::delete($image->path);
        $image->delete();
        return response()->json(['message' => 'Image deleted successfully.']);
    }
}
