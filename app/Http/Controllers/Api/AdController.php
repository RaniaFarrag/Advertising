<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdRequest;
use App\Http\Traits\ResponseTrait;
use App\Models\Ad;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ad::all();
        return $this->success($ads, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdRequest $request)
    {
        $ad = Ad::create([
           'title' => $request->title,
           'description' => $request->description,
           'type_id' => $request->type_id,
           'category_id' => $request->category_id,
           'advertiser_id' => $request->advertiser_id,
           'created_by_user_id' => JWTAuth::user()->id,
           'start_date' => $request->start_date,
        ]);
        $ad->tags()->sync($request->tags);
        return $this->success($ad, 200);
    }

    // Show Advertiser's Ads
    public function showAdvertiserAds(Request $request)
    {
        $advertiser_ads = Ad::where('advertiser_id', $request->advertiser_id)->get();
        return $this->success($advertiser_ads, 200);
    }

    // Filter Ads By Category or Tag
    public function filterAds(Request $request){
        $ads = Ad::query();

        // tag_ids is array of tags id
        if ($request->tag_ids){
            $ads = $ads->whereHas('tags' , function ($q) use ($request){
                $q->whereIn('tag_id', $request->tag_ids);
            });
        }

        if ($request->category_id){
            $ads = $ads->where('category_id', $request->category_id);
        }

        return $this->success($ads->get(), 200);
    }

    // Show Advertiser's Ads
    public function showMyAds()
    {
        $advertiser_ads = Ad::where('advertiser_id', JWTAuth::user()->id)->get();
        return $this->success($advertiser_ads, 200);
    }
}
