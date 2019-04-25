<?php

namespace App\Http\Controllers\Provider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\ProviderService;
use App\InstanceService;
use App\InstanceServiceBuffer;
use App\Service;
use App\Rules\LimitNumberImages;
use App\Instance;
use App\InstanceBuffer;
use App\InstanceImage;
use App\Sector;
use App\City;
use App\Employees;
use App\BusinessType;
use File;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreateCaseSuccess;
use App\ProviderComment;
use App\Mail\ProviderChange;

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
            'employees' => Employees::get(),
            'businesses' => BusinessType::get()
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

        Mail::send(new CreateCaseSuccess($instance, 1));

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
        $instance->business_type = $request->input('business');
        $instance->quantity = $request->input('quantity');
        $instance->unit = $request->input('unit');
        $instance->sentence = $request->input('sentence');
        $instance->long_description = $request->input('long_description');
        $instance->year = $request->input('year');
        $instance->approved = false;
        $instance->quote = $request->input('quote');
        $instance->name_quote = $request->input('name_quote');
        $instance->position_quote = $request->input('position_quote');
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
            'case' => Instance::find($id)->status == 0 ? Instance::find($id):InstanceBuffer::where('instance_id',$id)->first(),
            'services' => collect($services_provider),
            'user' => $user,
            'sectors' => Sector::get(),
            'cities' => City::get(),
            'employees' => Employees::get(),
            'businesses' => BusinessType::get(),
            'identifier' => $id
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

        if(InstanceBuffer::where('instance_id',$instance->id)->count() > 0){
            $buffer = InstanceBuffer::where('instance_id',$id)->first();
        }else{
            if(!$instance->approved){
                $this->updatePreviousApproval($instance, $request);
                return redirect()->route('provider.dashboard');
            }
            $buffer = new InstanceBuffer();
            $buffer->image = $instance->my_image;
            $buffer->instance_id = $id;
            $buffer->company_logo = $instance->company_logo;
        }
        $buffer->classification_id = $request->input('sector');
        $buffer->city_id = $request->input('region');
        $buffer->employees_range = $request->input('employees');
        $buffer->name = $request->input('name');
        $buffer->company_name = $request->input('company_name');
        $buffer->quantity = $request->input('quantity');
        $buffer->unit = is_null($request->input('unit'))?'':$request->input('unit');
        $buffer->sentence = $request->input('sentence');
        $buffer->Business_type = $request->input('business');
        $buffer->long_description = $request->input('long_description');
        $buffer->year = $request->input('year');
        $buffer->quote = $request->input('quote');
        $buffer->name_quote = $request->input('name_quote');
        $buffer->position_quote = $request->input('position_quote');


        if(!is_null($request->file('company-logo'))){
            $image = $request->file('company-logo');
            $path = public_path().'/providers/case-images/'.$id.'/';
            $fileName = uniqid()."-".$image->getClientOriginalName();
            $image->move($path, $fileName);
            $buffer->company_logo = $fileName;
        }

        if(InstanceServiceBuffer::where('instance_id','=',$instance->id)->count() > 0)
            $servicesBuffer = InstanceServiceBuffer::where('instance_id','=',$instance->id)->delete();
        $services = $request->input('service');
        foreach ($services as $service) {
            $instance_service = new InstanceServiceBuffer();
            $instance_service->instance_id = $instance->id;
            $instance_service->service_id = $service;
            $instance_service->save();
        }

        if(!is_null($request->file('image'))){
//            $instance_image = InstanceImage::where('instance_id', $id)->delete();
            $images = $request->file('image');$image = $request->file('image');
            $path = public_path().'/providers/case-images/'.$id.'/';
            $fileName = uniqid()."-".$image->getClientOriginalName();
            $image->move($path, $fileName);
            $buffer->image = $fileName;
        }
        $buffer->save();
        $instance->status = 1;
        $instance->save();
        return redirect()->route('provider.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $instance = Instance::find($request->input('id'));
        $instance->delete();

    }

    private function updatePreviousApproval($instance, $request)
    {
        $instance->classification_id = $request->input('sector');
        $instance->city_id = $request->input('region');
        $instance->employees_range = $request->input('employees');
        $instance->name = $request->input('name');
        $instance->company_name = $request->input('company_name');
        $instance->quantity = $request->input('quantity');
        $instance->unit = is_null($request->input('unit'))?'':$request->input('unit');
        $instance->sentence = $request->input('sentence');
        $instance->Business_type = $request->input('business');
        $instance->long_description = $request->input('long_description');
        $instance->year = $request->input('year');
        $instance->quote = $request->input('quote');
        $instance->name_quote = $request->input('name_quote');
        $instance->position_quote = $request->input('position_quote');


        if(!is_null($request->file('company-logo'))){
            $image = $request->file('company-logo');
            $path = public_path().'/providers/case-images/'.$instance->id.'/';
            $fileName = uniqid()."-".$image->getClientOriginalName();
            $image->move($path, $fileName);
            $instance->company_logo = $fileName;
        }

        if(InstanceServiceBuffer::where('instance_id','=',$instance->id)->count() > 0)
            $servicesBuffer = InstanceServiceBuffer::where('instance_id','=',$instance->id)->delete();
        $services = $request->input('service');
        foreach ($services as $service) {
            $instance_service = new InstanceServiceBuffer();
            $instance_service->instance_id = $instance->id;
            $instance_service->service_id = $service;
            $instance_service->save();
        }


        if(!is_null($request->file('image'))){
            $image = $request->file('image');
            $path = public_path().'/providers/case-images/'.$instance->id.'/';
            $fileName = uniqid()."-".$image->getClientOriginalName();
            $image->move($path, $fileName);
            InstanceImage::where('instance_id', $instance->id)->delete();
            $instance_image = new InstanceImage;
            $instance_image->image = $fileName;
            $instance_image->instance_id = $instance->id;
            $instance_image->featured = true;
            $instance_image->save();
        }

        InstanceService::where('instance_id', $instance->id)->delete();
        $this->saveServicesOfInstance($instance->id, $request->input('service'));
        $instance->save();

        $this->statusComments($instance);
    }

     private function statusComments($instance)
     {
         if( $instance->hasComments() ){
            $comments = ProviderComment::where('instance_id',$instance->id)
                                        ->where('type', 2)
                                        ->where('status', 1)->first();
            if($comments != null){
                $comments->status = 2;
                $comments->save();

                Mail::send(new ProviderChange(4, auth()->user()->instance()->name));
            }else{

            }
         }

     }    

}