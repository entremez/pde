<?php

namespace App\Http\Controllers\Provider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Service;
use App\ProviderService;
use File;

class ProviderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data = $user->name();
        $phone = $data->phone;
        $services = Service::get();
        if (empty($data->logo) OR empty($data->description))
            return view('provider.config-dashboard')->with(compact('data','user', 'services'));
        $services = ProviderService::where('provider_id', '=',$data->id)->get();
        return view('provider.dashboard')->with(compact('user', 'data','services', 'phone'));
    }

    public function edit(Request $request)
    {
        $messages = [
            'name.required' => 'Debe ingresar el nombre.',
            'address.required' => 'Debe ingresar la dirección',
            'logo.required' => 'Debe adjuntar una imagen',
            'logo.image' => 'Solo se admiten imágenes en formato jpeg, png, bmp, gif, o svg',
            'phone.required' => 'Debe ingresar número de teléfono',
            'description.required' => 'Debe ingresar una descripción de tu empresa',
            'description.max' => 'La descripción de tu empresa no debe superar los 250 caracteres',
            'long_description.required' => 'Debe ingresar una descripción de tus servicios',
            'service.required' => 'Debe seleccionar al menos un servicio',
        ];
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'logo' => 'required|image',
            'description' => 'required|max:250',
            'long_description' => 'required',
            'service' => 'required',
        ];
        $this->validate($request, $rules, $messages);
        $file = $request->file('logo');
        $path = public_path().'/providers/logos';
        $provider = auth()->user()->name();
        $fileName = $provider->id."-".uniqid()."-".$file->getClientOriginalName();
        $file->move($path, $fileName);

        $provider->logo = $fileName;
        $provider->name = $request->input('name');
        $provider->address = $request->input('address');
        $provider->phone = $request->input('phone');
        $provider->description = $request->input('description');
        $provider->long_description = $request->input('long_description');
        $provider->save();

        $services = $request->input('service');
        for ($i=0; $i < count($services); $i++) {
            $provider_service = new ProviderService();
            $provider_service->provider_id = $provider->id;
            $provider_service->service_id = $services[$i];
            $provider_service->save();
        }

        return redirect('provider/dashboard');
    }

    public function settings(Request $request)
    {
        $user = auth()->user();
        $services = Service::get();
        return view('provider.settings')->with(compact('services', 'user'));
    }

    public function update(Request $request){
        $messages = [
            'name.required' => 'Debe ingresar el nombre.',
            'address.required' => 'Debe ingresar la dirección',
            'logo.image' => 'Solo se admiten imágenes en formato jpeg, png, bmp, gif, o svg',
            'phone.required' => 'Debe ingresar número de teléfono',
            'description.required' => 'Debe ingresar una descripción de tu empresa',
            'description.max' => 'La descripción de tu empresa no debe superar los 250 caracteres',
            'long_description.required' => 'Debe ingresar una descripción de tus servicios',
            'service.required' => 'Debe seleccionar al menos un servicio',
        ];
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'logo' => 'image|max:1500',
            'description' => 'required|max:250',
            'long_description' => 'required',
            'service' => 'required',
        ];
        $this->validate($request, $rules, $messages);
        $provider = auth()->user()->name();
        if ($request->hasFile('files')) {
            File::delete(public_path().'/providers/logos/'.$provider->logo);
            $file = $request->file('files');
            $path = public_path().'/providers/logos';
            $fileName = $provider->id."-".uniqid()."-".$file[0]->getClientOriginalName();
            $file[0]->move($path, $fileName);
            $provider->logo = $fileName;
        }
        $provider->name = $request->input('name');
        $provider->address = $request->input('address');
        $provider->phone = $request->input('phone');
        $provider->description = $request->input('description');
        $provider->long_description = $request->input('long_description');
        $provider->save();
        $services = $request->input('service');
        ProviderService::where('provider_id','=',$provider->id)->delete();
        for ($i=0; $i < count($services); $i++) {
            $provider_service = new ProviderService();
            $provider_service->provider_id = $provider->id;
            $provider_service->service_id = $services[$i];
            $provider_service->save();
        }
        return redirect('provider/dashboard')->withSuccess( 'Datos modificados correctamente');
    }

     public function request()
     {
        $provider = auth()->user()->name();
        $provider->status = 1;
        $provider->save();
        return redirect('provider/dashboard')->withSuccess( 'Solicitud enviada a administradores');
     }
}

