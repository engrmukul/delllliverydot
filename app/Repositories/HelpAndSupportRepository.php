<?php

namespace App\Repositories;

use App\Contracts\HelpAndSupportContract;
use App\Models\HelpAndSupport;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Yajra\DataTables\DataTables;

class HelpAndSupportRepository extends BaseRepository implements HelpAndSupportContract
{
    /**
     * HelpAndSupportRepository constructor.
     * @param HelpAndSupport $model
     */
    public function __construct(HelpAndSupport $model)
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
    public function listHelpAndSupport(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        //$query = $this->all($columns, $order, $sort);

        $query = HelpAndSupport::latest()->get();

        return Datatables::of($query)
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions.= '<a class="btn btn-primary btn-xs float-left mr-1" href="' . route('helpAndSupports.edit', [$row->id]) . '" title="HelpAndSupport Edit"><i class="fa fa-pencil"></i> '. trans("common.edit") . '</a>';

                $actions.= '
                    <form action="'.route('helpAndSupports.destroy', [$row->id]).'" method="POST">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> '. trans("common.delete") . '</button>
                    </form>
                ';

                return $actions;
            })
            ->make(true);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findHelpAndSupportById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return HelpAndSupport|mixed
     */
    public function createHelpAndSupport(array $params)
    {
        try {
            $collection = collect($params);

            $created_by = auth()->user()->id;

            $merge = $collection->merge(compact('created_by'));

            $HelpAndSupport = new HelpAndSupport($merge->all());

            $HelpAndSupport->save();

            return $HelpAndSupport;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateHelpAndSupport(array $params)
    {
        $HelpAndSupport = $this->findHelpAndSupportById($params['id']);

        $collection = collect($params)->except('_token');

        $updated_by = auth()->user()->id;

        $merge = $collection->merge(compact('updated_by'));

        $HelpAndSupport->update($merge->all());

        return $HelpAndSupport;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteHelpAndSupport($id, array $params)
    {
        $HelpAndSupport = $this->findHelpAndSupportById($id);

        $HelpAndSupport->delete();

        return $HelpAndSupport;
    }
}
