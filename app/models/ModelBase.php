<?php

namespace Models;

use Phalcon\Mvc\Model;

class ModelBase extends Model
{

    public function initialize()
    {
        // $now = new \DateTime();

        // /**
        //  * Global behavior for soft delete, because we have two fields that 
        //  * contain the state of the object we need to add the behavior twice
        //  */
        // $this->addBehavior(new \Phalcon\Mvc\Model\Behavior\SoftDelete(
        //         ['field' => 'deleted', 'value' => $now->format('Y-m-d H:i:s')]
        // ));

        // $this->addBehavior(new \Phalcon\Mvc\Model\Behavior\SoftDelete(
        //         ['field' => 'status', 'value' => 0]
        // ));
    }

    // public function beforeSave() {
    //     if (!isset($this->status)):
    //         $this->status = 1;
    //     endif;

    //     if (!isset($this->created)):
    //         $this->created = (new \DateTime())->format('Y-m-d H:i:s');
    //     endif;

    //     if (!isset($this->deleted)):
    //         $this->deleted = NULL;
    //     endif;
    // }

}
