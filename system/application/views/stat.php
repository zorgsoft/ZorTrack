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
    $('#date_start').datePicker({startDate:'01-01-2010', clickInput:true});
    $('#date_end').datePicker({startDate:'01-01-2010', clickInput:true});
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
    <img border="0" src="<?=base_url()?>images/icons/16x16/my-account.png" border="0"> {l_user_login} ({l_user_name})<br><a href="<?=base_url()?>logout"><img border="0" src="<?=base_url()?>images/icons/16x16/sign-out.png" align="top" border="0"> Выход</a>
</div>
<!-- END LOGIN INFO -->

{left_tpl}

<!-- START CONTENT -->
<div class="main_content">
    <?=validation_errors();?><br>
    <? echo form_open('stat');?>
    <table width="100%"  id="active_tasks" class="table_tasks" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                Статистика для пользователя:
            </td>
            <td>
                <div style="display: inline-block; width: 100px;" align="right">&nbsp;</div>
                <?php if($users_list!=null): ?>
                <select id="task_for" name="task_for">
                    <?php foreach($users_list as $user_data): ?>
                    <option value="<?=$user_data->users_id?>" <?php if($sel_uid==$user_data->users_id) echo 'selected';?>><?=$user_data->users_login?> (<?=$user_data->users_name?>)</option>
                    <?php endforeach; ?>
                </select>
                <?php else: ?>
                <select id="task_for" name="task_for">
                    <option value="<?=$this->session->userdata('users_id')?>"><?=$this->session->userdata('users_login')?> (<?=$this->session->userdata('users_name')?>)</option>
                </select>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>
                Статистика за период:
            </td>
            <td>
                <div style="display: inline-block; width: 100px;" align="right">Начало:</div> <input type="text" id="date_start" name="date_start" size="36" value="<?=set_value('date_start', date('d-m-Y', now())); ?>"><br>
                <div style="display: inline-block; width: 100px;" align="right">Окончание:</div> <input type="text" id="date_end" name="date_end" size="36" value="<?=set_value('date_end', date('d-m-Y', now())); ?>">
            </td>
        </tr>
    </table>
    <div align="center"><input type="submit" value="Смотреть"><br><br>
        Затраченно на задания: {user_closed_days} дней, {user_closed_hours} часов и {user_closed_minutes} минут.<br>
        Всего рабочего времени (исключая перерывы на обед): {user_total_days} дней, {user_total_hours} часов и {user_total_minutes} минут.
    </div>
    <? echo form_close(); ?>

    <?php if($closed_tasks!=null): ?>
    <br><br><a class="closed_tasks_sh" href="#">Задачи закрытые:</a><br>
    <table width="100%" id="closed_tasks" class="table_tasks" cellpadding="0" cellspacing="0">
        <tr><th width="100px">Начата</th><th width="100px">Закрыли</th><th>Задача</th></tr>
    <?php foreach($closed_tasks as $closed_task): ?>
        <tr>
            <td><?=$closed_task->tasks_user_start_date?></td>
            <td><?=$closed_task->tasks_closed_date?></td>
            <td><a href="<?=base_url().'task/'.$closed_task->tasks_id?>"><?=$closed_task->tasks_title?></a></td>
        </tr>
    <?php endforeach; ?>
    </table>
    <?php endif; ?>
</div>
<!-- END CONTENT -->
{bottom_tpl}