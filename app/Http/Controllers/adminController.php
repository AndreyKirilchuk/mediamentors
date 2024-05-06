<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Models\directions;
use App\Models\portfolios;
use Illuminate\Support\Facades\File;

class adminController extends Controller
{
    public  function  index()
    {
        $directions = directions::all();
        $portfolio = portfolios::all();

        $boolean = true;
        if($directions->isEmpty()){
            $boolean = false;
        }

        return view('admin/index', compact('directions', 'portfolio', 'boolean'));
    }
    public  function  firstOrCreateDirection (Request $request)
    {
        $post = directions::firstOrCreate([
            'title' => $request->newDirection
        ],[
            'title' => $request->newDirection
        ]);

        return redirect()->back();
    }
    public function deleteDirection(Request $request)
    {
        $thisDirectionId = $request->thisDirectionId;

        $thisDirection = directions::find($thisDirectionId);

        $allPortfolioDelete = portfolios::where('direction_id', $thisDirectionId)->get();
        $allMediaDelete = Media::where('direction_id', $thisDirectionId)->get();

        foreach ($allMediaDelete as $mediaDelete){
            File::delete($mediaDelete->poster);
            File::delete($mediaDelete->file);
            $mediaDelete->delete();
        }

        foreach ($allPortfolioDelete as $thisPortfolioDelete){
            $thisPortfolioDelete->delete();
        }

        $thisDirection->delete();

        return redirect()->back();
    }

    public  function  redactDirection(Request $request)
    {
        $thisDirectionId = $request->thisDirectionId;

        $thisDirection = directions::find($thisDirectionId);

        $thisDirection->title = $request->newTitleDirection;

        $thisDirection->save();

        return redirect()->back();
    }
    public function  adminPortfolioBlade($id)
    {
        $direction = directions::find($id);
        $portfolio = portfolios::where('direction_id', $id)->get();
        $media = Media::all();

        $boolean = true;
        if($portfolio->isEmpty()){
            $boolean = false;
        }

        return view('admin/adminPortfolio', compact('direction', 'portfolio', 'boolean', 'media'));
    }

    public  function adminPortfolioElementBlade($id)
    {
        $element = portfolios::find($id);
        if($element->type === 'img'){
            $thisMedia = Media::where('portfolio_id', $id)->get();
        }else{
            $thisMedia = Media::where('portfolio_id', $id)->first();
        }
        $direction = directions::find($element->direction_id);


        return view('admin/adminPortfolioElement', compact('element', 'thisMedia', 'direction'));
    }
    public  function  createPortfolio(Request $request)
    {
        $file = $request->file('portfolioFile');
        $filePoster = $request->file('portfolioPoster');
        $thisDirectionID = $request->newportfolioDirectionId;

        if($file){
            $type = $file->getClientOriginalExtension();

            if(in_array($type, ['mp4', 'wmv', 'mov', 'mkv', 'webm', 'avi', 'MP4', 'WMV', 'MOV', 'MKV', 'WEBM', 'AVI'])){
                $type = 'video';
            }else{
                $type = 'img';
            }

            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('portfolioAssets'), $fileName);
            $path = 'portfolioAssets/' . $fileName;

        }else{
            $path = '';
            $type = '';
        }

        if($filePoster){
            $fileName2 = time().'_'.$filePoster->getClientOriginalName();
            $filePoster->move(public_path('portfolioAssets'), $fileName2);
            $pathPoster = 'portfolioAssets/' . $fileName2;
        }else{
            $pathPoster = '';
        }

        $newPortfolio = [
            'name' => $request->portfolioName,
            'info' => $request->portfolioInfo,
            'type' => $type,
            'author' => $request-> portfolioAuthor,
            'direction_id' => $request->newportfolioDirectionId
        ];

        $newPortfolioEl = portfolios::create($newPortfolio);

        $newMedia = [
            'file' => $path,
            'poster' => $pathPoster,
            'preview' => 'true',
            'portfolio_id' => $newPortfolioEl->getKey(),
            'direction_id' => $thisDirectionID
        ];

