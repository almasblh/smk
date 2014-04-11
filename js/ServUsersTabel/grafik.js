$(document).ready(function(){
    $('.year-button').click(function(){
        var par=this.value.split(" ")[0]
        $('#year'+par).toggle('fast');
        return false;
    });

    Date.prototype.daysInMonth = function() {
        return 32 - new Date(this.getFullYear(), this.getMonth(), 32).getDate();
    };

    $('.button-manth').click(function(){
        var a=this.name.split("-")
        var year=a[0]
        var manth=a[1]
        var strhtml="<div><table><caption>привет</caption>"
            strhtml+="<th>дни</th>"
        var maxdate = (new Date(year, manth)).daysInMonth();
        for(var i=1;i<=maxdate;i++){
            strhtml+="<th>"
            strhtml+=i
            strhtml+="</th>"
        }
        strhtml+="</table></div>"
        $('#grafik'+this.name).html(strhtml)
        return false;
    });

    function getYearMonth(clas){
        alert()
        var a=$('.'+clas).name
        return a
    }

});    
