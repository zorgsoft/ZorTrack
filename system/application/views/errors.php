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
    <div class="big_error_message" align="center">{error_message}</div>
</div>
<!-- END CONTENT -->
{bottom_tpl}