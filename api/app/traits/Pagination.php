<?php
declare(strict_types=1);

namespace Api\Traits;

class Pagination
{

    public static function generate($limit, $page, $count)
    {
        $data = [];

        $data['last'] = ceil($count / $limit);
        $data['start'] = $page - 1;

        $data['limit'] = $limit;
        

        
        $data['offset'] = ($page - 1) * $data['limit'];
        $data['prev'] = $page - 1;
        $data['next'] = $page + 1;
        

        return $data;
    }

}

