<?php
namespace Blog\Form\Factory;

use Blog\Form\PostForm;
use Blog\InputFilter\PostInputFilter;

class PostFormFactory
{
    public function __invoke(ContainerInterface $container)
    {
      $inputFilter = new PostInputFilter();
      $form = new PostForm();
      $form->setInputFilter($inputFilter);
      return $form;
    }
}
