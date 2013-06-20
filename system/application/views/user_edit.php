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
<?php echo form_open('user_edit/'.$edit_users_id);?>
<table width="100%"  id="active_tasks" class="table_tasks" cellpadding="0" cellspacing="0">
    <tr>
        <td width="260px">
            Логин пользователя (e-mail):
        </td>
        <td>
            <?=$edit_users_login?>
        </td>
    </tr>
    <tr>
        <td>
            Фамилия И.О.:
        </td>
        <td>
            <input type="text" id="full_name" name="full_name" size="36" value="<?=set_value('full_name', $edit_users_name); ?>">
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
            <input type="text" id="phone" name="phone" size="36" value="<?=set_value('phone', $edit_users_phone); ?>">
        </td>
    </tr>
    <?php if ($this->session->userdata('users_isadmin') == 1): ?>
    <tr>
        <td>
            Администратор:
        </td>
        <td>
            <input type="checkbox" id="is_admin" name="is_admin" <?=$edit_users_isadmin?>><label for="is_admin"> Сделать этого пользователя администратором</label>
        </td>
    </tr>
    <?php endif; ?>
    <tr>
        <td>
            Комментарий:
        </td>
        <td>
            <textarea id="user_comment" name="user_comment" cols="56" rows="9"><?=set_value('user_comment', $edit_users_comments); ?></textarea>
        </td>
    </tr>
</table>
<div align="center"><input type="submit" value="Сохранить"></div>
<? echo form_close(); ?>
</div>
<!-- END CONTENT -->
{bottom_tpl}