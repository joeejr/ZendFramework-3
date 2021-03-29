<?php
namespace Blog\Model\Factory;

use Blog\Model;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;
use Interop\Container\ContainerInterface;


class PostTableGatewayFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Model\Post());
        return new TableGateway('post', $dbAdapter, null, $resultSetPrototype);
    }
}
