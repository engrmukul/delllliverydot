<?php

namespace App\Http\Controllers\Admin;

use App\Models\FCM;
use App\Models\GeneralSetting;
use App\Models\GOOGLE;
use App\Models\PUSHER;
use App\Models\TWILIO;
use App\Contracts\SettingsContract;
use App\Http\Requests\SettingsUpdateFormRequest;

class SettingsController extends BaseController
{
    /**
     * @var SettingsContract
     */
    protected $settingsRepository;

    /**
     * SettingsController constructor.
     * @param SettingsContract $settingsRepository
     */
    public function __construct(settingsContract $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $this->setPageTitle('Settings', 'Edit Settings');

        $GOOGLE = GOOGLE::first();
        $FCM = FCM::first();
        $PUSHER = PUSHER::first();
        $TWILIO = TWILIO::first();
        $GeneralSetting = GeneralSetting::first();

        return view('admin.settings.edit', compact('GOOGLE','FCM', 'PUSHER','TWILIO','GeneralSetting'));
    }

    /**
     * @param UpdateSettingsFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SettingsUpdateFormRequest $request)
    {
        $params = $request->except('_token');

        $settings = $this->settingsRepository->updateSettings($params);

        if (!$settings) {
            return $this->responseRedirectBack(trans('common.update_error'), 'error', true, true);
        }
        return $this->responseRedirect('settings.edit', trans('common.update_success'), 'success', false, false);
    }
}
