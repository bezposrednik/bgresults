<?php

namespace Models\Teams;

use Models\ModelBase;

class Teams extends ModelBase {

    public function initialize($attributes = []) {
        // parent::initialize(array_merge(['behavior' => ['softdelete' => false]], $attributes));
        
        $this->setSource("teams"); /* This is the table name */
        // $this->setSchema("LINKS"); /* This is table database name */

        $this->setConnectionService('db');

        /**
         * One to One relation definitions
         */
        $this->hasOne("location_id", "\Models\Locations\Locations", "id", ['alias' => 'location']);
        
        /**
         * One to Many relation definitions
         */
        // $this->hasMany("id", "\Models\Links\Visits", "link_id", ['alias' => 'visits']);
    }

    // public function getSource() {
    //     return "links";
    // }

    // public function getSchema() {
    //     return "LINKS";
    // }

    // public function beforeSave() {        
    //     if (!isset($this->created)):
    //         $this->created = (new \DateTime())->format('Y-m-d H:i:s');
    //     endif;
    // }

    // public function get

}
