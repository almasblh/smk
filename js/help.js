function createInfo() {
  var container = document.createElement('div')

  container.innerHTML = '<div class="Info">\
<style type="text/css">\
.Info {\
   width:800px;\
   height:600px;\
   background-color:#00f0f0;\
   text-align: center;\
   border: 2px groove black;\
}\
.Info-title {\
  height:20px;\
  font-size:120%;\
  background-color:white;\
}\
.Info-body {\
  padding: 5px;\
  height: 50px;\
}\
.info {\
	font-weight: bold;\
}\
.info1 {\
	font-size: 10px;\
}\
.info1 .info {\
	font-size: 12px;\
}\
</style>\
<div class="Info-title"> Информация о системе </div>\
<div class="Info-body">\
\
<p class="info">Cистема СМК предназначена для автоматизации производственных процессов, связанных с технологией производства.\
</p>\
<p> <span class="info1"><span class="info">Для входа в систему необходимо:</span></span></p>\
<blockquote>\
  <p class="info"><span class="info1">1.	набрать в браузере - <a href="http://vi-inv-nn.sintek.net/smk">http://vi-inv-nn.sintek.net/smk</a> (предпочтение Chrome, Mozila. Плохо работает в IE)</span></p>\
  <p class="info"><span class="info1">2. Найти себя в системе.</span></p>\
  <p class="info"><span class="info1">3. Ввести свой пароль.</span></p>\
</blockquote>\
<p class="info"><span class="info1"> Каждый пользователь в системе имеет свою роль со своим набором прав.\
Если что-то не работает или работает не так как хотелось-бы - обращаться к Маслову А. Ю. тел 220.</span></p>\
<p class="info"> Что сейчас умеет система:</p>\
<blockquote>\
  <p> <span class="info1">1. Хранить все введенные в нее проекты с описанием и этапами.</span></p>\
  <p class="info1"> 2. С правами отдела ОУП назначать новые этапы проекту с назначением ответственных лиц и сроков исполнения.</p>\
  <p class="info1"> 3. Ответственным лицам за конкретный этап - вести оперативный журнал с указанием процента выполнения этапа.</p>\
  <p class="info1"> 4. С правами конструктора:\
    - из правильно оформленного файла в формате ShcemaGee КД на конкретный шкаф:\
    - формировать перечень элементов;</span></span></span></p>\
    - формировать список каналов\
  </p>\
  <p class="info1">5. С правами испытателя генерировать протоколы внутренних испытаний.  </p>\
  <p class="info1">6. С правами Администрация - просматривать весь ход ведения проекта.  </p>\
  <p class="info1">7. Любой пользователь системы может добавить новую рекламацию в разделе рекламации. Дальнейшее продвижение рекламации регулирует менеджер по рекламациям и назначенные им ответственные лица\
    Система постоянно совершенствуется и в ближайшем будущем будут подключаться все новые модули. </p>\
</blockquote>\
</div> \
    <input class="Info-ok" type="button" value="OK"/> \
  </div>'

  return container.firstChild
}

function positionMessageInfo(elem) {
  elem.style.position = 'absolute'

  var scroll = document.documentElement.scrollTop || document.body.scrollTop
  elem.style.top = scroll + 100 + 'px'

  elem.style.left = Math.floor(document.body.clientWidth/2) - 100 + 'px'
}

function addCloseOnClickInfo(messageElem) {
  var input = messageElem.getElementsByTagName('INPUT')[0]
  input.onclick = function() {
    messageElem.parentNode.removeChild(messageElem)
  }
}


function setupMessageInfo() {
  var messageElem = createInfo()
  positionMessageInfo(messageElem)
  addCloseOnClickInfo(messageElem)
   document.body.appendChild(messageElem)
}
        
        
