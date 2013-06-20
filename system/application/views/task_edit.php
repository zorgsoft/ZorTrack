{header_tpl}
<!-- START SCRIPTS -->
<script>
$(document).ready(function(){
    $(".active_tasks_sh").click(function(){
        $("#active_tasks").slideToggle("fast");
        $(this).toggleClass("active");
    });
    $(".closed_tasks_sh").click(function(){
        $("#closed_tasks").slideToggle("fast");
        $(this).toggleClass("active");
    });
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
    <img src="<?=base_url()?>images/icons/16x16/my-account.png" border="0"> {l_user_login} ({l_user_name})<br><a href="<?=base_url()?>logout"><img src="<?=base_url()?>images/icons/16x16/sign-out.png" align="top" border="0"> Выход</a>
</div>
<!-- END LOGIN INFO -->

{left_tpl}

<!-- START CONTENT -->
<div class="main_content">
<?=validation_errors();?><br>
<? echo form_open('task_edit/'.$tasks_id);?>
<table width="100%"  id="active_tasks" class="table_tasks" cellpadding="0" cellspacing="0">
    <tr>
        <td width="260px">
            Задача для пользователя:
        </td>
        <td>
            <?php if($users_list!=null): ?>
            <select id="task_for" name="task_for">
                <?php foreach($users_list as $user_data): ?>
                <option value="<?=$user_data->users_id?>" <?php if($tasks_for_uid==$user_data->users_id) echo 'selected';?>><?=$user_data->users_login?> (<?=$user_data->users_name?>)</option>
                <?php endforeach; ?>
            </select>
            <?php else: ?>
            <select id="task_for" name="task_for">
                <option value="<?=$this->session->userdata('users_id')?>"><?=$this->session->userdata('users_login')?> (<?=$this->session->userdata('users_name')?> ----)</option>
            </select>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td>
            Название задачи:
        </td>
        <td>
            <input type="text" id="task_name" name="task_name" size="36" value="<?=set_value('task_name', $tasks_title); ?>">
        </td>
    </tr>
    <tr>
        <td>
            Описание задачи:
        </td>
        <td>
            <textarea id="task_description" name="task_description" cols="36" rows="16"><?=set_value('task_description', $tasks_description); ?></textarea>
            <?=ckeditor('task_description');?>
        </td>
    </tr>
    <tr>
        <td>
            Дата начала:
        </td>
        <td>
            <input type="text" id="date_start" name="date_start" size="36" value="<?=set_value('date_start', date('d-m-Y', strtotime($tasks_start_date))); ?>">  - Время: <input type="text" id="start_time" name="start_time" size="8" value="<?=set_value('start_time', date('H:i', strtotime($tasks_start_date))); ?>">
            <script>
                $('.date-pick').datePicker({startDate:'2010-01-01', clickInput:true});
            </script>
        </td>
    </tr>
    <tr>
        <td>
            Планируемая дата окончания:
        </td>
        <td>
            <input type="text" id="date_end" name="date_end" size="36" value="<?=set_value('date_end', date('d-m-Y', strtotime($tasks_end_date))); ?>"> - Время: <input type="text" id="end_time" name="end_time" size="8" value="<?=set_value('end_time', date('H:i', strtotime($tasks_end_date))); ?>">
            <script>
                $('.date-pick').datePicker({startDate:'2010-01-01', clickInput:true});
            </script>

        </td>
    </tr>
</table>
<div align="center"><input type="submit" value="Сохранить"></div>
<? echo form_close(); ?>
</div>
<!-- END CONTENT -->
{bottom_tpl}