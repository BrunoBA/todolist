<tr id="<?= "tr-".$id;?>">
    <td style="text-align: center;">
        <input id="<?= $id; ?>" class="doneActivity" type="checkbox" <?= ($concluido) ? 'checked="checked"' : '';?> >
    </td>
    <td >
        <span id="<?= "span-".$id;?>" class="spans"><?= $nome; ?></span>
        <div class="div-input" id="<?= "text-span-".$id;?>" style="display: none;">
            <input id="<?= "text-".$id;?>" class="input-name" type="text" value="<?= $nome; ?>">
            <input type="button" value="Alterar" class="change" name="Alterar"></input>
        </div>
    </td>
    <td>
        <input id="<?= $id; ?>" type="button" value="Remover" class="rmActivity" name="Remover"></input>
    </td>
</tr>