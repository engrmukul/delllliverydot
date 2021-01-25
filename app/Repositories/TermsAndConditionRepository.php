<?php

namespace App\Repositories;

use App\Contracts\TermsAndConditionContract;
use App\Models\TermsAndCondition;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\DataTables\DataTables;

class TermsAndConditionRepository extends BaseRepository implements TermsAndConditionContract
{
    /**
     * TermsAndConditionRepository constructor.
     * @param TermsAndCondition $model
     */
    public function __construct(TermsAndCondition $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listTermsAndCondition(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        //$query = $this->all($columns, $order, $sort);

        $query = TermsAndCondition::latest()->get();

        return DataTables::of($query)
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions .= '<a class="btn btn-primary btn-xs float-left mr-1" href="' . route('termsandconditions.edit', [$row->id]) . '" title="TermsAndCondition Edit"><i class="fa fa-pencil"></i> '. trans("common.edit") . '</a>';

                return $actions;
            })
            ->make(true);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findTermsAndConditionById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }


    /**
     * @param array $params
     * @return mixed
     */
    public function updateTermsAndCondition(array $params)
    {
        $termsAndCondition = $this->findTermsAndConditionById($params['id']);

        $collection = collect($params)->except('_token');

        $updated_by = auth()->user()->id;

        $merge = $collection->merge(compact('updated_by'));

        $termsAndCondition->update($merge->all());

        return $termsAndCondition;
    }
}
