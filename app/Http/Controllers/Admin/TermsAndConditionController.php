<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\TermsAndConditionContract;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;
use App\Http\Requests\TermsAndConditionStoreFormRequest;
use App\Http\Requests\TermsAndConditionUpdateFormRequest;

class TermsAndConditionController extends BaseController
{
    /**
     * @var TermsAndConditionContract
     */
    private $termsAndConditionRepository;

    /**
     * TermsAndConditionController constructor.
     * @param TermsAndConditionContract $termsAndConditionRepository
     */
    public function __construct(TermsAndConditionContract $termsAndConditionRepository)
    {
        $this->termsAndConditionRepository = $termsAndConditionRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle('TermsAndConditions', 'TermsAndConditions List');
        $data = [
            'tableHeads' => [
                trans('termsAndCondition.SN'),
                trans('termsAndCondition.type'),
                trans('termsAndCondition.description'),
                trans('termsAndCondition.action')
            ],
            'dataUrl' => 'admin/termsAndConditions/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'type', 'name' => 'type'],
                ['data' => 'description', 'name' => 'description'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];
        return view('admin.terms_and_condition.index', $data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getData(Request $request)
    {
        return $this->termsAndConditionRepository->listTermsAndCondition($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('TermsAndConditions', 'Create TermsAndCondition');

        $types = array(
            'customer' => 'customer',
            'restaurant' => 'restaurant',
            'rider' => 'rider'
        );

        return view('admin.terms_and_condition.create',compact('types'));
    }

    /**
     * @param TermsAndConditionStoreFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TermsAndConditionStoreFormRequest $request)
    {
        $params = $request->except('_token');

        $termsAndCondition = $this->termsAndConditionRepository->createTermsAndCondition($params);

        if (!$termsAndCondition) {
            return $this->responseRedirectBack(trans('common.create_error'), 'error', true, true);
        }
        return $this->responseRedirect('termsandconditions.index', trans('common.create_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setPageTitle('TermsAndConditions', 'Edit TermsAndCondition');

        $types = array(
            'customer' => 'customer',
            'restaurant' => 'restaurant',
            'rider' => 'rider'
        );

        $termsAndCondition = $this->termsAndConditionRepository->findTermsAndConditionById($id);

        return view('admin.terms_and_condition.edit', compact('termsAndCondition','types'));
    }

    /**
     * @param TermsAndConditionUpdateFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TermsAndConditionUpdateFormRequest $request, TermsAndCondition $termsAndCondition)
    {
        $params = $request->except('_token');

        $termsAndCondition = $this->termsAndConditionRepository->updateTermsAndCondition($params);

        if (!$termsAndCondition) {
            return $this->responseRedirectBack(trans('common.update_error'), 'error', true, true);
        }
        return $this->responseRedirect('termsandconditions.index', trans('common.update_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id)
    {
        $params = $request->except('_token');
        $termsAndCondition = $this->termsAndConditionRepository->deleteTermsAndCondition($id, $params);

        if (!$termsAndCondition) {
            return $this->responseRedirectBack(trans('common.delete_error'), 'error', true, true);
        }
        return $this->responseRedirect('termsandconditions.index', trans('common.delete_success'), 'success', false, false);
    }
}
