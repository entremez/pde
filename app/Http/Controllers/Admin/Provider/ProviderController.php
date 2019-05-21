<?php

namespace App\Http\Controllers\Admin\Provider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provider;
use App\User;
use App\ProviderBuffer;
use App\ProviderMember;
use App\ProviderRegion;
use App\ProviderService;
use App\ProviderMemberBuffer;
use App\ProviderRegionBuffer;
use App\ProviderServiceBuffer;
use App\Instance;
use App\InstanceImage;
use App\InstanceBuffer;
use App\InstanceService;
use App\InstanceServiceBuffer;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentToProvider;
use App\Mail\RegisterProviderSuccess;
use App\Mail\CreateCaseSuccess;
use App\ProviderComment;

class ProviderController extends Controller
{
    public function approveProvider(Request $request)
    {
        $provider = Provider::find($request->input('id'));
        $provider->approved = true;
        $provider->save();
        $user = User::find($provider->user_id);
        Mail::send(new RegisterProviderSuccess($user));
        ProviderComment::where('provider_id', $provider->id)->delete();
        return response()->json($provider);
    }

    public function deleteProvider(Request $request)
    {
        $provider = Provider::find($request->input('id'));
        $provider->delete();
        return response()->json($provider);
    }

    public function approveInstance(Request $request)
    {
        $instance = Instance::find($request->input('id'));
        $instance->approved = true;
        $instance->save();
        Mail::send(new CreateCaseSuccess($instance, 2));
        $response[] = $instance;
        $response[] = $instance->provider()->first()->name;
        ProviderComment::where('instance_id', $instance->id)->delete();
        return response()->json($response);
    }

    public function deleteInstance(Request $request)
    {
        $instance = Instance::find($request->input('id'));
        $instance->delete();
        $response[] = $instance;
        return response()->json($response);
    }

    public function approveInstanceBuffered(Request $request)
    {
        $instanceBuffered = InstanceBuffer::find($request->input('id'));
        $instance = $this->updateInstance($instanceBuffered);
        $response[] = $instance;
        $response[] = $instance->provider()->first()->name;
        return response()->json($response);
    }

    public function approveProviderBuffered(Request $request)
    {
        $providerBuffered = ProviderBuffer::find($request->input('id'));
        $provider = $this->updateProvider($providerBuffered);
        ProviderComment::where('provider_id', $provider->id)->delete();
        return response()->json($provider);
    }

    public function providerBuffered(Provider $provider)
    {
        $providerBuffered = ProviderBuffer::where('provider_id', $provider->id)->first();

        return view('provider-buffered',[
            'provider' => $provider,
            'providerBuffered' => $providerBuffered,
            'serviceBuffered' => $providerBuffered->allServicesJson,
            'service' => $provider->allServicesJson,
            ]);
    }

    private function updateInstance(InstanceBuffer $instanceBuffered)
    {
        $instance = $instanceBuffered->instance;
        $instance->classification_id = $instanceBuffered->classification_id;
        $instance->city_id = $instanceBuffered->city_id;
        $instance->employees_range = $instanceBuffered->employees_range;
        $instance->business_type = $instanceBuffered->business_type;
        $instance->name = $instanceBuffered->name;
        $instance->company_name = $instanceBuffered->company_name;
        $instance->company_logo = $instanceBuffered->company_logo;
        $instance->quantity = $instanceBuffered->quantity;
        $instance->unit = $instanceBuffered->unit;
        $instance->sentence = $instanceBuffered->sentence;
        $instance->long_description = $instanceBuffered->long_description;
        $instance->quote = $instanceBuffered->quote;
        $instance->year = $instanceBuffered->year;
        $instance->status = 0;
        $instance->save();

        InstanceService::where('instance_id', $instance->id)->delete();
        $servicesBuffered = InstanceServiceBuffer::where('instance_id', $instance->id)->get();
        foreach ($servicesBuffered as $service) {
            $newService = new InstanceService();
            $newService->instance_id = $service->instance_id;
            $newService->service_id = $service->service_id;
            $newService->save();
        }

        
        $instanceImage = InstanceImage::where('instance_id', $instance->id)->where('featured', true)->first();
        if($instanceImage != null){
            $instanceImage->featured = false;
            $instanceImage->save();
        }

        $instanceImage = new InstanceImage();
        $instanceImage->image = $instanceBuffered->image;
        $instanceImage->instance_id = $instance->id;
        $instanceImage->featured = true;
        $instanceImage->save();

        InstanceServiceBuffer::where('instance_id', $instance->id)->delete();
        InstanceBuffer::where('instance_id', $instance->id)->delete();
        return $instance;
    }

