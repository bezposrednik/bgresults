<?php

namespace Services\Abstracts;

abstract class Service extends \Phalcon\DI\Injectable {
    
    protected $di;
    protected $manager;
    protected $model;
    protected $ordering = 'id ASC';
    
    protected $operators = ['=', '!=', '<=', '<', '<>', '>', '>=', 'LIKE', 'NOT LIKE', 'IS NULL', 'IS NOT NULL', 'IN', 'NOT IN'];
    
    public function __construct($model) {
        $this->model = $model;
        
        /**
         * Load the dependency injection
         */
        $this->di = $this->getDI();

        /**
         * Load the models manager (check config/services.php for modelsManager setup)
         */
        $this->manager = $this->di->getModelsManager();
    }

    /**
     * Helper method to build a better conditions for Query
     * 
     * @param array $options
     * @param string $mode
     * @return string
     */
    // public function createConditions(array $options, $mode = 'AND') {
    //     /**
    //      * Create a conditions string based on the options provided
    //      */
    //     $result = '';

    //     /**
    //      * Itterate each of the options to build the conditions
    //      */
    //     foreach ($options as $option => $attributes):
    //         $column = $option;

    //         /**
    //          * Verify the information for the attirbutes
    //          */
    //         if (is_array($attributes)):
    //             $operation = '=';

    //             /**
    //              * Verify that the we have the operation for the condition and is part from the allowed types of operations
    //              */
    //             if (isset($attributes['operation']) && in_array($attributes['operation'], $this->operators)):
    //                 $operation = $attributes['operation'];
    //             endif;

    //             /**
    //              * Set the column name for the condition, by default we use the options key as column name
    //              */
    //             if (isset($attributes['column']) && trim($attributes['column']) !== ""):
    //                 $column = $attributes['column'];
    //             endif;

    //             /**
    //              * Append the condition string to the final result
    //              */
    //             switch ($operation):
    //                 case "IN":
    //                 case "NOT IN":
    //                     $result .= $column . ' ' . $operation . ' ({' . $option . ':array}) ' . $mode . ' ';
    //                 break;
                
    //                 case "IS NULL":
    //                 case "IS NOT NULL":
    //                     $result .= $column . ' ' . $operation . ' ' . $mode . ' ';
    //                 break;

    //                 default:
    //                     $result .= $column . ' ' . $operation . ' :' . $option . ': ' . $mode . ' ';
    //                 break;
    //             endswitch;
                
    //             continue;
    //         endif;

    //         /**
    //          * Append the condition string to the final result
    //          */
    //         $result .= $column . ' = :' . $option . ': ' . $mode . ' ';
    //     endforeach;

    //     return rtrim(trim($result), ' ' . $mode);
    // }

    /**
     * Helper method to build a better parameters for Query
     * 
     * @param array $options
     * @return array
     */
    // public function createParameters(array $options) {
    //     $result = [];
        
    //     /**
    //      * Itterate each of the options to build the parameters
    //      */
    //     foreach ($options as $option => $attributes):
    //         $column = $option;
        
    //         /**
    //          * Verify the information for the attirbutes
    //          */
    //         if (is_array($attributes)):
    //             $value = '';
            
    //             /**
    //              * Verify that the we have the operation for the condition and is not in the excluded list
    //              */
    //             if (isset($attributes['operation']) && in_array(trim(strtoupper($attributes['operation'])), ['IS NULL', 'IS NOT NULL'])):
    //                 continue;
    //             endif;  
                
    //             /**
    //              * Load the value for the parameter
    //              */
    //             if (isset($attributes['value'])):
    //                $value = $attributes['value'];
    //             endif;
                
    //             /**
    //              * When the value is array we need to collect only the values without the keys
    //              */
    //             if (is_array($value)):
    //                 $value = array_values($value);
    //             endif;
                
    //             /**
    //              * Append the parameter to the final result
    //              */
    //             $result[$column] = $value;
    //             continue;
    //         endif;
            
    //         /**
    //          * Append the parameter to the final result
    //          */
    //         $result[$column] = $attributes;
    //     endforeach;
        
    //     return $result;
    // }
}
