<?php
function ckeditor($text_area_name, $height = 400) {
    return '
    <script type="text/javascript">
//<![CDATA[
     var oFCKeditor = new FCKeditor("'.$text_area_name.'"); // привязка к textarea с id="body"

     oFCKeditor.BasePath="'.base_url().'system/plugins/fckeditor/"; //путь к fckeditor
     oFCKeditor.Config["CustomConfigurationsPath"] = "'.base_url().'system/plugins/fckeditor/fckconfig.js?" + ( new Date() * 1 ) ;
     oFCKeditor.ToolbarSet = "ZEdit" ;
     oFCKeditor.Language ="ru";
     oFCKeditor.DefaultLanguage = "ru";
     oFCKeditor.Height = "'.$height.'";
     oFCKeditor.ReplaceTextarea(); // вставка текста из textarea с id="body"
//]]>
    </script>';
}
function pass_helper($pass_filed_name = 'password') {
    return '
                        <script type="text/javascript">
                        $(function(){
                            $("#showpass").live("click", (function(){
                                var pass = $(this).parent("#passfield").find("#'.$pass_filed_name.'").attr("value");
                                $("#passfield").empty().append(\'<input type="text" id="'.$pass_filed_name.'" name="'.$pass_filed_name.'" value="\'+ pass +\'"/> <a id="hidepass" href="javascript:void(0);" title="Скрыть пароль">Скрыть</a><br />\')
                            }));
                            $("#hidepass").live("click", (function(){
                                var pass = $(this).parent("#passfield").find("#'.$pass_filed_name.'").attr("value");
                                $("#passfield").empty().append(\'<input type="password" id="'.$pass_filed_name.'" name="'.$pass_filed_name.'" value="\'+ pass +\'"/> <a id="showpass" href="javascript:void(0);" title="Показать пароль">Показать</a><br />\')
                            }));
                        });
                    </script>
                    <div id="passfield">
                        <input type="password" id="'.$pass_filed_name.'" name="'.$pass_filed_name.'" value=""/> <a id="showpass" href="javascript:void(0);" title="Показать пароль">Показать</a><br />
                    </div>';
}
function ruslat ($string) # Задаём функцию перекодировки кириллицы в транслит.
{
    $string = ereg_replace("ж","zh",$string);
    $string = ereg_replace("ё","yo",$string);
    $string = ereg_replace("й","i",$string);
    $string = ereg_replace("ю","yu",$string);
    $string = ereg_replace("ь","'",$string);
    $string = ereg_replace("ч","ch",$string);
    $string = ereg_replace("щ","sh",$string);
    $string = ereg_replace("ц","c",$string);
    $string = ereg_replace("у","u",$string);
    $string = ereg_replace("к","k",$string);
    $string = ereg_replace("е","e",$string);
    $string = ereg_replace("н","n",$string);
    $string = ereg_replace("г","g",$string);
    $string = ereg_replace("ш","sh",$string);
    $string = ereg_replace("з","z",$string);
    $string = ereg_replace("х","h",$string);
    $string = ereg_replace("ъ","''",$string);
    $string = ereg_replace("ф","f",$string);
    $string = ereg_replace("ы","y",$string);
    $string = ereg_replace("в","v",$string);
    $string = ereg_replace("а","a",$string);
    $string = ereg_replace("п","p",$string);
    $string = ereg_replace("р","r",$string);
    $string = ereg_replace("о","o",$string);
    $string = ereg_replace("л","l",$string);
    $string = ereg_replace("д","d",$string);
    $string = ereg_replace("э","yе",$string);
    $string = ereg_replace("я","jа",$string);
    $string = ereg_replace("с","s",$string);
    $string = ereg_replace("м","m",$string);
    $string = ereg_replace("и","i",$string);
    $string = ereg_replace("т","t",$string);
    $string = ereg_replace("б","b",$string);
    $string = ereg_replace("Ё","yo",$string);
    $string = ereg_replace("Й","i",$string);
    $string = ereg_replace("Ю","yu",$string);
    $string = ereg_replace("Ч","ch",$string);
    $string = ereg_replace("Ь","'",$string);
    $string = ereg_replace("Щ","sh'",$string);
    $string = ereg_replace("Ц","c",$string);
    $string = ereg_replace("У","u",$string);
    $string = ereg_replace("К","k",$string);
    $string = ereg_replace("Е","e",$string);
    $string = ereg_replace("Н","n",$string);
    $string = ereg_replace("Г","g",$string);
    $string = ereg_replace("Ш","sh",$string);
    $string = ereg_replace("З","z",$string);
    $string = ereg_replace("Х","h",$string);
    $string = ereg_replace("Ъ","",$string);
    $string = ereg_replace("Ф","f",$string);
    $string = ereg_replace("Ы","y",$string);
    $string = ereg_replace("В","v",$string);
    $string = ereg_replace("А","a",$string);
    $string = ereg_replace("П","p",$string);
    $string = ereg_replace("Р","r",$string);
    $string = ereg_replace("О","o",$string);
    $string = ereg_replace("Л","l",$string);
    $string = ereg_replace("Д","d",$string);
    $string = ereg_replace("Ж","zh",$string);
    $string = ereg_replace("Э","ye",$string);
    $string = ereg_replace("Я","ja",$string);
    $string = ereg_replace("С","s",$string);
    $string = ereg_replace("М","m",$string);
    $string = ereg_replace("И","i",$string);
    $string = ereg_replace("Т","t",$string);
    $string = ereg_replace("Б","b",$string);
    $string = str_replace(' ', '-', $string);
    $string = str_replace('"', '', $string);
    $string = str_replace('\'', '', $string);
    $string = str_replace('#', '', $string);
    $string = str_replace('$', '', $string);
    $string = str_replace('%', '', $string);
    $string = str_replace('№', '', $string);
    $string = str_replace('(', '', $string);
    $string = str_replace(')', '', $string);
    $string = trim($string);
    $string = strtolower($string);
    return $string;
}
?>