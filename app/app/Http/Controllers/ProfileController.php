<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Redirect;

class ProfileController extends BaseController
{
    public function profile(Request $request)
    {
        $available_languages = User::$available_languages;

        return \view("profile.profile", [
            "selected_navigation" => "profile",
            "available_languages" => $available_languages,
        ]);
    }

    public function profilePost(Request $request)
    {
        $request->validate([
            "first_name" => "nullable|string|max:100",
            "last_name" => "nullable|string|max:100",
            "photo" => "nullable|file|mimes:jpg,png",
            "cover_photo" => "nullable|file",
        ]);

        $user = $this->user;

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->language = $request->language;
        $path = null;
        if ($request->photo) {
            $path = $request->file("photo")->store("media", "uploads");

        }
        if (!empty($path)) {
            $user->photo = $path;
        }



        $cover_path = null;

        if ($request->cover_photo) {
            $cover_path = $request
                ->file("cover_photo")
                ->store("media", "uploads");
        }

        if (!empty($cover_path)) {
            $user->cover_photo = $cover_path;
        }

        $user->phone_number = $request->phone_number;

        if($request->timezone)
        {
            $user->timezone = $request->timezone;
            $user->save();
        }
        $user->save();

        if ($this->user->super_admin) {
            return redirect("/super-admin-profile");
        }

        return redirect("/profile");
    }

    public function staff()
    {
        $staffs = User::where("workspace_id", $this->user->workspace_id)->get();
        $workspace = Workspace::find($this->user->workspace_id);

        $maximum_allowed_users = Workspace::getMaximumAllowedUsers($this->workspace);
        $users_count_on_this_workspace = Workspace::usersCount($this->workspace->id);
        $plan = Workspace::getPlan($this->workspace);

        return \view("profile.staff", [
            "selected_navigation" => "team",
            "staffs" => $staffs,
            'workspace' => $workspace,
            'plan' => $plan,
            'maximum_allowed_users' => $maximum_allowed_users,
            'users_count_on_this_workspace' => $users_count_on_this_workspace,
        ]);
    }

    public function getstaffdata(Request $request)
    {
        if($request->id != '')
        {
            $staffs = User::where("id", $request->id)->first();

            if($staffs)
            {
                return response()->json($staffs);
            }
        }
    }

    public function updatepermition(Request $request)
    {
        $getdata = User::where('id',$request->id)->first();

        // 
        if($getdata->save())
        {
            return response()->json(['success'=>'1','response'=>'Feature Updated Successfully']);
        }
    }