        Media::create($newMedia);

        return redirect()->back();
    }
    public  function deletePortfolio(Request $request)
    {
        $thisDirectionId = $request->directionId;
        $thisPortfolioId = $request->thisPortfolioId;

        $allMediaDelete = Media::where('portfolio_id', $thisPortfolioId)->get();

        foreach ($allMediaDelete as $MediaDelete){
            File::delete($MediaDelete->poster);
            File::delete($MediaDelete->file);
            $MediaDelete->delete();
        }

        $thisPortfolio = portfolios::find($thisPortfolioId);

        $thisPortfolio->delete();

        return redirect()->route('adminPortfolioBlade', $thisDirectionId);
    }

    public function redactPortfolio(Request $request)
    {

        $thisPortfolioId = $request->thisPortfolioId;

        $thisPortfolio = portfolios::find($thisPortfolioId);

        $thisPortfolio->name = $request->portfolioName;
        $thisPortfolio->info = $request->portfolioInfo;
        $thisPortfolio->author = $request->portfolioAuthor;

        $thisPortfolio->save();

        return redirect()->back();
    }

    public  function  createMedia(Request $request)
    {
        $file = $request->file('mediaFile');

        if($file){
            $type = $file->getClientOriginalExtension();

            if(in_array($type, ['mp4', 'wmv', 'mov', 'mkv', 'webm', 'avi', 'MP4', 'WMV', 'MOV', 'MKV', 'WEBM', 'AVI'])){
                $type = 'video';
            }else{
                $type = 'img';
            }
            if($type === 'img'){
                $fileName = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('portfolioAssets'), $fileName);
                $path = 'portfolioAssets/' . $fileName;
            }else{
                return redirect()->back();
            }
        }else{
            $path = '';
        }

        $newMedia = [
            'file' => $path,
            'portfolio_id' => $request->portfolio_id,
            'direction_id' => $request->direction_id
        ];

        Media::create($newMedia);

        return redirect()->back();
    }

    public  function deleteMedia(Request $request)
    {
        $thisMediaId = $request->thisMediaId;

        $thisMedia = Media::find($thisMediaId);

        File::delete($thisMedia->file);

        $thisMedia->delete();

        return redirect()->back();
    }

    public  function  redactMedia(Request $request)
    {
        $thisMediaId = $request->thisMediaId;

        $thisMedia = Media::find($thisMediaId);

        $file = $request->mediaFile;
        $filePoster = $request->mediaPoster;

        if($file){

            $NewType = $file->getClientOriginalExtension();

            if(in_array($NewType, ['mp4', 'wmv', 'mov', 'mkv', 'webm', 'avi', 'MP4', 'WMV', 'MOV', 'MKV', 'WEBM', 'AVI'])){
                $NewType = 'video';
            }else{
                $NewType = 'img';
            }

            $type = pathinfo($thisMedia->file, PATHINFO_EXTENSION);

            if(in_array($type, ['mp4', 'wmv', 'mov', 'mkv', 'webm', 'avi', 'MP4', 'WMV', 'MOV', 'MKV', 'WEBM', 'AVI'])){
                $type = 'video';
            }else{
                $type = 'img';
            }

            if($NewType === $type){
                File::delete($thisMedia->file);

                $fileName = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('portfolioAssets'), $fileName);
                $path = 'portfolioAssets/' . $fileName;

                $thisMedia->file = $path;
            }else{
                return redirect()->back();
            }

        }else{
            $path = '';
        }

        if($filePoster){
            File::delete($thisMedia->poster);

            $fileName2 = time().'_'.$filePoster->getClientOriginalName();
            $filePoster->move(public_path('portfolioAssets'), $fileName2);
            $pathPoster = 'portfolioAssets/' . $fileName2;

            $thisMedia->poster = $pathPoster;
        }else{
            $pathPoster = '';
        }


        $thisMedia->save();

        return redirect()->back();
    }
}
