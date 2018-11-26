<?php

namespace App\Http\Controllers\Provider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Service;
use App\ProviderService;
use File;
use App\City;
use App\Category;
use App\ProviderMember;
use Freshwork\ChileanBundle\Rut;

class ProviderController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        $data = $user->instance();
        $services = Service::get();
        $cities = City::get();
        $categories = Category::get();
        if (empty($data->logo) OR empty($data->long_description))
            return view('provider.config-dashboard')->with(compact('data','user', 'services', 'cities', 'categories'));
        $services = ProviderService::where('provider_id', '=',$data->id)->get();
        return view('provider.dashboard',[
            'user' => $user,
            'data'=> $data,
            'services' => $services,
            'instances' => $data->instances
        ]);
    }

    public function edit(Request $request)
    {

        $messages = [
            'name.required' => 'Debe ingresar el nombre.',
            'address.required' => 'Debe ingresar la dirección',
            'logo.required' => 'Debe adjuntar una imagen',
            'logo.image' => 'Solo se admiten imágenes en formato jpeg, png, bmp, gif, o svg',
            'phone.required' => 'Debe ingresar número de teléfono',
            'long_description.required' => 'Debe ingresar una descripción de tus servicios',
            'service.required' => 'Debe seleccionar al menos un servicio',
        ];
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'logo' => 'required|image',
            'long_description' => 'required',
            'service' => 'required',
        ];
        $this->validate($request, $rules, $messages);
        $file = $request->file('logo');
        $path = public_path().'/providers/logos';
        $provider = auth()->user()->instance();
        $fileName = $provider->id."-".uniqid()."-".$file->getClientOriginalName();
        $file->move($path, $fileName);

        $provider->logo = $fileName;
        $provider->name = $request->input('name');
        $provider->address = $request->input('address');
        $provider->phone = $request->input('phone');
        $provider->long_description = $request->input('long_description');
        $provider->city_id = $request->input('region');
        $provider->web = $request->input('web');
        $rut = Rut::parse($request->input('rut'))->toArray();
        $provider->rut = $rut[0];
        $provider->dv_rut = $rut[1];
        $provider->user_id = auth()->user()->id;

        $provider->save();

        $services = $request->input('service');
        for ($i=0; $i < count($services); $i++) {
            $provider_service = new ProviderService();
            $provider_service->provider_id = $provider->id;
            $provider_service->service_id = $services[$i];
            $provider_service->save();
        }

        $providerMember = new ProviderMember();
        $providerMember->provider_id = $provider->id;
        $providerMember->tecnics = $request->input('team-tecnics');
        $providerMember->professionals = $request->input('team-professionals');
        $providerMember->masters = $request->input('team-masters');
        $providerMember->doctors = $request->input('team-doctors');
        $providerMember->save();


        return redirect('providers/dashboard');
    }

    public function settings(Request $request)
    {
        return view('provider.settings',[
            'user' => auth()->user()->instance(),
            'services' => Service::get()
        ]);
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
        $provider = auth()->user()->instance();
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
        return redirect('providers/dashboard')->withSuccess( 'Datos modificados correctamente');
    }

     public function request()
     {
        $provider = auth()->user()->instance();
        $provider->status = 1;
        $provider->save();
        return redirect('providers/dashboard')->withSuccess( 'Solicitud enviada a administradores');
     }
}

