<div class="activities index large-8 medium-8 columns content">
    <h3> TODO LIST </h3>
    <div id="list">
        <div style="display: inline-block;">
            <input type="text" id="addActivity" placeholder="O que deseja fazer?">
            <input type="button" value="Adicionar" class="addActivity" name="Adicionar"></input>
        </div>
        <table cellpadding="0" cellspacing="0">
            <thead>
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
            </thead>
            <tbody id="concat">
                <?php foreach ($activities as $activity): ?>
                <tr id="tr-<?= $activity->id;?>">
                    <td style="text-align: center;">
                        <input id="<?= $activity->id; ?>" class="doneActivity" type="checkbox" <?= ($activity->concluido) ? 'checked=""':'';?> >
                    </td>
                    <td >
                        <span id="span-<?= $activity->id;?>" class="spans">
                        <?= $activity->nome; ?>   
                        </span>
                        
                        <div class="div-input" id="text-span-<?= $activity->id;?>" style="display: none;">
                            <input id="text-<?= $activity->id;?>" class="input-name" type="text" value="<?= $activity->nome; ?>">
                            <input type="button" value="Alterar" class="change" ></input>
                        </div>

                    </td>
                    <td>
                        <input id="<?= $activity->id; ?>" type="button" value="Remover" class="rmActivity"></input>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr> 
                    <td colspan="3">
                    Progresso 
                        <span id="concluded"><?= $done;?></span>/<span id="total"><?= $quantity;?></span>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    
</div>
<?php echo $this->Html->script("jquery-3.2.1.min.js"); ?>
<?php echo $this->Html->script("activities.js"); ?>
