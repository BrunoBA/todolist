<?php
namespace App\Controller;

use App\Controller\AppController;

class ActivitiesController extends AppController
{

    public function index()
    {
        $query = $this->Activities->find('all')
        ->order(array("Activities.id"=>"ASC"))
        ->where(array("Activities.excluido" => 0));
        $activities =  $query->toArray();

        $quantity = count($activities);


        $query = $this->Activities->find('all')
        ->where(array("Activities.excluido" => 0, "Activities.concluido"=>1));
        $concluded =  $query->toArray();
        $done = count($concluded);
       
        $this->set(compact('done'));
        $this->set(compact('quantity'));
        $this->set(compact('activities'));
        $this->set('_serialize', ['activities']);
    }

    public function add()
    {   

        $activity = $this->Activities->newEntity();
        if($this->request->is('Ajax')) {

            $activity = $this->Activities->patchEntity($activity, $this->request->getData());

            $retorno = array();

            $this->autoRender = false;

            if ($this->Activities->save($activity)) {
                $retorno['status'] = "sucess";
                $retorno['msg'] = "Atividade inserida com sucesso!";
            }else{
                $retorno['status'] = "error";
                $retorno['msg'] = "Erro ao inserir atividade!";
            }

            // $query = $this->Activities->find('all')->all();
            // $lastCreated =  $query->last();
            // var_dump($lastCreated['id']);
            // die;

            echo json_encode($retorno);
        }
    }

    public function edit($id = null)
    {
        $this->autoRender = false;
        $activity = $this->Activities->newEntity();
        if($this->request->is('Ajax')) {

            $post = $this->request->getData();

            $activity = $this->Activities->get($post['id']);
            $activity['nome'] = $post['name'];

            $retorno = array();

            if ($this->Activities->save($activity)) {
                $retorno['status'] = "sucess";
                $retorno['msg'] = "Atividade alterada com sucesso!";
            }else{
                $retorno['status'] = "error";
                $retorno['msg'] = "Erro ao alterada atividade!";
            }

            echo json_encode($retorno);
        }
    }

    public function delete($id = null)
    {

        $this->autoRender = false;
        $activity = $this->Activities->newEntity();
        if($this->request->is('Ajax')) {

            $retorno = array();

            $post = $this->request->getData();

            $activity = $this->Activities->get($post['id']);
            $activity['excluido'] = 1;
            $retorno['concluido'] = $activity['concluido'];

            if ($this->Activities->save($activity)) {
                $retorno['status'] = "sucess";
                $retorno['msg'] = "Atividade removida com sucesso!";
            }else{
                $retorno['status'] = "error";
                $retorno['msg'] = "Erro ao remover atividade!";
            }

            echo json_encode($retorno);
        }
    }

    public function concluir($id = null)
    {

        $this->autoRender = false;
        $activity = $this->Activities->newEntity();
        if($this->request->is('Ajax')) {

            $post = $this->request->getData();

            $activity = $this->Activities->get($post['id']);
            $activity['concluido'] = !$activity['concluido'];

            $retorno = array();

            if ($this->Activities->save($activity)) {
                $retorno['status'] = "sucess";
                $retorno['type'] = $activity['concluido'];               
                $retorno['msg'] = "Atividade concluida com sucesso!";
            }else{
                $retorno['status'] = "error";
                $retorno['msg'] = "Erro ao concluir atividade!";
            }

            echo json_encode($retorno);
        }
    }

    public function update()
    {

        if($this->request->is('Ajax')) {

            $query = $this->Activities->find('all')
            ->order(array("Activities.id"=>"DESC"))
            ->where(array("Activities.excluido" => 0));
            $activities =  $query->toArray();

            $quantity = count($activities);

            $query = $this->Activities->find('all')
            ->where(array("Activities.excluido" => 0, "Activities.concluido"=>1));
            $concluded =  $query->toArray();
            $done = count($concluded);
           
            $this->set(compact('done'));
            $this->set(compact('quantity'));
            $this->set(compact('activities'));
            $this->set('_serialize', ['activities']);

        }
    }

}
