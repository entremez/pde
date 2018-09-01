<?php

namespace App\Http\Controllers\Provider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Instance;
use App\InstanceImage;
use File;
use App\Rules\LimitNumberImages;

class CaseImagesController extends Controller
{
    public function index($id)
    {
        $case = Instance::find($id);
        $user = auth()->user();
        return view('provider.images')->with(compact('user', 'case', 'user'));
    }

    public function destroy(Request $request, $id)
    {
        $instance = Instance::find($id);
        if($instance->images()->count() == config('constants.min_cases'))
            return redirect()->back()->withErrors(array('image' => 'El caso debe tener como mínimo '.config('constants.min_cases').' imágen'));
        $image = InstanceImage::find($request->input('image_id'));
        $featured = $image->featured;
        $path = public_path().'/providers/cases/'.$instance->id.'/'.$image->image;
        File::delete($path);
        $image->delete();
        if($featured){
            $images = $instance->images();
            $image = $images->first();
            $image->featured = true;
            $image->save();
        }
        return redirect()->route('images.case',$id);
    }

    public function featured(Request $request, $id)
    {
        $images = InstanceImage::where('instance_id','=',$id)->get();
        foreach ($images as $image) {
            $image->featured = false;
            $image->save();
        }
        $image = InstanceImage::find($request->input('image_id'));
        $image->featured = true;
        $image->save();
        return redirect()->route('images.case',$id);
    }

    public function update(Request $request, $id)
    {
        $instance = Instance::find($id);
        $messages = [
            'images.image' => 'Solo se admiten imágenes en formato jpeg, png, bmp, gif, o svg',
            'images.*.max' => 'Las imágenes no deben ser mayores a 1.5 Mb',
        ];
        $rules = [
            'images' => new LimitNumberImages($instance->images()->count()),
            'images.*' => 'required|image|max:1500',
        ];
        $this->validate($request, $rules, $messages);

        $images = $request->file('images');
        foreach ($images as $key => $image) {
            $path = public_path().'/providers/cases/'.$instance->id.'/';
            $fileName = uniqid()."-".$image->getClientOriginalName();
            $image->move($path, $fileName);
            $instance_image = new InstanceImage;
            $instance_image->image = $fileName;
            $instance_image->instance_id = $instance->id;
            $instance_image->save();
        }
        return redirect()->route('images.case',$id);
    }
}
