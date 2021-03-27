<?php

namespace Blog\Model;

use RuntimeException;
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

    public function save(Post $post){
        $data = [
            "title" => $post->title,
            "content" => $post->content,
        ];

        $id = (int)$post->id;
        if( $id === 0){
            $this->tableGateway->insert($data);
            return;
        }

        if(!$this->find($id)){
            throw new RuntimeException('Registro não encontrado',$id);
        }

        $this->tableGateway->update($data, ['id' => $post->id]);
        return;
    }

    public function find($id){
        $id = (int)$id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();

        if(!$row){
            throw new RuntimeException('Registro não encontrado',$id);
        }

        return $row;
    }

    public function delete($id){
        $this->tableGateway->delete(['id' => $id]);
    }
}

