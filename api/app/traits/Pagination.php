<?php
declare(strict_types=1);

namespace Api\Traits;

class Pagination
{

    public static function generate($limit, $page, $count)
    {
        $data = [];

        $data['limit'] = (int) $limit;
        $data['page'] = (int) $page;
        $data['last'] = (int) ceil($count / $limit);
        $data['offset'] = (int) ($page - 1) * $data['limit'];
        $data['prev'] = (int) $page - 1;
        $data['next'] = (int) $page + 1;

        if($page <= 1) {
            $data['prev'] = 1;
        }

        if($page >= $data['last']) {
            $data['next'] = $data['last'];
        }

        return $data;
    }

}

