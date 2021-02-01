<?php

namespace Models\Locations;

use Models\ModelBase;

class Locations extends ModelBase {

    public function initialize($attributes = []) {
        // parent::initialize(array_merge(['behavior' => ['softdelete' => false]], $attributes));
        
        $this->setSource("locations"); /* This is the table name */
        // $this->setSchema("LINKS"); /* This is table database name */

        $this->setConnectionService('db');

        /**
         * One to One relation definitions
         */
        // $this->hasOne("location_id", "\Models\Accounts", "email", array('alias' => 'account'));
        
        /**
         * One to Many relation definitions
         */
        // $this->hasMany("id", "\Models\Links\Visits", "link_id", ['alias' => 'visits']);
    }


}
