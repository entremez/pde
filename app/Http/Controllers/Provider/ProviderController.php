<?php

namespace App\Http\Controllers\Provider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Service;
use App\ProviderService;
use App\ProviderRegion;
use File;
use App\City;
use App\Category;
use App\ProviderMember;
use Freshwork\ChileanBundle\Rut;
use App\Commune;

class ProviderController extends Controller
{
    public function index(Request $request)
    {

        if($request->ajax())
            return response()->json($this->getCommunes($request->input('id')));

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
        $provider->commune_id = $request->input('commune');
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
            'data' => auth()->user()->instance(),
            'services' => Service::get(),
            'cities' => City::get(),
            'categories' => Category::get(),
            'communes' => Commune::where('city_id', auth()->user()->instance()->city_id)->get()
        ]);
    }

    public function update(Request $request){
        $messages = [
            'name.required' => 'Debe ingresar el nombre.',
            'address.required' => 'Debe ingresar la dirección',
            'logo.image' => 'Solo se admiten imágenes en formato jpeg, png, bmp, gif, o svg',
            'phone.required' => 'Debe ingresar número de teléfono',
            'long_description.required' => 'Debe ingresar una descripción de tus servicios',
            'service.required' => 'Debe seleccionar al menos un servicio',
        ];
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'logo' => 'image|max:1500',
            'long_description' => 'required',
            'service' => 'required',
        ];
        $this->validate($request, $rules, $messages);
        $provider = auth()->user()->instance();
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = public_path().'/providers/logos';
            $fileName = $provider->id."-".uniqid()."-".$file->getClientOriginalName();
            $file->move($path, $fileName);
            $provider->logo = $fileName;
        }
        $provider->name = $request->input('name');
        $provider->address = $request->input('address');
        $provider->phone = $request->input('phone');
        $provider->long_description = $request->input('long_description');
        $provider->city_id = $request->input('region');
        $provider->commune_id = $request->input('commune');
        $provider->web = $request->input('web');
        $rut = Rut::parse($request->input('rut'))->toArray();
        $provider->rut = $rut[0];
        $provider->dv_rut = $rut[1];
        $provider->approved = false;
        $provider->save();

        $services = $request->input('service');
        ProviderService::where('provider_id','=',$provider->id)->delete();
        for ($i=0; $i < count($services); $i++) {
            $provider_service = new ProviderService();
            $provider_service->provider_id = $provider->id;
            $provider_service->service_id = $services[$i];
            $provider_service->save();
        }

        $regions = $request->input('regions');
        ProviderRegion::where('provider_id','=',$provider->id)->delete();
        for ($i=0; $i < count($regions); $i++) {
            $provider_region = new ProviderRegion();
            $provider_region->provider_id = $provider->id;
            $provider_region->city_id = $regions[$i];
            $provider_region->save();
        }

        $providerMember = ProviderMember::where('provider_id', $provider->id)->first();
        $providerMember->tecnics = $request->input('team-tecnics');
        $providerMember->professionals = $request->input('team-professionals');
        $providerMember->masters = $request->input('team-masters');
        $providerMember->doctors = $request->input('team-doctors');
        $providerMember->save();
        return redirect('providers/dashboard')->withSuccess( 'Datos modificados correctamente');
    }

     public function request()
     {
        $provider = auth()->user()->instance();
        $provider->status = 1;
        $provider->save();
        return redirect('providers/dashboard')->withSuccess( 'Solicitud enviada a administradores');
     }

     public function getCommunes($id)
     {
        return Commune::where('city_id', $id)->orderBy('commune', 'asc')->get();
     }
}

