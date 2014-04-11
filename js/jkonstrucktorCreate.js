//$(".row.FileField").change(
$("#KdCollectionTemp_BOMfile").change(
function(){
    var file = $("#KdCollectionTemp_BOMfile").val().split("\\")[2].split(".bom")[0].split("_");//распарсим имя файла
    var unit = file[1].toLowerCase();           //имя шкафа
    var pgvr = file[2];                         //номер ПГВР
    var version=file[3].split("v")[1];          //версия КД

    var assa=$("#KdCollectionTemp_projectid").html();

    alert(assa);
});

