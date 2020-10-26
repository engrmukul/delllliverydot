<?php

namespace App\Repositories;

use App\Models\Restaurant;
use App\Contracts\RestaurantContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\DataTables\Facades\DataTables;

class RestaurantRepository extends BaseRepository implements RestaurantContract
{
    /**
     * RestaurantRepository constructor.
     * @param Restaurant $model
     */
    public function __construct(Restaurant $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @param int $featureSection
     * @return mixed
     */
    public function listRestaurant(string $order = 'id', string $sort = 'desc', array $columns = ['*'], int $featureSection = 1)
    {
        $query = $this->model->with('restaurantDetails');

        $query->whereHas('restaurantDetails', function ($q) use ($featureSection) {
            $q->where('restaurant_profiles.feature_section', $featureSection);
        });

        return $query->orderBy('id', $sort)->get($columns);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findRestaurantById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }
}
