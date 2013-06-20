<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ZorTrack Ver <?=ZORTRACK_VERSION?></title>
<meta name="Keywords" content="{keywords}">
<meta name="Description" content="{description}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel=stylesheet type="text/css" href="<?=base_url()?>css/ztrack.css">
</head>
<body>
    <div class="login_title">
        {message}<br>{error_message}
    </div>
    <div class="login_window">
        <? echo form_open('login');?>
        <br>
        <table border="0" width="100%">
            <tr>
                <td align="right">
                    <label for="login">Логин (e-mail):</label>
                </td>
                <td align="left">
                    <input type="text" id="login" name="login" class="login_window_input">
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="password">Пароль:</label>
                </td>
                <td align="left">
                    <input type="password" id="password" name="password" class="login_window_input">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Вход" style="width: 120px; height: 25px">
                </td>
            </tr>
        </table>
        <? echo form_close(); ?>
        <?=validation_errors();?>
    </div>
</body>
</html>