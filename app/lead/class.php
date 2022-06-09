<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class ComponentLead extends CBitrixComponent
{
    public function executeComponent()
    {
        $this->templatePage = '';
        $arResult = array();
        $action = '';

        if (isset($_REQUEST['action']))
            $action = $_REQUEST['action'];

        switch ($action) {
            case 'updateLeadField':
                $arResult = $this->updateLeadField();

                if ($arResult['success'] == 1) {
                    LocalRedirect('/app/leads/');
                    exit();
                } else {
                    $arResult = $this->showLeadPage();
                }
                break;
            default:
                $arResult = $this->showLeadPage();
                break;
        }
    }

    private function updateLeadField()
    {
        $arUpdateField = [
            'UF_CHECKED' => $_REQUEST['UF_CHECKED'],
        ];
        $leadObj = new CCrmLead();
        return $leadObj->Update($_REQUEST['ID'], $arUpdateField);
    }

    private function showLeadPage()
    {
        $arSelect = [
            'ID', 'TITLE', 'DATE_CREATE', 'SOURCE_ID', 'ASSIGNED_BY', 'STATUS_ID', 'UF_CHECKED',
        ];
        $dbRes = CCrmLead::GetListEx('', '', '', '', $arSelect);

        while( $lead = $dbRes->fetch() )
        {
            $arResult[] = $lead;
        }

        $this->arResult = $arResult;
        $this->IncludeComponentTemplate($this->templatePage);
    }
}
?>