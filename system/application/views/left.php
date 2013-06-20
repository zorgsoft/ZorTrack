<!-- START LEFT MENU -->
<div class="main_left">
    <img alt=""  src="<?=base_url()?>images/icons/16x16/home.png" border="0"> <a href="<?=base_url()?>">На главную</a><br>
    <?php if($this->session->userdata('users_isadmin')==1): ?>
    <img alt="" src="<?=base_url()?>images/icons/16x16/customers.png" border="0"> <a href="<?=base_url()?>user_list">Список пользователей</a><br/>
    <img alt="" src="<?=base_url()?>images/icons/16x16/special-offer.png" border="0"> <a href="<?=base_url()?>user_add">Добавить пользователя</a><hr/>
    <?php endif; ?>
    <img alt="" src="<?=base_url()?>images/icons/16x16/future-projects.png" border="0"> <a href="<?=base_url()?>">Список задач</a><br>
    <img alt="" src="<?=base_url()?>images/icons/16x16/full-time.png" border="0"> <a href="<?=base_url()?>task_add">Добавить задачу</a><hr>
    <img alt="" src="<?=base_url()?>images/icons/16x16/statistics.png" border="0"> <a href="<?=base_url()?>stat">Статистика</a><br>
    <hr>
    <div align="center" class="work_time">
        Время прихода/ухода<br/>
        <?php if($this->in_out_data==null): ?>
        для даты: <?=date('d-m-Y')?><hr/>
        <form name="in_out" action="<?=base_url()?>main/in_out_save" method="post">
        <table width="100%" border="0">
            <tr>
                <td width="50%" align="right">
                    Пришел:
                </td>
                <td>
                    <input type="text" name="time_in" size="6" value="<?=date('H:i')?>">
                </td>
            </tr>
            <tr>
                <td width="50%" align="center">
                    Ообед с:<br/>
                    <input type="text" name="lunch_in" size="6" value="<?=date('H:i')?>">
                </td>
                <td align="center">
                    Ообед до:
                    <input type="text" name="lunch_out" size="6" value="<?=date('H:i')?>">
                </td>
            </tr>
            <tr>
                <td width="50%" align="right">
                    Ушел:
                </td>
                <td>
                    <input type="text" name="time_out" size="6" value="<?=date('H:i')?>">
                </td>
            </tr>
        </table><hr/>
        <input type="submit" value="Записать" title="Принять изменения и записать в базу">
    </form>
        <?php else: ?>
        для даты: <?=$this->in_out_data->in_out_date?><hr/>
        <form name="in_out" action="<?=base_url()?>main/in_out_save" method="post">
        <table width="100%" border="0">
            <tr>
                <td width="50%" align="right">
                    Пришел:
                </td>
                <td>
                    <input type="text" name="time_in" size="6" value="<?=date('H:i', strtotime($this->in_out_data->in_out_time_in))?>">
                </td>
            </tr>
            <tr>
                <td width="50%" align="center">
                    Ообед с:<br/>
                    <input type="text" name="lunch_in" size="6" value="<?=date('H:i', strtotime($this->in_out_data->in_out_lunch_in))?>">
                </td>
                <td align="center">
                    Ообед до:
                    <input type="text" name="lunch_out" size="6" value="<?=date('H:i', strtotime($this->in_out_data->in_out_lunch_out))?>">
                </td>
            </tr>
            <tr>
                <td width="50%" align="right">
                    Ушел:
                </td>
                <td>
                    <input type="text" name="time_out" size="6" value="<?=date('H:i', strtotime($this->in_out_data->in_out_time_out))?>">
                </td>
            </tr>
        </table><hr/>
        <input type="submit" value="Записать" title="Принять изменения и записать в базу">
        </form>
        <?php endif; ?>
        </div>
</div>
<!-- END LEFT MENU -->