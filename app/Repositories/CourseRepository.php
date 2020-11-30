<?php

namespace App\Repositories;

use App\Contracts\CourseContract;
use App\Models\Course;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Yajra\DataTables\Facades\DataTables;

class CourseRepository extends BaseRepository implements CourseContract
{
    /**
     * CourseRepository constructor.
     * @param Course $model
     */
    public function __construct(Course $model)
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
    public function listCourse(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        $query = $this->all($columns, $order, $sort);
        return Datatables::of($query)->with('languages','courseCategories','instructors')
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions.= '<a class="btn btn-primary btn-xs float-left mr-1" href="' . route('courses.edit', [$row->id]) . '" title="Course Edit"><i class="fa fa-pencil"></i> '. trans("common.edit") . '</a>';

                $actions.= '
                    <form action="'.route('courses.destroy', [$row->id]).'" method="POST">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> '. trans("common.delete") . '</button>
                    </form>
                ';

                return $actions;
            })
            ->editColumn('language', function ($row) {
                return $row->languages->name;
            })
             ->editColumn('course_category', function ($row) {
                return $row->courseCategories->name;
            })
            ->editColumn('instructor', function ($row) {
                return $row->instructors->name;
            })

            ->make(true);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findCourseById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Course|mixed
     */
    public function createCourse(array $params)
    {
        try {
            $collection = collect($params);

            $created_by = auth()->user()->id;
            
            $merge = $collection->merge(compact('created_by'));

            $Course = new Course($merge->all());

            $Course->save();

            return $Course;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCourse(array $params)
    {
        $Course = $this->findCourseById($params['id']);

        $collection = collect($params)->except('_token');

        $updated_by = auth()->user()->id;

        $merge = $collection->merge(compact('updated_by'));

        $Course->update($merge->all());

        return $Course;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteCourse($id, array $params)
    {
        $Course = $this->findCourseById($id);

        $Course->delete();

        return $Course;
    }
}
