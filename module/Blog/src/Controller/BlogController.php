<?php

namespace Blog\Controller;

use Blog\Model\Post;
use Blog\Form\PostForm;
use Blog\InputFilter\PostInputFilter;
use Blog\Model\PostTable;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

class BlogController extends AbstractActionController
{
    private PostTable $table;
    private PostForm $form;

    /**
     * Class constructor.
     * @param PostTable $table
     * @param PostForm $form
     */
    public function __construct(PostTable $table, PostForm $form)
    {
        $this->table = $table;
        $this->form = $form;
    }

    public function indexAction()
    {
        $postTable = $this->table;
        return new ViewModel(
            ['posts' => $postTable->fetchAll()]
        );
    }

    public function addAction()
    {
        $form = $this->form;
        $form->get('submit')->setValue('Create Post');

        $request = $this->getRequest();

        if (!$request->isPost()) {
            return [
                'form' => $form
            ];
        }

        $form->setData($request->getPost());
        if(!$form->isValid()){
            return [
                'form' => $form
            ];
        }

        $post = new Post();
        $post->exchangeArray($form->getData());
        $this->table->save($post);

        return $this->redirect()->toRoute('post');
    }

    public function editAction(){
        $id = (int) $this->params()->fromRoute('id', 0);

        if(!$id){
            return $this->redirect()->toRoute('post');
        }

        try {
            $post = $this->table->find($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('post');
        }

        $form = new $this->form;
        $form->bind($post);
        $form->get('submit')->setAttribute('value', 'Edit Post');

        $request = $this->getRequest();
        if(!$request->isPost()){
            return [
                'id' => $id,
                'form' => $form
            ];
        }

        $form->setData($request->getPost());
        if(!$form->isValid()){
            return [
                'id' => $id,
                'form' => $form
            ];
        }

        $post = new Post();
        $post->exchangeArray($form->getData());

        $this->table->save($post);

        return $this->redirect()->toRoute('post');
    }

    public function deleteAction(){
        $id = (int) $this->params()->fromRoute('id', 0);

        if(!$id){
            return $this->redirect()->toRoute('post');
        }

        $this->table->delete($id);

        return $this->redirect()->toRoute('post');
    }
}
