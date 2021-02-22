<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\HelpAndSupportContract;
use App\Models\HelpAndSupport;
use Illuminate\Http\Request;
use App\Http\Requests\HelpAndSupportStoreFormRequest;
use App\Http\Requests\HelpAndSupportUpdateFormRequest;

class HelpAndSupportController extends BaseController
{
    /**
     * @var HelpAndSupportContract
     */
    private $helpAndSupportRepository;

    /**
     * HelpAndSupportController constructor.0
     * @param HelpAndSupportContract $helpAndSupportRepository
     */
    public function __construct(HelpAndSupportContract $helpAndSupportRepository)
    {
        $this->helpAndSupportRepository = $helpAndSupportRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle('helpandsupports', 'HelpAndSupports List');
        $data = [
            'tableHeads' => [
                trans('helpAndSupprt.SN'),
                trans('helpAndSupprt.type'),
                trans('helpAndSupprt.question'),
                trans('helpAndSupprt.answer'),
                trans('helpAndSupprt.action')
            ],
            'dataUrl' => 'admin/helpandsupports/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'type', 'name' => 'type'],
                ['data' => 'question', 'name' => 'question'],
                ['data' => 'answer', 'name' => 'answer'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];

        return view('admin.help_and_supports.index', $data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getData(Request $request)
    {
        return $this->helpAndSupportRepository->listHelpAndSupport($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('helpandsupports', 'Create HelpAndSupprt');

        $types = array(
            'customer' => 'customer',
            'restaurant' => 'restaurant',
            'rider' => 'rider'
        );

        return view('admin.help_and_supports.create',compact('types'));
    }

    /**
     * @param HelpAndSupportStoreFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(HelpAndSupportStoreFormRequest $request)
    {
        $params = $request->except('_token');

        $helpAndSupprt = $this->helpAndSupportRepository->createHelpAndSupport($params);

        if (!$helpAndSupprt) {
            return $this->responseRedirectBack(trans('common.create_error'), 'error', true, true);
        }
        return $this->responseRedirect('helpandsupports.index', trans('common.create_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setPageTitle('helpandsupports', 'Edit HelpAndSupport');

        $types = array(
            'customer' => 'customer',
            'restaurant' => 'restaurant',
            'rider' => 'rider'
        );

        $helpAndSupport = $this->helpAndSupportRepository->findHelpAndSupportById($id);

        return view('admin.help_and_supports.edit', compact('helpAndSupport','types'));
    }

    /**
     * @param HelpAndSupportUpdateFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(HelpAndSupportUpdateFormRequest $request, HelpAndSupport $helpAndSupport)
    {
        $params = $request->except('_token');

        $helpAndSupport = $this->helpAndSupportRepository->updateHelpAndSupport($params);

        if (!$helpAndSupport) {
            return $this->responseRedirectBack(trans('common.update_error'), 'error', true, true);
        }
        return $this->responseRedirect('helpandsupports.index', trans('common.update_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id)
    {
        $params = $request->except('_token');
        $helpAndSupport = $this->helpAndSupportRepository->deleteHelpAndSupport($id, $params);

        if (!$helpAndSupport) {
            return $this->responseRedirectBack(trans('common.delete_error'), 'error', true, true);
        }
        return $this->responseRedirect('helpandsupports.index', trans('common.delete_success'), 'success', false, false);
    }
}
