<?php

namespace App\Repositories;

use App\Contracts\ExtraContract;
use App\Models\Extra;
use App\Models\ExtraVariant;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Yajra\DataTables\DataTables;

class ExtraRepository extends BaseRepository implements ExtraContract
{
    /**
     * ExtraRepository constructor.
     * @param Extra $model
     */
    public function __construct(Extra $model)
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
    public function listExtra(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        $query = Extra::latest()->get();

        return Datatables::of($query)->with('group','food')
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions.= '<a class="btn btn-primary btn-xs float-left mr-1" href="' . route('extras.edit', [$row->id]) . '" title="Extra Edit"><i class="fa fa-pencil"></i> '. trans("common.edit") . '</a>';

                $actions.= '
                    <form action="'.route('extras.destroy', [$row->id]).'" method="POST">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> '. trans("common.delete") . '</button>
                    </form>
                ';

                return $actions;
            })
            ->editColumn('group', function ($row) {
                return $row->group->name;
            })
            ->editColumn('food', function ($row) {
                return $row->food->name;
            })
            ->make(true);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findExtraById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Extra|mixed
     */
    public function createExtra(array $params)
    {
        try {
            $collection = collect($params);

            $created_by = auth()->user()->id;

            $merge = $collection->merge(compact('created_by'));

            $extra = new Extra($merge->all());

            $extra->save();

            return $extra;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateExtra(array $params)
    {
        $Extra = $this->findExtraById($params['id']);

        $collection = collect($params)->except('_token');

        $updated_by = auth()->user()->id;

        $merge = $collection->merge(compact('updated_by'));

        $Extra->update($merge->all());

        return $Extra;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteExtra($id, array $params)
    {
        $Extra = $this->findExtraById($id);

        $Extra->delete();

        return $Extra;
    }
}