    private function updateProvider(ProviderBuffer $providerBuffered)
    {
        $provider = $providerBuffered->provider();
        $provider->rut = $providerBuffered->rut;
        $provider->dv_rut = $providerBuffered->dv_rut;
        $provider->name = $providerBuffered->name;
        $provider->address = $providerBuffered->address;
        $provider->phone = $providerBuffered->phone;
        $provider->web = $providerBuffered->web;
        $provider->mail = $providerBuffered->mail;
        $provider->logo = $providerBuffered->logo;
        $provider->long_description = $providerBuffered->long_description;
        $provider->city_id = $providerBuffered->city_id;
        $provider->commune_id = $providerBuffered->commune_id;
        $provider->status = 0;
        $provider->save();

        $providerMember = ProviderMember::where('provider_id', $provider->id)->first();
        $providerMemberBuffered = ProviderMemberBuffer::where('provider_id', $provider->id)->first();

        $providerMember->tecnics = $providerMemberBuffered->tecnics;
        $providerMember->professionals = $providerMemberBuffered->professionals;
        $providerMember->masters = $providerMemberBuffered->masters;
        $providerMember->doctors = $providerMemberBuffered->doctors;
        $providerMember->save();

        $providerMemberBuffered = ProviderMemberBuffer::where('provider_id', $provider->id)->delete();


        ProviderRegion::where('provider_id', $provider->id)->delete();

        $providerRegionBuffered = ProviderRegionBuffer::where('provider_id', $provider->id)->get();
        foreach ($providerRegionBuffered as $region) {
            $newRegion = new ProviderRegion();
            $newRegion->provider_id = $region->provider_id;
            $newRegion->city_id = $region->city_id;
            $newRegion->save();
        }

        ProviderRegionBuffer::where('provider_id', $provider->id)->delete();

        ProviderService::where('provider_id', $provider->id)->delete();

        $providerServiceBuffered = ProviderServiceBuffer::where('provider_id', $provider->id)->get();
        foreach ($providerServiceBuffered as $service) {
            $newService = new ProviderService();
            $newService->provider_id = $service->provider_id;
            $newService->service_id = $service->service_id;
            $newService->save();
        }

        ProviderServiceBuffer::where('provider_id', $provider->id)->delete();


        ProviderBuffer::where('provider_id', $provider->id)->delete();
        return $provider;
    }

    public function sendCommentsToProvider(Request $request)
    {
        $type = $request->input('type');
        if(ProviderComment::where('provider_id', $request->input('id'))->where('type', $type)->get()->count() == 0)
        {
            $comment = new ProviderComment();
            $comment->provider_id = $request->input('id');        
            $comment->type = $type;
            if($type == 2){
                $comment->instance_id = $request->input('instance_id');
            }

        }else{
            $comment = ProviderComment::where('provider_id', $request->input('id'))->where('type', $type)->first();
        }

        $comment->admin_id = auth()->user()->instance()->id;
        $comment->message = $request->input('message');
        $comment->status = 1;
        $comment->save();

        Mail::send(new CommentToProvider($request->input('mail'), $request->input('message'), $type, $request->input('subject')));
        return response()->json(['status' => '1', 'type' => $type]);
    }
}
