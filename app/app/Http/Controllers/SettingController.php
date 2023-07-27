<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\SmsProvider;
use App\Models\SubscriptionPlan;
use App\Models\Workspace;
use Doctrine\Inflector\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SettingController extends BaseController
{
    public function settings()
    {
        $workspace = Workspace::find($this->user->workspace_id);

        return \view("settings.settings", [
            "selected_navigation" => "settings",
            "workspace" => $workspace,
        ]);
    }

    public function settingsPost(Request $request)
    {
        if (config("app.environment") !== "demo") {

            $request->validate([
                "workspace_name" => "required|max:150",
                "logo" => "nullable|file|mimes:jpg,png",
                'currency' => 'nullable|string|size:3',
                'landingpage' => 'nullable',

            ]);

            $workspace = Workspace::find($this->user->workspace_id);

            $workspace->name = $request->workspace_name;
            $workspace->save();

            Setting::updateSettings($this->workspace->id,'landingpage',$request->landingpage);

            Setting::updateSettings($this->workspace->id,'currency',$request->currency);


            if($request->logo)
            {
                $path = $request->file('logo')->store('media', 'uploads');
                Setting::updateSettings($this->workspace->id,'logo',$path);
            }

            if($this->user->super_admin)
            {
                $free_trial_days = $request->free_trial_days ?? 0;
                Setting::updateSettings($this->workspace->id,'free_trial_days',$free_trial_days);
                return redirect('/super-admin-setting');
            }

            return redirect("/settings");


        }


    }

    public function billing()
    {
        $plans= SubscriptionPlan::all();

        $workspace = Workspace::find($this->user->workspace_id);

        $plan = null;

        if($workspace->plan_id)
        {
            $plan = SubscriptionPlan::find($workspace->plan_id);
        }


        return \view("settings.billing", [
            "selected_navigation" => "billing",
            "plans" => $plans,
            "plan" => $plan,
        ]);
    }


    public function activateLicensePost(Request $request)
    {
        $request->validate([
            'purchase_code' => 'required'
        ]);

        Setting::updateSettings($this->workspace->id,'purchase_code',$request->purchase_code);

        //Verify purchase code
        $purchase_code = $request->purchase_code;
        $response = Http::withOptions([
            'verify' => false,
        ])
            ->post('https://app.stackpie.com/v4/verify-envato-purchase/1/1767534b-a674-4925-a316-2305050198e7',[
            'purchase_code' => $purchase_code,
            'app_url' => config('app.url'),
            'item_id' => '36660668',
            'client_ip' => getClientIP(),
        ])
            ->json();

        if(empty($response))
        {
            return redirect('/activate')->with('error','An error occurred while trying to verify your purchase code. Please try again later, or contact support if the problem persists.');
        }

        if(!empty($response['success']))
        {
            $license_data = $response['license_data'];
            foreach ($license_data as $key => $value)
            {
                Setting::updateSettings($this->workspace->id,$key,$value);
            }

            return redirect(config('app.url').'/super-admin/dashboard')->with('success','Your license has been activated successfully.');
        }

        if(!empty($response['errors']))
        {
            return redirect('/activate')->withErrors($response['errors']);
        }

        return redirect("/activate");
    }
//




}
