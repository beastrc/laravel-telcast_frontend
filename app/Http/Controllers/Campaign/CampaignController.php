<?php

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AdCampaign;
use App\Models\User;

class CampaignController extends Controller
{
    public function index(Request $request){
        return view('advertiser.campaigns.first');
    }
    public function createpage(Request $request, User $user)
    {
        $user = Auth::user();
        $userid = $user->id;
        return view('advertiser.campaigns.create', compact('userid'));
        // return view('advertiser.campaigns.test');
    }
    public function savecampaign(Request $request)
    {
        $data = $request->input();
        try{
            $campaign = new AdCampaign;
            $campaign->title = $data['title'];
            $campaign->user_id = $data['userid'];
            $campaign->video_subject =  $request->file('video')->hashName();
            $campaign->video_url = $data['url'];
            $campaign->country = $data['countrylist'];
            $campaign->language = $data['languagelist'];
            $campaign->age = $data['age_range'];
            $campaign->gender = $data['gender_range'];
            // getClientOriginalName();
            $campaign->budget = $data['budget'];

            $url = 'public/'.'campaign/'.$campaign->user_id;
            $campaign_path     = $request->file('video')->store($url);

            $campaign->save();
            return redirect('createcampaign');
        } catch(Exception $e) {
            
        }
    }
}
