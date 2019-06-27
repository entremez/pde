<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
use Charts;
use App\Statement;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentToUser;

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
        return view('admin/statistics', [
            'companies' => Company::where('id','!=', 1)->where('id','!=', 2)->where('id','!=', 9)->get(),
            'regions' => City::countRegion(),
            'statements' => Statement::all()
        ]);
    }

}
