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
    <img src="<?=base_url()?>images/icons/16x16/my-account.png" border="0"> {l_user_login} ({l_user_name})<br><a href="<?=base_url()?>logout"><img src="<?=base_url()?>images/icons/16x16/sign-out.png" align="top" border="0"> Выход</a>
</div>
<!-- END LOGIN INFO -->

{left_tpl}

<!-- START CONTENT -->
<div class="main_content">
<?=validation_errors();?><br>
<table width="100%"  id="active_tasks" class="table_tasks" cellpadding="0" cellspacing="0">
    <tr>
        <td width="260px">
            Задача для пользователя:
        </td>
        <td>
                <?php if($users_list!=null): ?>
                <?php foreach($users_list as $user_data): ?>
                <?php if($tasks_for_uid==$user_data->users_id): ?>
                <?=$user_data->users_login?> (<?=$user_data->users_name?>)
                <?php endif; ?>
                <?php endforeach; ?>
                <?php else: ?>
                {l_user_login} ({l_user_name})
                <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td>
            Название задачи:
        </td>
        <td>
            <?=$tasks_title?>
        </td>
    </tr>
    <tr>
        <td>
            Описание задачи:
        </td>
        <td class="task_description" valign="top">
            <?=$tasks_description?>
        </td>
    </tr>
    <tr>
        <td>
            Дата начала:
        </td>
        <td>
            <?=date('d-m-Y', strtotime($tasks_start_date)); ?>  - Время: <?=date('H:i', strtotime($tasks_start_date)); ?>
        </td>
    </tr>
    <tr>
        <td>
            Планируемая дата окончания:
        </td>
        <td>
            <?=date('d-m-Y', strtotime($tasks_end_date)); ?> - Время: <?=date('H:i', strtotime($tasks_end_date)); ?>
        </td>
    </tr>
<?php if($tasks_closed==1): ?>
    <tr>
        <td>
            Начало работы над задачей:
        </td>
        <td>
            <?=date('d-m-Y', strtotime($tasks_user_start_date)); ?>  - Время: <?=date('H:i', strtotime($tasks_user_start_date)); ?>
        </td>
    </tr>
    <tr>
        <td>
            Закрытие задачи:
        </td>
        <td>
            <?=date('d-m-Y', strtotime($tasks_closed_date)); ?> - Время: <?=date('H:i', strtotime($tasks_closed_date)); ?>
        </td>
    </tr>
    <tr>
        <td>
            Комментарий пользователя:
        </td>
        <td class="task_description" valign="top">
            <?=$tasks_user_comment?>
        </td>
    </tr>
<?php endif; ?>
</table>
<?php if($tasks_closed==0): ?>
<div align="center"><a style="text-decoration: none;" href="<?=base_url().'task_close/'.$tasks_id?>"><img src="<?=base_url()?>images/icons/32x32/check.png" border="0"><br>Закрыть задачу</a></div>
<?php endif; ?>
</div>
<!-- END CONTENT -->
{bottom_tpl}