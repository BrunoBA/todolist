<tr id="<?= "tr-".$id;?>">
    <td style="text-align: center;">
        <input id="<?= $id; ?>" class="doActivity" type="checkbox" <?= ($concluido) ? 'checked="checked"' : '';?> >
    </td>
    <td >
        <span id="<?= "span-".$id;?>" class="spans"><?= $nome; ?></span>
        <div class="div-input" id="<?= "text-span-".$id;?>" style="display: none;">
            <input id="<?= "text-".$id;?>" class="input-name" type="text" value="<?= $nome; ?>">
            <button class="btn btn-lg btn-primary btn-sm change" >Salvar</button>
        </div>
    </td>
    <td>
        <button id="<?= $id; ?>" class="btn btn-lg btn-danger btn-sm rmActivity" >Remover</button>
    </td>
</tr>