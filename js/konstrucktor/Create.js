$(document).ready(function(){
    //show();
    //setInterval('show()',1000);

    $(".row.FileField").change(function(){                                      //при изменении имени БОМ файла 
        PrepareDataForMakeKDCollection();                                       //вызвать функцию формироваия данных для сборки проекта из КД
    });
});
//------------------------------------------------------------------------------------------------------
function show(){
    $.ajax({
        url: "js/konstrucktor/time.php",
        cache: false,
        success: function(html){
                $("#time").html(html);
        }
    });
}

function progress(percent) {                                                    //функция вывода прогресса парсинга в класс progress
    $(".progress").load(percent);
}

function PrepareDataForMakeKDCollection(){                                      //функция формирования данных для сборки проекта из КД
    var file = $("#KdCollectionTemp_BOMfile").val().split("\\")[2].split(".bom")[0].split("_");//распарсим BOM - файл
    var unit = file[1].toLowerCase();                                           //имя шкафа

    var pgvr = file[2];                                                         //номер ПГВР
    var version=file[3].split("v")[1];                                          //версия КД
    var UnitSys = $(".UnitSys").val().split('_');                               //взять список всех возможных шкафов, разделить на строки
    var findUnitSys=false;
        for (key in UnitSys) {                                                  //для каждой строки
            var as = UnitSys[key].split(';');                                   //разделить на ячейки 0-id,1-name,2-systemid
            if(as[1]===unit){                                                   
               // alert(as[1]+' - '+unit+' - '+as[2]);
                //$(".prUnit").val(as[1]+'/'+as[0]);
                $("#KdCollectionTemp_SMKsystemid [value='"+as[2]+"']").attr('selected', 'selected');
                findUnitSys=true;
                break;
            }
        }
    var findProject=false;
        if(pgvr===$(".Project").val()) findProject=true;
    var findUnit=false;
    var a=$(".prUnit").val().split('/');
        //alert(a[1]+''+unit);
        if(unit===a[1]) findUnit=true;
    var findVersion=false;
        if($("#KdCollectionTemp_lastKD").val()==(version-1)) findVersion=true;
    
        if(findUnitSys && findProject && findUnit && findVersion){
            $("#assa").css("visibility","visible");            
        }
        else{
            var a;
            if(!findUnitSys)
                a='Система не совпадает с файлом. Выберите приавильное имя БОМ файла';
            if(!findProject)
                a='Проект не совпадает с файлом. Выберите правильный БОМ файл';
            if(!findUnit)
                a='Шкаф из BOM файла не совпадает со предполагаемым шкафом для генерации. Исправьте ситуацию';
            if(!findVersion)
                a='Версия проекта в базе отличается от версии файла более чем на 1. Это неправильно и при генерации приведет к большим сложностям. Проверьте, возможно данная версия уже используется.';
                $("#KdCollectionTemp_BOMfile").val('');
            alert(a);
        }
}
    
    //$("#KdCollectionTemp_SMKprojectid :contains("+pgvr+")").attr('selected', 'selected');//зделать выбранным элмент Проекта(ПГВР) в соответствии с BOM - файлом
    //$("#KdCollectionTemp_prunitid [value='"+unit+"']").attr('selected', 'selected');//зделать выбранным элмент Проекта(ПГВР) в соответствии с BOM - файлом
//еще нужно как-то выбрать номер системы - пока не ясно