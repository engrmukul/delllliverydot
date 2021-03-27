<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Contracts\PromotionalContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Yajra\DataTables\Facades\DataTables;

class PromotionalRepository extends BaseRepository implements PromotionalContract
{
    /**
     * PromotionalRepository constructor.
     * @param Banner $model
     */
    public function __construct(Banner $model)
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
    public function listPromotional(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        $query = $this->model::latest()->get();

        return Datatables::of($query)
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions .= '<a class="btn btn-primary btn-xs float-left mr-1 edit cusEdit" href="' . route('promotionals.edit', [$row->id]) . '" title="Promotional Edit"><i class="fa fa-pencil"></i> ' . trans("common.edit") . '</a>';

                $actions .= '
                    <form action="' . route('promotionals.destroy', [$row->id]) . '" method="POST">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <button type="submit" class="btn btn-danger btn-xs cusDelete delete"><i class="fa fa-remove"></i> </button>
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
    public function findPromotionalById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @param string $image
     * @return Banner|mixed
     */
    public function createPromotional(array $params)
    {
        try {
            $collection = collect($params);

            $created_by = auth()->user()->id;

            if (isset($params['image'])) {
                $image = url('/') . '/public/img/banner/' . $params['image'];
            } else {
                $image = url('/') . '/public/img/banner/default.png';
            }

            $merge = $collection->merge(compact('created_by','image'));

            $promotional = new Banner($merge->all());

            $promotional->save();

            return $promotional;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updatePromotional(array $params)
    {
        $Promotional = $this->findPromotionalById($params['id']);

        $collection = collect($params)->except('_token');

        $updated_by = auth()->user()->id;

        if (isset($params['image'])) {
            $image = url('/') . '/public/img/banner/' . $params['image'];
            $merge = $collection->merge(compact('image','updated_by'));
        }else{
            $image = $Promotional->image;
            $merge = $collection->merge(compact( 'image','updated_by'));
        }

        $Promotional->update($merge->all());

        return $Promotional;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deletePromotional($id, array $params)
    {
        $promotional = $this->findPromotionalById($id);

        $promotional->delete();

        return $promotional;
    }
}
