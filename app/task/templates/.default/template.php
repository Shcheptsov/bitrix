<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
\Bitrix\Main\UI\Extension::load("ui.vue3");
use Bitrix\Main\UI\Extension;
Extension::load('ui.bootstrap4');
?>

<div id="application"></div>

<script type="text/javascript">

BX.BitrixVue.createApp({
    data:{
        items:<?=json_encode($arResult)?>
    },
    methods: {
        counter: function (id,priority) {
            $.ajax({
                data: {
                    action:'update', id:id, priority:priority
                },
                dataType: 'json',
                type:"POST",
                url:"/app/task/",
                success: function(data) {
                    console.log(data);
                },
                error: function () {
                    console.log('Error');
                }
            });
        }
    },
    template: `
        <table class="table table-bordered">
            <th>ID</th>
            <th>Название</th>
            <th>Дата постановки</th>
            <th>Ответственный</th>
            <th>Постановщик</th>
            <th>Приоритет</th>
        <tbody>
        <tr v-for="(item, index) in items">
            <td> {{item.ID}} </td>
            <td> {{item.TITLE}} </td>
            <td> {{item.CREATED_DATE}} </td>
            <td> {{item.RESPONSIBLE_ID}} </td>
            <td> {{item.CREATED_BY}} </td>
            <td>
                <p><button @click="item.UF_PRIORITY--, counter(item.ID, item.UF_PRIORITY)">-</button>{{item.UF_PRIORITY}}
                <button v-on:click="item.UF_PRIORITY++, counter(item.ID, item.UF_PRIORITY)">+</button>
            </td/>`}).mount('#application');

</script>


