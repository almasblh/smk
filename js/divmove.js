$(document).ready(function(){
     //======= Перетаскивание ======

     // Назначение своих обработчиков для событий,
     // связанных с перетаскиванием
     document.onmousedown=mouseDownEvent;
     document.onmousemove=mouseMoveEvent;
     document.onmouseup=mouseUpEvent;

     // Положение курсора относительно картинки
     // в момент начала перетаскивания
     var dx;
     var dy;

     // Указатель на перетаскиваемый элемент или null
     var imgDragging = null;

     // Обработка захвата элемента
     // --------------------------
     function mouseDownEvent()
     {
    //   if (event.srcElement.tagName == "P")
       if (event.srcElement.id == "Header")
    {
         // Запомним указатель на объект
         imgDragging = event.srcElement.parentNode.parentNode.parentNode
         // Вычислим смещения мышиного курсора
         // относительно начала перетаскиваемого элемента
         dx = event.offsetX;
         dy = event.offsetY;

         // Элемент передвинем  в верхний слой
         imgDragging.style.zIndex=10;
       }
       // Перетаскивание запрещено
       else imgDragging = null;
     }

     // Обработка перемещения элемента
     // ------------------------------
     function mouseMoveEvent()
     {
       if (imgDragging != null)
       {
         // Вычислим новые координаты элемента
         imgDragging.style.pixelLeft = event.x - dx+'px';
         imgDragging.style.pixelTop  = event.y - dy+'px';
//imgDragging.innerText=imgDragging.style.Left;
         // Остановим прохождение события
          event.cancelBubble = true;
         event.returnValue = false;
       }
     }

     // Обработка освобождения элемента
     // -------------------------------
     function mouseUpEvent()
     {
       if (imgDragging != null)
       {
         // Вернем элемент в основной  слой
         imgDragging.style.zIndex=9;

         // Сбросим признак перемещения
         imgDragging = null;

       }
     }

})