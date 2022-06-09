<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//print_r($arResult);
use Bitrix\Main\UI\Extension;
Extension::load('ui.bootstrap4');
?>
<table class="table table-bordered">
    <th>ID</th>
    <th>Лид</th>
    <th>Дата создания</th>
    <th>Источник</th>
    <th>Ответственный</th>
    <th>Статус</th>
    <th>Проверено</th>

<?
foreach ($arResult as $key =>$value) {
    echo "<tr>";

    ?><form name="updateLeadField" action="<?=POST_FORM_ACTION_URI?>" method="POST" enctype="multipart/form-data"><?
    foreach ($value as $key => $value) {
        if($key =='UF_CHECKED'){
            echo "<td><input  class='form-control border-0' name='" . $key . "' value='" . $value . "'></td>";
        }else{
            echo "<td><input readonly  class='form-control border-0' name='" . $key . "' value='" . $value . "'></td>";
        }
    }
    ?><td><button name="action"class="btn btn-primary" value="updateLeadField">Обновить</button></td></form><?
    echo "</tr>";
}
?>



