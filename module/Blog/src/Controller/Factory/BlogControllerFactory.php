<?php
namespace Blog\Controller\Factory;

use Blog\Model\PostTable;
use Blog\Controller\BlogController;
use Interop\Container\ContainerInterface;



class BlogControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new BlogController(
            $container->get(PostTable::class)
        );
    }
}
