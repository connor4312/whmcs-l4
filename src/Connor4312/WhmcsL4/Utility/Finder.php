<?php namespace Connor4312\WhmcsL4\Utlity;

class Finder
{
    protected $results;
    protected $model;

    public function find($filter) {
        $model = $this->model;
        $query = $model::query();

        if (is_integer($filter)) {
            $this->results = $query->where('id', $filter)->get();
        } else {
            $this->results = $filter($query);
        }

        return $this;
    }
}