<?php

namespace Wealthbot\AdminBundle\Validator;

use Symfony\Component\Validator\Validator as baseValidator;

class Validator extends baseValidator
{

    /**
     * This method using to display errors for JSON responses. All constraint errors collecting to array like:
     * [fieldName]      => "Message one",
     * [anotherField]   => "Message two"
     *
     * @param $object
     * @param null $groups
     * @return array|null
     */
    public function validateForJson($object, $groups = null){

        $errorList = $this->validate($object, $groups);

        if($errorList->count() > 0) {
            $output = array();
            foreach($errorList as $error) {
                /* @var $error ConstraintViolation */
                $output[$error->getPropertyPath()] = $error->getMessage();

            }

            return $output;
        } else {

            return null;
        }
    }
}