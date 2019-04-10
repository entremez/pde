<?php

namespace App\Http\Controllers\Provider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Service;
use App\Provider;
use App\ProviderService;
use App\ProviderRegion;
use App\ProviderServiceBuffer;
use App\ProviderRegionBuffer;
use App\ProviderBuffer;
use File;
use App\City;
use App\Category;
use App\ProviderMember;
use App\ProviderMemberBuffer;
use Freshwork\ChileanBundle\Rut;
use App\Commune;
use App\Mail\RegisterSuccess;
use App\Mail\ProviderChange;
use Illuminate\Support\Facades\Mail;
use App\ProviderComment;
use App\User;

class ProviderController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
            return response()->json($this->getCommunes($request->input('id')));

        $user = auth()->user();
        $services = Service::get();
        $cities = City::get();
        $categories = Category::get();
        $provider = $user->instance();
        if(is_null($provider))
            return view('provider.config-dashboard')->with(compact('user', 'services', 'cities', 'categories'));            
        $data = $this->getData($provider, $user);
        $services = $this->getServices($provider);
        return view('provider.dashboard',[
            'user' => $user,
            'personalData'=> $data,
            'data'=> $provider,
            'services' => $services,
            'instances' => $provider->instances
        ]);
    }

    private function getData($provider, $user)
    {
        return $provider->status == 0 ? $user->instance():ProviderBuffer::where('provider_id',$provider->id)->first();
    }

    private function getServices($provider)
    {
        return $provider->status == 0 ? ProviderService::where('provider_id',$provider->id)->get(): ProviderServiceBuffer::where('provider_id',$provider->id)->get();
    }

    public function create(Request $request)
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
        $provider = $this->getProvider(auth()->user());
        $file = $request->file('logo');
        $path = public_path().'/providers/logos';
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

        $regions = $request->input('regions');
        for ($i=0; $i < count($regions); $i++) {
            $providerRegion = new ProviderRegion();
            $providerRegion->provider_id = $provider->id;
            $providerRegion->city_id = $regions[$i];
            $providerRegion->save();
        }

        Mail::send(new RegisterSuccess(auth()->user()));
        Mail::send(new ProviderChange(1, $provider->name));

        return redirect('providers/dashboard');
    }

    private function getProvider(User $user)
    {
        $provider = Provider::create([
            'user_id' => $user->id,
        ]);
        $user ->type_id = $provider->id;
        $user->save();
        return $provider;
    }

    public function settings(Request $request)
    {
        return view('provider.settings',[
            'data' => auth()->user()->instance()->status == 0 ? auth()->user()->instance():ProviderBuffer::where('provider_id',auth()->user()->instance()->id)->first(),
            'services' => Service::get(),
            'cities' => City::get(),
            'categories' => Category::get(),
            'communes' => Commune::where('city_id', auth()->user()->instance()->city_id)->orderBy('commune')->get()
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

        if(ProviderBuffer::where('provider_id',$provider->id)->count() > 0){
            $providerBuffer = ProviderBuffer::where('provider_id',$provider->id)->first();
        }else{
            if(!$provider->approved){
                $this->updatePreviousApproval($provider, $request);
                Mail::send(new ProviderChange(3, $provider->name));
                return redirect()->route('provider.dashboard');
            }
            $providerBuffer = new ProviderBuffer();
            $providerBuffer->provider_id = $provider->id;
            $providerBuffer->logo = $provider->logo;
        }

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = public_path().'/providers/logos';
            $fileName = $provider->id."-".uniqid()."-".$file->getClientOriginalName();
            $file->move($path, $fileName);
            $providerBuffer->logo = $fileName;
        }

        $providerBuffer->name = $request->input('name');
        $providerBuffer->address = $request->input('address');
        $providerBuffer->phone = $request->input('phone');
        $providerBuffer->long_description = $request->input('long_description');
        $providerBuffer->city_id = $request->input('region');
        $providerBuffer->commune_id = $request->input('commune');
        $providerBuffer->web = $request->input('web');
        $rut = Rut::parse($request->input('rut'))->toArray();
        $providerBuffer->rut = $rut[0];
        $providerBuffer->dv_rut = $rut[1];
        $providerBuffer->save();

        $services = $request->input('service');

        ProviderServiceBuffer::where('provider_id','=',$provider->id)->delete();
        for ($i=0; $i < count($services); $i++) {
            $providerServiceBuffer = new ProviderServiceBuffer();
            $providerServiceBuffer->provider_id = $provider->id;
            $providerServiceBuffer->service_id = $services[$i];
            $providerServiceBuffer->save();
        }

        $regions = $request->input('regions');
        ProviderRegionBuffer::where('provider_id','=',$provider->id)->delete();
        for ($i=0; $i < count($regions); $i++) {
            $providerRegionBuffer = new ProviderRegionBuffer();
            $providerRegionBuffer->provider_id = $provider->id;
            $providerRegionBuffer->city_id = $regions[$i];
            $providerRegionBuffer->save();
        }

        if(ProviderMemberBuffer::where('provider_id', $provider->id)->count() > 0){
            $providerMemberBuffer = ProviderMemberBuffer::where('provider_id', $provider->id)->first();
        }else{
            $providerMemberBuffer = new ProviderMemberBuffer();
            $providerMemberBuffer->provider_id = $provider->id;
        }

        $providerMemberBuffer->tecnics = $request->input('team-tecnics');
        $providerMemberBuffer->professionals = $request->input('team-professionals');
        $providerMemberBuffer->masters = $request->input('team-masters');
        $providerMemberBuffer->doctors = $request->input('team-doctors');
        $providerMemberBuffer->save();
        $provider->status = 1;
        $provider->save();

        $this->statusComments($provider);


        Mail::send(new ProviderChange(3, $provider->name));


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

     private function updatePreviousApproval($provider, $request)
     {
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
        $provider->save();

        $services = $request->input('service');

        ProviderService::where('provider_id','=',$provider->id)->delete();
        for ($i=0; $i < count($services); $i++) {
            $providerService = new ProviderService();
            $providerService->provider_id = $provider->id;
            $providerService->service_id = $services[$i];
            $providerService->save();
        }

        $regions = $request->input('regions');
        ProviderRegion::where('provider_id','=',$provider->id)->delete();
        for ($i=0; $i < count($regions); $i++) {
            $providerRegion = new ProviderRegion();
            $providerRegion->provider_id = $provider->id;
            $providerRegion->city_id = $regions[$i];
            $providerRegion->save();
        }

        if(ProviderMember::where('provider_id', $provider->id)->count() > 0){
            $providerMember = ProviderMember::where('provider_id', $provider->id)->first();
        }else{
            $providerMember = new ProviderMember();
            $providerMember->provider_id = $provider->id;
        }

        $providerMember->tecnics = $request->input('team-tecnics');
        $providerMember->professionals = $request->input('team-professionals');
        $providerMember->masters = $request->input('team-masters');
        $providerMember->doctors = $request->input('team-doctors');
        $providerMember->save();
        $provider->save();

        $this->statusComments($provider);
     }

     private function statusComments($provider)
     {
         if( $provider->hasComments() ){
            $comments = ProviderComment::where('provider_id',$provider->id)
                                        ->where('status', 1)->first();
            $comments->status = 2;
            $comments->save();

            Mail::send(new ProviderChange(3, auth()->user()->instance()->name));
         }

     }
}