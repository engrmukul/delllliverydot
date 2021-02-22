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
                trans('termsAndCondition.action')
            ],
            'dataUrl' => 'admin/termsandconditions/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'type', 'name' => 'type'],
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

}
