{header_tpl}
<!-- START SCRIPTS -->
<script>
$(document).ready(function(){
    $("#start_time").clockpick({military: true, starthour: 0, endhour: 23, minutedivisions: 12});
    $("#end_time").clockpick({military: true, starthour: 0, endhour: 23, minutedivisions: 12});

    Date.format = 'dd-mm-yyyy';
    $.dpText = {
		TEXT_PREV_YEAR		:	'Предидущий год',
		TEXT_PREV_MONTH		:	'Предидущий месяц',
		TEXT_NEXT_YEAR		:	'Слкдующий год',
		TEXT_NEXT_MONTH		:	'Следующий месяц',
		TEXT_CLOSE			:	'Закрыть',
		TEXT_CHOOSE_DATE	:	'Выбор даты',
		HEADER_FORMAT		:	'mmmm yyyy'
	};
    $('#user_date_start').datePicker({startDate:'01-01-2010', clickInput:true});
    $('#user_date_end').datePicker({startDate:'01-01-2010', clickInput:true});
});
</script>

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
<?php endif; ?>
</table>
<?php if($tasks_closed==0): ?>
<br><br><?=validation_errors();?><br><br>
<? echo form_open('task_close/'.$tasks_id);?>
<table width="100%"  id="active_tasks" class="table_tasks" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            Начало работы:
        </td>
        <td>
            <input type="text" id="user_date_start" name="user_date_start" size="36" value="<?=set_value('user_date_start', date('d-m-Y', now())); ?>">  - Время: <input type="text" id="start_time" name="start_time" size="8" value="<?=set_value('start_time', date('H:i', now())); ?>">
        </td>
    </tr>
    <tr>
        <td>
            Окончание работы:
        </td>
        <td>
            <input type="text" id="user_date_end" name="user_date_end" size="36" value="<?=set_value('user_date_end', date('d-m-Y', now())); ?>">  - Время: <input type="text" id="end_time" name="end_time" size="8" value="<?=set_value('end_time', date('H:i', now())); ?>">
        </td>
    </tr>
    <tr>
        <td>
            Комментарарий:
        </td>
        <td>
            <textarea id="tasks_user_comment" name="tasks_user_comment" cols="46" rows="16"><?=set_value('tasks_user_comment'); ?></textarea>
        </td>
    </tr>
</table>
<div align="center"><input type="submit" value="Закрыть задачу"></div>
<? echo form_close(); ?>
<?php endif; ?>
</div>
<!-- END CONTENT -->
{bottom_tpl}