<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class ComponentTask extends CBitrixComponent
{
    public function executeComponent()
    {
       $this->templatePage = '';
        $arResult = array();
        $action = '';

       if (isset($_REQUEST['action']))
           $action = $_REQUEST['action'];
        switch ($action) {
            case 'update':
               $arResult = $this->updateTaskField();

                if ($arResult) {
                    global $APPLICATION;
                    $APPLICATION->RestartBuffer();
                    echo json_encode(true);
                    exit();
                } else {
                    $arResult = $this->showTaskPage();
                }
                break;
            default:
               $arResult = $this->showTaskPage();
                break;
        }
   }

    private function updateTaskField()
    {
        $arUpdateTaskField = [
            'UF_PRIORITY' => $_REQUEST['priority'],
        ];
        $obTask = new CTasks;
        return $result = $obTask->Update($_REQUEST['id'], $arUpdateTaskField);
    }

    private function showTaskPage()
    {
        $arSelect = [
            'ID', 'TITLE', 'CREATED_DATE', 'RESPONSIBLE_ID', 'CREATED_BY', 'UF_PRIORITY'
        ];
        $res = CTasks::GetList(Array("UF_PRIORITY" => "DESC"),[],$arSelect,[],[]);

        while( $lead = $res->fetch() )
        {
            $arResult[] = $lead;
        }

        $this->arResult = $arResult;
        $this->IncludeComponentTemplate($this->templatePage);
   }
}
?>