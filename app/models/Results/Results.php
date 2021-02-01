<?php

namespace Models\Results;

use Models\ModelBase;

class Results extends ModelBase {

    // public function initialize($attributes = []) {
    //     parent::initialize(array_merge(['behavior' => ['softdelete' => false]], $attributes));
        
    //     $this->setSource("links"); /* This is the table name */
    //     $this->setSchema("LINKS"); /* This is table database name */

    //     $this->setConnectionService('MYSQL-LINKS');
        
    //     /**
    //      * One to Many relation definitions
    //      */
    //     $this->hasMany("id", "\Models\Links\Visits", "link_id", ['alias' => 'visits']);
    // }

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

}
