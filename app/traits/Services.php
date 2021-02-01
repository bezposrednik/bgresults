<?php

namespace Traits;

trait Services {

    /**
     * 
     * Helper method to set ordering for the result
     * 
     * @param string $order
     * @return object instance
     */
    public function setOrdering($order) {
        $this->ordering = $order;
        return $this;
    }

    /**
     * Helper method to get ordering for the result
     * 
     * @return mixed
     */
    public function getOrdering() {
        if (property_exists($this, 'ordering')):
            return $this->ordering;
        endif;

        return null;
    }

    /**
     * Get a single record with parameters: id
     * 
     * @param int $id
     * @return $this->model;
     */
    public function getItem($id) {
        if (!$this->model || !class_exists($this->model)):
            return null;
        endif;

        return call_user_func(array($this->model, 'findFirst'), array("id = :id:", "bind" => array("id" => (int) $id)));
    }

    /**
     * Get a list of records with parameters: list of model options
     * 
     * @param array $options
     * @return $this->model;
     */
    public function getItems($options = array()) {
        if (!$this->model || !class_exists($this->model)):
            return null;
        endif;

        return call_user_func(array($this->model, 'find'), $options);
    }

    /**
     * Get a list of records with parameters: list of options
     * 
     * @param array $options
     * @param boolean $single
     * @param string $mode
     * @return $this->model
     */
    public function getItemsByOptions(array $options, $single = true, $mode = 'AND') {
        if (!$this->model || !class_exists($this->model)):
            return null;
        endif;

        /**
         * Return empty instance of the model if the parameter $options is empty array,
         * The idea of returning empty instance is to have access to some of the model functions
         */
        if (empty($options)):
            return null;
        endif;

        /**
         * Create a conditions string based on the options provided
         */
        $conditions = $this->createConditions($options, $mode);

        /**
         * Return empty instance of the model if the parameter $conditions is empty array
         */
        if (trim($conditions) == ''):
            return null;
        endif;

        /**
         * Create parameters array based on the options provided
         */
        $parameters = $this->createParameters($options);

        /**
         * We need only one result, we dont need results to be in list of arrays
         */
        if ($single):
            return call_user_func(array($this->model, 'findFirst'), array($conditions, "bind" => $parameters, 'order' => $this->ordering));
        endif;

        return call_user_func(array($this->model, 'find'), array($conditions, "bind" => $parameters, 'order' => $this->ordering));
    }

    /**
     * Remove a single record with parameters: id
     * 
     * @param int $id
     * @return boolean;
     */
    public function removeItem($id) {        
        /**
         * Load the information for the item
         */
        $item = $this->getItem($id);
        
        /**
         * Verify that the information is loaded properly
         */
        if (!$item || !isset($item->id) || !(int) $item->id):
            return false;
        endif;

        /**
         * Flush the model data and return error messages if the action was not successfull
         */          
        if ($item->delete() == false):
            $messages = [];

            foreach ($item->getMessages() as $message):
                $messages[] = $message;
            endforeach;

            throw new \Exception('Error occurred while removing item. ' . $messages, 500);
        endif;
        
        return true;
    }

}
