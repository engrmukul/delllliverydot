<?php

namespace App\Http\Controllers\API\V1;

use App\Contracts\RiderContract;
use App\Http\Requests\RiderOTPVerificationFormRequest;
use App\Http\Requests\RiderPhoneVerificationFormRequest;
use App\Http\Requests\RiderStoreFormRequest;
use App\Http\Requests\RiderUpdateFormRequest;
use App\Models\Rider;
use App\Models\RiderSetting;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;


class RiderController extends BaseController
{
    use UploadTrait;

    protected $riderRepository;

    public function __construct(RiderContract $riderRepository)
    {
        $this->riderRepository = $riderRepository;
    }

    public function index(Request $request)
    {
        $params = $request->except('_token');

        $orderHistory = $this->riderRepository->listRider($params['rider_id']);

        if($orderHistory){
            return $this->sendResponse($orderHistory, 'Rider retrieved successfully.',Response::HTTP_OK);
        }

        return $this->sendError('Unable to get data.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function riderTodayOrder(Request $request)
    {
        $params = $request->except('_token');

        $todaysOrder = $this->riderRepository->listRiderTodayOrder($params['rider_id']);

        if($todaysOrder){
            return $this->sendResponse($todaysOrder, 'Rider retrieved successfully.',Response::HTTP_OK);
        }

        return $this->sendError('Unable to get data.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function store(RiderPhoneVerificationFormRequest $request)
    {
        $params = $request->except('_token');

        $rider = $this->riderRepository->createRider($params);

        if ($rider) {
            $riderSettings = new RiderSetting();
            $riderSettings->rider_id = $rider->id;
            $riderSettings->save();


            return $this->sendResponse($rider, 'Rider saved successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    protected function otpVerify(RiderOTPVerificationFormRequest $request)
    {
        $params = $request->except('_token');

        $otp = $this->riderRepository->riderOTPVerify($params);

        $rider = Rider::where('phone_number', $request->phone_number)->first();

        if ($otp) {
            return $this->sendResponse($rider, 'Rider phone number valid.',Response::HTTP_OK);
        }
        return $this->sendError('Invalid verification code entered!.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
    }


    public function edit($id)
    {
        $rider = $this->riderRepository->findRiderById($id);

        if (!$rider) {
            return $this->sendResponse($rider, 'Rider retrieved successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);

    }

    public function riderProfileUpdate(RiderUpdateFormRequest $request, Rider $riderModel)
    {
        $params = $request->except('_token');

        $rider = $this->riderRepository->updateRiderProfile($params);

        if ($rider) {
            return $this->sendResponse($rider, 'Rider update successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to update.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function destroy(Request $request, $id)
    {
        $params = $request->except('_token');
        $rider = $this->riderRepository->deleteRider($id, $params);

        if (!$rider) {
            return $this->sendResponse($rider, 'Rider delete successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to create.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
    }


    public function documentUpdate(Request $request)
    {
        $params = $request->except('_token');
        $image = '';

        if ($request->has('image')) {
            $image = $request->file('image');
            $name = Str::slug($request->input('nid_or_passport')).'_'.time();
            $folder = '/uploads/images/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);

            $image = $filePath;
        }

        $document = $this->riderRepository->updateDocument($params, $image);

        if ($document) {
            return $this->sendResponse($document, 'Document update successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to update.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);

    }

    public function settingsUpdate(Request $request)
    {
        $params = $request->except('_token');

        $rider = $this->riderRepository->settingsUpdate($params);

        if ($rider) {
            return $this->sendResponse($rider, 'Rider settings update successfully.',Response::HTTP_OK);
        }
        return $this->sendError('Unable to update.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);

    }



}
