<?php

namespace Blog\InputFilter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;

class PostInputFilter extends InputFilter
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->add([
            'name' => 'title',
            'required' => true,
            'filters' => [
                ['name' => StringTrim::class],
                ['name' => StripTags::class],
            ]
        ]);
        $this->add([
            'name' => 'content',
            'required' => true
        ]);
    }
}