<?php

namespace App\Http\Controllers\Provider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\ProviderService;
use App\InstanceService;
use App\Service;
use App\Rules\LimitNumberImages;
use App\Instance;
use App\InstanceImage;
use App\Sector;
use App\City;
use App\Employees;
use File;

class CaseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('providers/dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sector = Sector::find(1);
        $user = auth()->user()->instance();
        $services = ProviderService::where('provider_id','=', $user->id)->get();
        foreach ($services as $service) {
            $services_provider[] = Service::where('id','=',$service->service_id)->get()->first();
        }
        return view('provider.create', [
            'services' => collect($services_provider),
            'user' => $user,
            'sectors' => Sector::get(),
            'cities' => City::get(),
            'employees' => Employees::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules(), $this->messages());
        $instanceId = $this->createInstance($request);

        $this->saveServicesOfInstance($instanceId, $request->input('service'));


        $image = $request->file('image');
        $path = public_path().'/providers/case-images/'.$instanceId.'/';
        $fileName = uniqid()."-".$image->getClientOriginalName();
        $image->move($path, $fileName);
        $instance_image = new InstanceImage;
        $instance_image->image = $fileName;
        $instance_image->instance_id = $instanceId;
        $instance_image->featured = true;
        $instance_image->save();

        $instance = Instance::find($instanceId);

        $image = $request->file('company-logo');
        $path = public_path().'/providers/case-images/'.$instanceId.'/';
        $fileName = uniqid()."-".$image->getClientOriginalName();
        $image->move($path, $fileName);
        $instance->company_logo = $fileName;
        $instance->save();

        return redirect('providers/dashboard')->withSuccess( 'Caso agregado correctamente');
    }

    private function saveServicesOfInstance($instanceId, $services)
    {
        foreach ($services as $service) {
            $instance_service = new InstanceService;
            $instance_service->instance_id = $instanceId;
            $instance_service->service_id = $service;
            $instance_service->save();
        }
    }

    private function createInstance(Request $request)
    {
        $instance = new Instance;
        $instance->provider_id = auth()->user()->instance()->id;
        $instance->classification_id = $request->input('sector');
        $instance->city_id = $request->input('region');
        $instance->employees_range = $request->input('employees');
        $instance->name = $request->input('name');
        $instance->company_name = $request->input('company_name');
        $instance->quantity = $request->input('quantity');
        $instance->unit = $request->input('unit');
        $instance->sentence = $request->input('sentence');
        $instance->long_description = $request->input('long_description');
        $instance->year = $request->input('year');
        $instance->approved = false;
        $instance->quote = $request->input('quote');
        $instance->save();
        return $instance->id;
    }

    private function rules()
    {
        return [
            'name' => 'required',
            'company_name'=> 'required',
            'quantity'=> 'required',
            'sentence'=> 'required',
            'long_description' => 'required',
            'service' => 'required',
        ];
    }

    private function messages()
    {
        return [
            'name.required' => 'Debe ingresar el nombre.',
            'images.required' => 'Debe adjuntar al menos una imagen',
            'images.image' => 'Solo se admiten imágenes en formato jpeg, png, bmp, gif, o svg',
            'long_description.required' => 'Debes ingresar una descripción detallada del caso',
            'service.required' => 'Debe seleccionar al menos un servicio',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instance = Instance::find($id);
        $user = auth()->user();
        return view('provider.show')->with(compact('instance', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sector = Sector::find(1);
        $user = auth()->user()->instance();
        $services = ProviderService::where('provider_id','=', $user->id)->get();
        foreach ($services as $service) {
            $services_provider[] = Service::where('id','=',$service->service_id)->get()->first();
        }
        return view('provider.edit', [
            'case' => Instance::find($id),
            'services' => collect($services_provider),
            'user' => $user,
            'sectors' => Sector::get(),
            'cities' => City::get(),
            'employees' => Employees::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $instance = Instance::find($id);
        $messages = [
            'name.required' => 'Debe ingresar el nombre.',
/*            'images.image' => 'Solo se admiten imágenes en formato jpeg, png, bmp, gif, o svg',*/
            'long_description.required' => 'Debes ingresar una descripción detallada del caso',
/*            'images.*.max' => 'Las imágenes no deben ser mayores a 1.5 Mb',*/
            'service.required' => 'Debe seleccionar al menos un servicio',
        ];
        $rules = [
            'name' => 'required',
            'long_description' => 'required',
/*            'images' => new LimitNumberImages($instance->images()->count()),
            'images.*' => 'required|image|max:1500',*/
            'service' => 'required',
        ];
        $this->validate($request, $rules, $messages);
        $instance->name = $request->input('name');
        $instance->company_name = $request->input('company_name');
        $instance->long_description = $request->input('long_description');
        $instance->year = $request->input('year');
        $instance->save();

        InstanceService::where('instance_id','=',$instance->id)->delete();
        $services = $request->input('service');
        foreach ($services as $service) {
            $instance_service = new InstanceService;
            $instance_service->instance_id = $instance->id;
            $instance_service->service_id = $service;
            $instance_service->save();
        }

/*        $images = $request->file('images');
        foreach ($images as $key => $image) {
            $path = public_path().'/providers/cases/'.$instance->id.'/';
            $fileName = uniqid()."-".$image->getClientOriginalName();
            $image->move($path, $fileName);
            $instance_image = new InstanceImage;
            $instance_image->image = $fileName;
            $instance_image->instance_id = $instance->id;
            if($key == 0)
                $instance_image->featured = true;
            $instance_image->save();
        }*/
        return redirect('provider/cases')->withSuccess( 'Caso modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instance = Instance::find($id);
        $instance->delete();
    }

}