    public function newUser(Request $request)
    {

        $maximum_allowed_users = Workspace::getMaximumAllowedUsers($this->workspace);
        // dd($maximum_allowed_users);
        $users_count_on_this_workspace = Workspace::usersCount($this->workspace->id);

        $available_modules = SubscriptionPlan::availableModules();

        // if($users_count_on_this_workspace >= $maximum_allowed_users)
        // {
        //     abort(401);
        // }
        $request->validate([
            "id" => "nullable|integer",
        ]);
        $countries = countries();

        $selected_user = false;

        if ($request->id) {
            $selected_user = User::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        return \view("profile.new-user", [
            "selected_navigation" => "team",
            "selected_user" => $selected_user,
            "available_modules" => $available_modules,
            "countries" => $countries,
        ]);
    }
   
    public function userPost(Request $request)
    {
        $request->validate([
            "first_name" => "required|string|max:100",
            "last_name" => "required|string|max:100",
            "email" => "required|email",
            "mobile_number" => "nullable|numeric|digits:10",
            "password" => "nullable|string|max:255",
            "id" => "nullable|integer",
        ]);

        

        $maximum_allowed_users = Workspace::getMaximumAllowedUsers($this->workspace);
        $users_count_on_this_workspace = Workspace::usersCount($this->workspace->id);

        // if($users_count_on_this_workspace >= $maximum_allowed_users)
        // {
        //    if(!$this->user->super_admin)
        //    {
        //        abort(401);
        //    }
        // }

        $user = false;
      

        if ($request->id) {

            if($this->user->super_admin)
            {
                $user = User::find($request->id);
            }
            else{
                $user = User::where("workspace_id", $this->user->workspace_id)
                    ->where("id", $request->id)
                    ->first();
            }

            if($user)
            {
                if($user->email !== $request->email)
                {
                    $exist = User::where('email',$request->email)->first();
                    
                    if($exist)
                    {
                        return Redirect::back()->withErrors([
                            
                                'user_exist' => __('User already exist with this email id.')
                    
                        ]);
                    }
                }
            }

        }
        else
        {
            $exist = User::where("email", $request->email)
            ->first();
            if($exist)
            {
            // dd($exist);
                return Redirect::back()->withErrors(['user_exist' => 'User already exist with this email id.']);
            }
        }


        if (!$user) {
            $user = new User();
            $user->workspace_id = $this->user->workspace_id;
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;

        if($request->input('password'))
        {
            $user->password = Hash::make($request->input('password'));
        }
        if ($this->user->super_admin){
            $user->super_admin = '0';
        }
        else
        {
            $user->super_admin = '2';
            
            
            // $user->mck7_s_model = 0;
            // $user->s_f_model = 0;
            // $user->Users_tab = 0;
            if($request->business_plan == 1)
            {
               $user->business_plan = 1;
            }
            else
            {
               $user->business_plan = 0;
            }

            if($request->projects == 1)
            {
                $user->projects = 1;
            }
            else
            {
                $user->projects = 0;
            }
            if($request->to_dos == 1)
            {
                $user->to_dos = 1;
            }
            else
            {
                $user->to_dos = 0;
            }

            if($request->brainstorm == 1)
            {
                $user->brainstorm = 1;
            }
            else
            {
                $user->brainstorm = 0;
            }

            if($request->investors == 1)
            {
                $user->investors = 1;
            }
            else
            {
                $user->investors = 0;
            }

            if($request->business_model == 1)
            {
                $user->business_model = 1;
            }
            else
            {
                $user->business_model = 0;
            }

            if($request->startup_canvas == 1)
            {
                $user->startup_canvas = 1;
            }
            else
            {
                $user->startup_canvas = 0;
            }

            if($request->swot == 1)
            {
                $user->swot = 1;
            }
            else
            {
                $user->swot = 0;
            }

            if($request->pest == 1)
            {
                $user->pest = 1;
            }
            else
            {
                $user->pest = 0;
            }

            if($request->pestle == 1)
            {
                $user->pestle = 1;
            }
            else
            {
                $user->pestle = 0;
            }

            if($request->calendar == 1)
            {
                $user->calendar = 1;
            }
            else
            {
                $user->calendar = 0;
            }

            // if($request->calendar == 1)
            // {
            //     $user->calender = 1;
            // }
            // else
            // {
            //     $user->calender = 0;
            // }

            if($request->notes == 1)
            {
                $user->notes = 1;
            }
            else
            {
                $user->notes = 0;
            }

             if($request->documents == 1)
            {
                $user->documents = 1;
            }
            else
            {
                $user->documents = 0;
            }

            if($request->mckinsey == 1)
            {
                $user->mckinsey = 1;
            }
            else
            {
                $user->mckinsey = 0;
            }

            if($request->porter == 1)
            {
                $user->porter = 1;
            }
            else
            {
                $user->porter = 0;
            }

        }
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->mobile_number = $request->mobile_number;
        $user->twitter = $request->twitter;
        $user->facebook = $request->facebook;
        $user->linkedin = $request->linkedin;
        $user->address_1 = $request->address_1;
        $user->address_2 = $request->address_2;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->language = $request->language;
        $user->zip = $request->zip;
        $user->save();



        if ($this->user->super_admin) {
            return redirect("/users");
        }

        return redirect("/staff");
    }

    public function userEdit(Request $request,$id)
    {
        $arr = [];
        $plan_module = User::where('id',$id)->select('projects', 'to_dos', 'calendar', 'brainstorm','investors','business_model', 'notes', 'documents', 'startup_canvas', 'mckinsey', 'porter', 'swot', 'pest','pestle','business_plan')->first()->toArray();

        foreach($plan_module as $key => $val)
        {
            if($val ==1)
            {
                array_push($arr,$key);
            }
        }
        // $key = array_search (1, $plan_module);
       

        $selected_user = User::find($id);
        $available_modules = SubscriptionPlan::availableModules();


        $countries = countries();


        if ($selected_user){

            if($this->user->super_admin)
            {
                return \view('super-admin.add-new-user',[
                    'selected_user'=> $selected_user,
                    'countries'=> $countries,


                ]);
            }

            return \view('profile.new-user',[
                'selected_user'=> $selected_user,
                'plan_modules'=> $arr,
                'available_modules'=> $available_modules,
                'countries'=> $countries,


            ]);

        }

    }

    public function userChangePasswordPost(Request $request)
    {
        $request->validate([
            "password" => "required",
            "new_password" => "required|confirmed",
        ]);

        $user = $this->user;

        if (!Hash::check($request->password, $user->password)) {
            return redirect("/profile")->withErrors([
                "password" => "Incorrect old password.",
            ]);
        }

        if (config("app.environment") !== "demo") {
            $user->password = Hash::make($request->new_password);
            $user->save();
        }

        return redirect("/profile");
    }
}
