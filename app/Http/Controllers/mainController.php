<?php

namespace App\Http\Controllers;

use App\Models\partners;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\directions;
use App\Models\portfolios;
use App\Models\Media;
use LastModified;
use Illuminate\Support\Facades\Cache;

class mainController extends Controller
{
    //Вывод всех направлений и портфолио для них
    public function directionsBlade()
    {
        $directions = directions::all();
        $portfolio = portfolios::all();
        $partners = partners::all();
        $media = Media::all();
        
        $boolean = true;
        if($directions->isEmpty()){
            $boolean = false;
        }
    
        // // Generate a unique cache key based on the current data
        // $cacheKey = 'directions_blade_data';
    
        // // Check if the data is already in the cache
        // if (Cache::has($cacheKey)) {
        //     $cachedData = Cache::get($cacheKey);
        // }else{
        //     Cache::add('directions_blade_data', 0, now()->addHours(4));
        //     Cache::increment('directions_blade_data', $media);
        // }

        return view('main/index', compact('directions', 'portfolio', 'boolean', 'partners', 'media'));
    }


    //Вывод портфоли по айдишке направления
    public  function  portfolioBlade($id){
        $direction = directions::find($id);
        $portfolio = portfolios::where('direction_id', $id)->get();
        $media = Media::all();

        $boolean = true;
        if($portfolio->isEmpty()){
            $boolean = false;
        }

        return view('portfolio/index', compact('direction', 'portfolio', 'boolean', 'media'));
    }
}
