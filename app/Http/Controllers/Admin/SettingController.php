<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use QCod\AppSettings\SavesSettings;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use QCod\AppSettings\Setting\AppSettings;

class SettingController extends Controller
{
    use SavesSettings;


    /**
     * Save settings
     *
     * @param Request $request
     * @param AppSettings $appSettings
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, AppSettings $appSettings)
    {
        // validate the settings
        $this->validate($request, $appSettings->getValidationRules());

        // save settings
        $appSettings->save($request);

        if($request->get('maintenance_mode') == 1){
            Artisan::call('down');
        }elseif($request->get('maintenance_mode') == 0){
            Artisan::call('up');
        }
        $notification = notify('Settings have been saved');
        return redirect()->back()->with($notification);
    }
}
