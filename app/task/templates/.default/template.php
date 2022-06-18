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
        <tbody class="ui-sortable">
        <tr v-for="(item, index) in items">
            <td> {{item.ID}} </td>
            <td> {{item.TITLE}} </td>
            <td> {{item.CREATED_DATE}} </td>
            <td> {{item.RESPONSIBLE_ID}} </td>
            <td> {{item.CREATED_BY}} </td>
            <td>
                <p><button class="btn" @click="item.UF_PRIORITY--, counter(item.ID, item.UF_PRIORITY)">-</button>
                <span data-name="sort">{{item.UF_PRIORITY}}</span>
                <button class="btn" v-on:click="item.UF_PRIORITY++, counter(item.ID, item.UF_PRIORITY)">+</button>
            </td/>`}).mount('#application');

$('.btn').click(function() {
    $('.ui-sortable tr').sort(function(a, b) {
        return +$(b).find('[data-name=sort]').text() - +$(a).find('[data-name=sort]').text();
    }).appendTo('.ui-sortable');
});

</script>


