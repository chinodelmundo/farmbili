<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Storage;
use Files;
use Response;

use App\Image as Image;
use App\Product as Product;

class ImageController extends Controller
{
    public function upload_product_photo(Request $request)
	{
        $file = $request->image;
        $extension = $file->getClientOriginalExtension();
    	$product_id = $request->product_id;

        $image = new Image;
        $image->product_id = $product_id;
        $image->file_name = $product_id.'_'.rand(11111,99999).'.'.$extension;
        $image->mime = $file->getClientMimeType();
        $image->original_file_name = $file->getClientOriginalName();

        $product = Product::find($product_id);

        if($product->images()->count() > 0){
            $image->is_primary = 0;
        }else{
            $image->is_primary = 1;
        }
        $image->save();

        $file = $file->move('images/uploads',  $image->file_name );

        return redirect()->route('product.show', $product_id);
	}

    public function upload_user_photo(Request $request)
    {
            $file = $request->image;
            $extension = $file->getClientOriginalExtension();

            $image = new Image;
            $image->user_id = Auth::User()->id;
            $image->file_name = Auth::User()->id.'_'.rand(11111,99999).'.'.$extension;
            $image->mime = $file->getClientMimeType();
            $image->original_file_name = $file->getClientOriginalName();

            if(Auth::User()->images()->count() > 0){
                $image->is_primary = 0;
            }else{
                $image->is_primary = 1;
            }
            
            $image->save();

            $file = $file->move('images/uploads',  $image->file_name );

            return redirect()->route('profile.index');
    }

    // Delete User Photo
    public function destroy($id)
    {
        $image = Image::find($id);
        $image->delete();

        return redirect()->route('profile.index')
            ->with('status', 'Image has been deleted.');
    }

    // Delete Product Photo
    public function delete_product_image($id)
    {
        $image = Image::find($id);
        $product = Product::find($image->product->id);

        $image->delete();

        return redirect()->route('product.show', $product->id)
            ->with('status', 'Image has been deleted.');
    }

    // Set Photo as Primary Photo for user
    public function set_primary($id)
    {
        Image::where([
            ['user_id', Auth::User()->id],
            ['is_primary', 1],
        ])->update(['is_primary' => 0]);

        $image = Image::find($id);
        $image->is_primary = 1;
        $image->save();

        return redirect()->route('profile.index')
            ->with('status', 'Primary photo has been changed.');
    }

    // Set Photo as Primary Photo for product
    public function set_primary_product_image($id, $product_id)
    {
        Image::where([
            ['product_id', $product_id],
            ['is_primary', 1],
        ])->update(['is_primary' => 0]);

        $image = Image::find($id);
        $image->is_primary = 1;
        $image->save();

        return redirect()->route('profile.index')
            ->with('status', 'Primary photo has been changed.');
    }
}
