<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\partners;
use Illuminate\Support\Facades\File;

class adminPartnersController extends Controller
{
    public  function  index()
    {
        $partners = partners::all();

        return view ('admin/partners', compact('partners'));
    }

    public  function createPartner(Request $request)
    {
        $file = $request->file('partnerFile');

        if($file){
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('partnerAssets'), $fileName);
            $path = 'partnerAssets/' . $fileName;
        }else{
            $path = '';
        }

        $newPartner = [
            'img' => $path
        ];

        partners::create($newPartner);

        return redirect()->back();
    }
    public  function deletePartner(Request $request)
    {
        $thisPartnerId = $request->thisPartnerId;

        $thisPatner = partners::find($thisPartnerId);

        $thisPatner->delete();

        $thisPartnerPath = $request->thisPartnerPath;

        //Удаление старого файла
        File::delete($thisPartnerPath);

        return redirect()->back();
    }
}
