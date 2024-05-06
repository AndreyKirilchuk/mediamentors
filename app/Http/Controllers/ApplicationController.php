<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applications;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {

        $token = env('TELEGRAM_BOT_TOKEN');
        $chat_id = env('TELEGRAM_CHAT_ID');

        $arr = [
            'Имя:' => $request->nickname,
            'Телефон:' => $request->tel,
        ];

        $tableArr = [
            'name' => $request->nickname,
            'tel' => $request->tel,
            'status' => 0
        ];

        Applications::create($tableArr);

        $txt = "<b>"."У вас новая заявка!"."</b>"."%0A"."%0A";
        foreach ($arr as $key => $value){
            $txt .= "<b>".$key."</b> ".$value."%0A";
        }

        $client = new \GuzzleHttp\Client();
        $response = $client->get("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=HTML&text={$txt}");

        return redirect()->back();
    }

    public  function applicationsBlade()
    {
        $applications = Applications::all();

        return view('admin/applications', compact('applications') );
    }
    public  function  trueApplication(Request $request)
    {
        $applicationid = $request->application_id;

        $thisApplication = Applications::find($applicationid);

        $thisApplication->status = 1;

        $thisApplication->save();
        return redirect()->back();
    }
    public  function  falseApplication(Request $request)
    {
        $applicationid = $request->application_id;

        $thisApplication = Applications::find($applicationid);

        $thisApplication->status = 0;

        $thisApplication->save();

        return redirect()->back();
    }
}
