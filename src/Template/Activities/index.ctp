<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Activity[]|\Cake\Collection\CollectionInterface $activities
  */
?>
<div class="activities index large-8 medium-8 columns content">
    <h3> TODO LIST </h3>
    <div id="list">
        <table cellpadding="0" cellspacing="0">
            <thead>
                <div style="display: inline-block;">
                <?php 
                    echo $this->Form->input('atividade',array('id'=>'addActivity','style'=>'width:300px','label'=>false,'placeholder'=>"O que deseja fazer?"));  
                ?>
                 <input type="button" value="Adicionar" class="addActivity" name="Adicionar"></input>
                </div>
            </thead>
            <tbody>
                <tr>
                    <th style="text-align: center;">
                        Concluído
                    </th>
                    <th>
                        Atividade
                    </th>
                    <th>
                        Ações
                    </th>
                </tr>
                <?php foreach ($activities as $activity): ?>
                <tr id="<?php echo "tr-".$activity->id;?>">
                    <td style="text-align: center;">
                        <input id="<?php echo $activity->id; ?>" class="doneActivity" type="checkbox" <?php if($activity->concluido){ echo 'checked=""';}?> >
                    </td>
                    <td >
                        <span id="<?php echo "span-".$activity->id;?>" class="spans">
                        <?php 
                            echo $activity->nome; 
                        ?>   
                        </span>
                        
                        <div class="div-input" id="<?php echo "text-span-".$activity->id;?>" style="display: none;">
                            <input id="<?php echo "text-".$activity->id;?>" class="input-name" type="text" value="<?php echo $activity->nome; ?>">
                            <input type="button" value="Alterar" class="change" name="Alterar"></input>
                        </div>

                    </td>
                    <td>
                        <input id="<?php echo $activity->id; ?>" type="button" value="Remover" class="rmActivity" name="Remover"></input>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr> 
                  <td> Progresso <span id="concluded"><?php echo $done;?></span>/<span id="total"><?php echo $quantity;?></span></td>
                </tr>
            </tfoot>
        </table>
    </div>
    
</div>
<?php echo $this->Html->script("jquery-3.2.1.min.js"); ?>
<?php echo $this->Html->script("activities.js"); ?>
