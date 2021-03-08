<?php

namespace Api\Controllers;

use Api\Traits\Pagination;
use Api\Models\Stadiums;

class StadiumsController extends ControllerBase
{
    public function getAllItemsAction() 
    {
        $conditions = 'status = :status:';
        $bind = ['status' => 1];
        $columns = ['id', 'name'];

        $data = Stadiums::find(['conditions' => $conditions, 'bind' => $bind, 'columns' => $columns]);

        $response = $this->response->setJsonContent(['status' => 'FOUND', 'data' => $data]);

        return $response;
    }
}
