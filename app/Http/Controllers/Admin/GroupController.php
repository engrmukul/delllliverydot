<?php

namespace App\Http\Controllers\Admin;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Contracts\GroupContract;
use App\Http\Requests\GroupStoreFormRequest;
use App\Http\Requests\GroupUpdateFormRequest;

class GroupController extends BaseController
{
    /**
     * @var GroupContract
     */
    protected $groupRepository;

    /**
     * GroupController constructor.
     * @param GroupContract $groupRepository
     */
    public function __construct(GroupContract $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle('Groups', 'Group List');
        $data = [
            'tableHeads' => [
                trans('group.SN'),
                trans('group.name'),
                trans('group.status'),
                trans('group.action')
            ],
            'dataUrl' => 'admin/groups/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'status', 'name' => 'status'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];
        return view('admin.groups.index', $data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getData(Request $request)
    {
        return $this->groupRepository->listGroup($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Groups', 'Create Group');

        return view('admin.groups.create');
    }

    /**
     * @param StoreGroupFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GroupStoreFormRequest $request)
    {
        $params = $request->except('_token');

        $group = $this->groupRepository->createGroup($params);

        if (!$group) {
            return $this->responseRedirectBack(trans('common.create_error'), 'error', true, true);
        }
        return $this->responseRedirect('groups.index', trans('common.create_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setPageTitle('Groups', 'Edit Group');

        $group = $this->groupRepository->findGroupById($id);

        return view('admin.groups.edit', compact('group'));
    }

    /**
     * @param UpdateGroupFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GroupUpdateFormRequest $request, Group $groupModel)
    {
        $params = $request->except('_token');

        $group = $this->groupRepository->updateGroup($params);

        if (!$group) {
            return $this->responseRedirectBack(trans('common.update_error'), 'error', true, true);
        }
        return $this->responseRedirect('groups.index', trans('common.update_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id)
    {
        $params = $request->except('_token');
        $group = $this->groupRepository->deleteGroup($id, $params);

        if (!$group) {
            return $this->responseRedirectBack(trans('common.delete_error'), 'error', true, true);
        }
        return $this->responseRedirect('groups.index', trans('common.delete_success'), 'success', false, false);
    }
}
