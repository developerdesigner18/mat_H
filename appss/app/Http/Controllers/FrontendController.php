<?php

namespace App\Http\Controllers;

use App\Models\ContactSection;
use App\Models\LandingPage;
use App\Models\PrivacyPolicy;
use App\Models\Setting;
use App\Models\SubscriptionPlan;
use App\Models\Terms;
use App\Supports\UpdateSupport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    //
    public function __construct()
    {
        parent::__construct();

        $this->middleware(function ($request, $next) {
            $super_settings = [];

            $super_settings_data = Setting::where('workspace_id',1)->get();
            foreach ($super_settings_data as $super_setting)
            {
                $super_settings[$super_setting->key] = $super_setting->value;
            }

            $this->super_settings = $super_settings;
            View::share("super_settings", $super_settings);
            return $next($request);
        });
    }

    public function home()
    {


        $current_build_id = config('app.build_id',1);
        $installed_build_id = $this->super_settings['installed_build_id'] ?? 0;

        if($current_build_id != $installed_build_id)
        {
            $current_build_id = config('app.build_id',1);
            UpdateSupport::updateSchema();
            $setting = Setting::where('workspace_id',1)
                ->where('key','installed_build_id')
                ->first();
            if(!$setting)
            {
                $setting = new Setting();
                $setting->workspace_id = 1;
                $setting->key = 'installed_build_id';
            }

            $setting->value = $current_build_id;
            $setting->save();
        }

        $landingpage = LandingPage::first();
        $contact = ContactSection::first();




        if(($this->super_settings['landingpage'] ?? null) === 'Default'){

            return \view('frontend.home',[

                'landingpage' =>  $landingpage,
                'contact' =>  $contact,
            ]);
        }

        return \view('auth.login',[

            'landingpage' =>  $landingpage,
            'contact' =>  $contact,
        ]);




    }



    public function privacy()
    {
        $plans = SubscriptionPlan::all();
        $privacy = PrivacyPolicy::first();
        $contact = ContactSection::first();

        return \view('frontend.privacy',[
            'plans'=> $plans,
            'privacy'=> $privacy,
            'contact' =>  $contact,

        ]);
    }

    public function termsCondition()
    {
        $plans = SubscriptionPlan::all();
        $term = Terms::first();
        $contact = ContactSection::first();

        return \view('frontend.terms',[
            'plans'=> $plans,
            'term'=> $term,
            'contact' =>  $contact,

        ]);
    }




    public function contact()
    {
        return \view("frontend.contact");
    }


    public function pricing()
    {
        $plans = SubscriptionPlan::all();
        $contact = ContactSection::first();

        return \view("frontend.pricing", [
            "plans" => $plans,
            'contact' =>  $contact,
        ]);
    }
}
