<?php

namespace Blog\Model;

use Zend\Db\TableGateway\TableGatewayInterface;


class PostTable
{
    private $tableGateway;

    /**
     * Class constructor.
     */
    public function __construct(TableGatewayInterface $tableGatewayInterface)
    {
        $this->tableGateway = $tableGatewayInterface;
    }

    public function fetchAll(){
        return $this->tableGateway->select();
    }
}
