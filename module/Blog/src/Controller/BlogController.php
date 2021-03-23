<?php

namespace Blog\Controller;

use Blog\Model\PostTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BlogController extends AbstractActionController
{
    private $table;

    /**
     * Class constructor.
     */
    public function __construct(PostTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        $postTable = $this->table;
        return new ViewModel(
            ['posts' => $postTable->fetchAll()]
        );
    }
}
