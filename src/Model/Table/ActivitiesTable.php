<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

class ActivitiesTable extends Table
{

    public function getAll($flag = TRUE){

        $query = $this->find('all')
        ->order(array("Activities.id"=>"ASC"))
        ->where(array("Activities.excluido" => 0));
        $activities =  $query->toArray();

        if($flag)
            return $activities;
        return count($activities);
    }

    public function getCompleted($flag = TRUE){

        $query = $this->find('all')
        ->where(array("Activities.excluido" => 0, "Activities.concluido"=>1));
        $conclusions =  $query->toArray();
        
        if($flag)
            return $conclusions;
        return count($conclusions);
        
    }

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('activities');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('nome')
            ->notEmpty('nome',"Atividade obrigatória!");            

        $validator
            ->allowEmpty('excluido');

        return $validator;
    }

    public function validationUpdate(Validator $validator)
    {
        echo "daale";
        die;
    }
}
