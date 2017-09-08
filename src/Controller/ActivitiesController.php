<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Exception\Exception;

class ActivitiesController extends AppController
{

    private $return = array();

    public function index()
    {
        $this->set('done',$this->Activities->getCompleted(FALSE));
        $this->set('quantity',$this->Activities->getAll(FALSE));
        $this->set('activities',$this->Activities->getAll());
        
    }

    public function add()
    {   

        $activity = $this->Activities->newEntity();

        if($this->request->is('Ajax')) {

        
            $activity = $this->Activities->patchEntity($activity, $this->request->getData());                        

            if ($this->Activities->save($activity)){
                
                $this->set('id',$activity['id']);
                $this->set('nome',$activity['nome']);
                $this->set('concluido',$activity['concluido']);

            }else{
                // throw new Exception($activity->manageError());
                $this->autoRender = false;
            }    
        }
    }

    public function edit($id = null)
    {
        $this->autoRender = false;
        
        $activity = $this->Activities->newEntity();

        if($this->request->is('Ajax')) {

            $post = $this->request->getData();

            $activity = $this->Activities->get($post['id']);
            $activity->nome = $post['name'];

            if (!empty($post['name'] && trim($post['name'])) && $this->Activities->save($activity)) {
                
                $this->return['status'] = "success";
                $this->return['message'] = "Atividade alterada com sucesso!";

            }else{
                $this->return['status'] = "error";
                $this->return['message'] = (!empty($post['name'] && trim($post['name']))) ? "Erro ao alterar atividade!" : "Nome da atividade é obrigatória!";
            }

            echo json_encode($this->return);
        }
    }

    public function delete($id = null)
    {

        $this->autoRender = false;

        $activity = $this->Activities->newEntity();

        if($this->request->is('Ajax')) {

            $post = $this->request->getData();

            $activity = $this->Activities->get($post['id']);
            $activity->excluido = 1;

            $this->return['concluido'] = $activity['concluido'];

            if( $activity['concluido'] == 0 && $this->Activities->save($activity) ) {
                $this->return['status'] = "success";
                $this->return['message'] = "Atividade removida com sucesso!";
            }else{
                $this->return['status'] = "error";
                $this->return['message'] = ($activity['concluido'] == 0) ? "Erro ao remover atividade!" : "Não é possível deletar uma atividade concluída!";
            }

            echo json_encode($this->return);
        }
    }

    public function concluir($id = null)
    {

        $this->autoRender = false;

        $activity = $this->Activities->newEntity();

        if($this->request->is('Ajax')) {

            $post = $this->request->getData();

            $activity = $this->Activities->get($post['id']);
            $activity->concluido = !$activity['concluido'];

            $action = ($activity->concluido) ? "concluída" : "alterada";

            if ($this->Activities->save($activity)) {
                $this->return['status'] = "success";
                $this->return['type'] = $activity['concluido'];               
                $this->return['message'] = "Atividade ".$action." com sucesso!";
                
            }else{
                $this->return['status'] = "error";
                $this->return['message'] = "Erro ao concluir atividade!";
            }

            echo json_encode($this->return);
        }
    }
}
