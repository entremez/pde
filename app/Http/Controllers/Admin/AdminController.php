<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Provider;
use App\ProviderBuffer;
use App\Company;
use App\Instance;
use App\InstanceBuffer;
use App\CompanySurvey;
use App\City;
use App\MailBody;
use App\User;
use App\Option;
use App\InstanceImage;
use Charts;
use App\Statement;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentToUser;
use App\Link;
use File;
use App\RecommendedService;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/dashboard', [
            'instances' => Instance::get(),
            'instancesApproved' => Instance::approved(),
            'instancesWaitingForApproval' => Instance::pendingForApproval(),
            'intancesBuffered' => InstanceBuffer::get(),
            'providers' => Provider::get(),
            'providersApproved' => Provider::where('approved', true)->get(),
            'providersWaitinfForApproval' => Provider::where('approved', false)->where('rut', '!=' , '')->get(),
            'providersBuffered' => ProviderBuffer::get(),
            'usersWithoutProfile' => User::where('type_id', null)->get()
        ]);
    }

    public function instanceFeatured(Request $request)
    {
        $instance = Instance::find($request->input('id'));
        $instance->featured = !$instance->featured;
        $instance->save();
        return ;
    }

    public function mails()
    {
        return view('admin/mails', [
            'mail_body' => MailBody::first()
        ]);
    }

    public function mailsStore(Request $request)
    {
        $mail = MailBody::first();
        $mail->new_provider = $request->input('new_provider');
        $mail->provider_approved = $request->input('provider_approved');
        $mail->new_instance = $request->input('new_instance');
        $mail->instance_approved = $request->input('instance_approved');
        $mail->user_without_profile = $request->input('user_without_profile');
        $mail->save();
        return redirect()->back();
    }

    public function userWithoutProfile(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->updated_at = now();
        $user->save();
        Mail::send(new CommentToUser($user, 1));
        return response()->json([
                        'id' => $request->input('id'),
                        'time' => date('d-m-Y', strtotime(now()))
                    ]);
    }

    public function userIgnore(Request $request)
    {
        User::where('id' , $request->input('id'))->delete();
        return ;
    }

    public function statistics()
    {
        City::countRegionf();
        return view('admin/statistics', [
            'companies' => Company::where('id','!=', 1)->where('id','!=', 2)->where('id','!=', 9)->get(),
            'regions' => City::countRegion(),
            'regions_qty' => City::countRegionQty(),
            'regions_qtyf' => City::countRegionf(),
            'statements' => Statement::all(),
            'uno' => Option::getResponse(1),
            'dos' => Option::getResponse(2),
            'tres' => Option::getResponse(3),
            'cuatro' => Option::getResponse(4),
        ]);
    }

    public function download(Instance $instance, $type) // type 1 = imagen de caso, 2 = proveedor, 3 = mandante
    {
        switch ($type) {
            case 1:
                $images = InstanceImage::where('instance_id', $instance->id)->where('featured', true)->get()->first();
                $filepath = public_path('providers/case-images/'.$instance->id.'/'.$images->image);
                break;
            case 2:
                $provider = $instance->provider()->get()->first();
                $filepath = public_path('providers/logos/'.$provider->logo);
                break;
            case 3:
                $filepath = public_path('providers/case-images/'.$instance->id.'/'.$instance->company_logo);
                break;
        }
        return response()->download($filepath);
    }

    public function showResources()
    {
        return view('resources-show',[
            'links' => Link::all()
        ]);
    }

    public function updateResources(Request $request)
    {
        if(is_null($request->input('id'))){
            $link = new Link();
        }else{
            $link = Link::find($request->input('id'));
        }
        if(!is_null($request->file('image'))){
            $file = $request->file('image');
            $path = public_path().'/images/links';
            $fileName = uniqid()."-".$file->getClientOriginalName();
            $file->move($path, $fileName);
            $link->image = $fileName;
        }
        $link->title = $request->input('title');
        $link->description = $request->input('description');
        if(!is_null($request->file('document'))){
            $file = $request->file('document');
            $path = public_path().'/documents';
            $fileName = uniqid()."_".$file->getClientOriginalName();
            $file->move($path, $fileName);
            $link->link = $path.'/'.$fileName;
        }else{
            $link->link = $request->input('link');
        }
        $link->save();
        return redirect()->back();
    }

    public function showSurvey()
    {
        return view('survey-show',[
            'statements' => Statement::orderBy('id', 'asc')->get()
        ]);
    }

    public function updateSurvey(Request $request)
    {
        $statement = Statement::find($request->input('id'));
        $statement->statement = $request->input('statement');
        if(!is_null($request->file('image'))){
            $file = $request->file('image');
            $path = public_path().'/images';
            $fileName = uniqid()."_".$file->getClientOriginalName();
            $file->move($path, $fileName);
            $statement->background = $fileName;
        }
        $statement->save();

        foreach ($request->input('option') as $key => $value) {
            $option = Option::find($key);
            $option->option = $value;
            $option->save();
        }

        return redirect()->back();
    }

    public function showRecommendation()
    {
        return view('recommendation-show',[
            'recommendations' => RecommendedService::get(),
            'areas' => [4 => 'Innovación', 5 => 'Operación', 6 => 'Productos o Servicios', 7 => 'Venta y Post-Venta'],
            'spans' => [6, 3, 5, 5]
        ]);
    }
}
