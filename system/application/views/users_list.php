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
    <?php if($users_list!=null): ?>
    <table width="100%"  id="active_tasks" class="table_tasks" cellpadding="0" cellspacing="0">
        <tr><th width="20px">*</th><th width="160px">Логин</th><th width="160px">Фамилия И.О.</th><th>Примечание</th><th width="40px">&nbsp;</th></tr>
    <?php foreach($users_list as $single_user): ?>
        <tr>
            <td align="center"><a href="<?=base_url().'user_edit/'.$single_user->users_id?>" title="Редактировать пользователя"><img border="0" src="<?=base_url()?>images/icons/16x16/pencil.png"></a></td>
            <td>
                <?php if($single_user->users_isadmin==1): ?>
                <img border="0" src="<?=base_url()?>images/icons/16x16/star.png" alt="Администратор" title="Этот пользователь Администратор">
                <?php endif; ?>
                <a href="<?=base_url().'user/'.$single_user->users_login?>"><?=$single_user->users_login?></a>
            </td>
            <td><?=$single_user->users_name?></td>
            <td><?=$single_user->users_comments?></td>
            <td align="center"><a  onclick="return confirm('Удалить пользователя - <?=$single_user->users_login?>? \nТакже будут удаленны все задачи связанные с ним.')" href="<?=base_url().'user_del/'.$single_user->users_id?>" title="Удалить пользователя"><img border="0" src="<?=base_url()?>images/icons/16x16/busy.png"></a></td>
        </tr>
    <?php endforeach; ?>
    </table>
    <?php endif; ?>
</div>
<!-- END CONTENT -->
{bottom_tpl}