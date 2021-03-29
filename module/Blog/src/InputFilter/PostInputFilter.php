<?php

namespace Blog\InputFilter;

use Zend\InputFilter\InputFilter;

class PostInputFilter extends InputFilter
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->add();
    }
}