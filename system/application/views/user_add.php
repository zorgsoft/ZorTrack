{header_tpl}
<!-- START SCRIPTS -->

<!-- END SCRIPTS -->
<!-- START TITLE -->
<div class="main_title" style="vertical-align: middle">
    <div class="main_title_text">{title}</div>
</div>
<!-- END TITLE -->

<!-- START LOGIN INFO -->
<div class="main_login_panel">
    <img border="0" src="<?=base_url()?>images/icons/16x16/my-account.png" border="0"> {l_user_login} ({l_user_name})<br><a href="<?=base_url()?>logout"><img border="0" src="<?=base_url()?>images/icons/16x16/sign-out.png" align="top" border="0"> Выход</a>
</div>
<!-- END LOGIN INFO -->

{left_tpl}

<!-- START CONTENT -->
<div class="main_content">
<?=validation_errors();?><br>
<?php echo form_open('user_add');?>
<table width="100%"  id="active_tasks" class="table_tasks" cellpadding="0" cellspacing="0">
    <tr>
        <td width="260px">
            Логин пользователя (e-mail):
        </td>
        <td>
            <input type="text" id="login" name="login" size="36" value="<?=set_value('login'); ?>">
        </td>
    </tr>
    <tr>
        <td>
            Фамилия И.О.:
        </td>
        <td>
            <input type="text" id="full_name" name="full_name" size="36" value="<?=set_value('full_name'); ?>">
        </td>
    </tr>
    <tr>
        <td>
            Пароль:
        </td>
        <td>
            <input type="text" id="user_password" name="user_password" size="36" value="<?=set_value('user_password'); ?>">
        </td>
    </tr>
    <tr>
        <td>
            Телефон:
        </td>
        <td>
            <input type="text" id="phone" name="phone" size="36" value="<?=set_value('phone'); ?>">
        </td>
    </tr>
    <tr>
        <td>
            Администратор:
        </td>
        <td>
            <input type="checkbox" id="is_admin" name="is_admin" <?=set_value('is_admin'); ?>><label for="is_admin"> Сделать этого пользователя администратором</label>
        </td>
    </tr>
    <tr>
        <td>
            Комментарий:
        </td>
        <td>
            <textarea id="user_comment" name="user_comment" cols="56" rows="9"><?=set_value('user_comment'); ?></textarea>
        </td>
    </tr>
</table>
<div align="center"><input type="submit" value="Добавить"></div>
<? echo form_close(); ?>
</div>
<!-- END CONTENT -->
{bottom_tpl}