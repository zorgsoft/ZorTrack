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
    <?php if($active_tasks!=null): ?>
    <a class="active_tasks_sh" href="#">Задачи активные:</a><br>
    <table width="100%"  id="active_tasks" class="table_tasks" cellpadding="0" cellspacing="0">
        <tr><th width="20px">*</th><th width="180px">Пользователь</th><th width="100px">Начать</th><th width="100px">Завершить</th><th>Задача</th><th width="40px">&nbsp;</th></tr>
    <?php foreach($active_tasks as $active_task): ?>
        <tr>
            <?php $out_of_date_class =''; if(date('Y-m-d H:i:s',now())>date($active_task->tasks_end_date)) $out_of_date_class = 'class="table_tasks_red"';?>
            <td <?=$out_of_date_class?> align="center"><a href="<?=base_url().'task_close/'.$active_task->tasks_id?>" title="Закрыть задачу"><img border="0" src="<?=base_url()?>images/icons/16x16/current-work.png"></a></td>
            <td <?=$out_of_date_class?>><a href="<?=base_url().'user/'.$active_task->for_login?>"><?=$active_task->for_login?></a><br><div title="Поставил задачу" style="font-size: xx-small; display: inline;">(<?=$active_task->man_login?>)</div></td>
            <td <?=$out_of_date_class?>><?=$active_task->tasks_start_date?></td>
            <td <?=$out_of_date_class?>><?=$active_task->tasks_end_date?></td>
            <td <?=$out_of_date_class?>><a href="<?=base_url().'task/'.$active_task->tasks_id?>"><?=$active_task->tasks_title?></a></td>
            <td <?=$out_of_date_class?> align="center"><a href="<?=base_url().'task_edit/'.$active_task->tasks_id?>" title="Редактировать"><img border="0" src="<?=base_url()?>images/icons/16x16/pencil.png"></a>&nbsp;&nbsp;<a  onclick="return confirm('Удалить задачу - <?=$active_task->tasks_title?>?')" href="<?=base_url().'task_del/'.$active_task->tasks_id?>" title="Удалить задачу"><img border="0" src="<?=base_url()?>images/icons/16x16/busy.png"></a></td>
        </tr>
    <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <?php if($closed_tasks!=null): ?>
    <br><br><a class="closed_tasks_sh" href="#">Задачи закрытые:</a><br>
    <table width="100%" id="closed_tasks" class="table_tasks" cellpadding="0" cellspacing="0">
        <tr><th width="20px">*</th><th width="180px">Пользователь</th><th width="100px">Начата</th><th width="100px">Закрыли</th><th>Задача</th><th width="20px">X</th></tr>
    <?php foreach($closed_tasks as $closed_task): ?>
        <tr>
            <td align="center"><a href="<?=base_url().'task_open/'.$closed_task->tasks_id?>" title="Открыть задачу"><img border="0" src="<?=base_url()?>images/icons/16x16/finished-work.png"></a></td>
            <td><a href="<?=base_url().'user/'.$closed_task->for_login?>"><?=$closed_task->for_login?></a><br><div title="Поставил задачу" style="font-size: xx-small; display: inline;">(<?=$closed_task->man_login?>)</div></td>
            <td><?=$closed_task->tasks_user_start_date?></td>
            <td><?=$closed_task->tasks_closed_date?></td>
            <td><a href="<?=base_url().'task/'.$closed_task->tasks_id?>"><?=$closed_task->tasks_title?></a><br><?=$closed_task->tasks_user_comment?></td>
            <td align="center"><a onclick="return confirm('Удалить задачу - <?=$closed_task->tasks_title?>?')" href="<?=base_url().'task_del/'.$closed_task->tasks_id?>" title="Удалить задачу"><img border="0" src="<?=base_url()?>images/icons/16x16/busy.png"></a></td>
        </tr>
    <?php endforeach; ?>
    </table>
    <?php endif; ?>
</div>
<!-- END CONTENT -->
{bottom_tpl}