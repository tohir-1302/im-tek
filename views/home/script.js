
var test_answer_id = $("input[id='test_answer_id']").val()



$(".option-1").click(function (e) {
    $.post("<?= Yii::$app->getUrlManager()->createUrl(['home/check-answer'])?>", {
        test_answer_id : test_answer_id,
        answer : 1, 
    }, function(data) {
        },
        'json'
    );
});

$(".option-2").click(function (e) {
    $.post("<?= Yii::$app->getUrlManager()->createUrl(['home/check-answer'])?>", {
        test_answer_id : test_answer_id,
        answer : 2, 
    }, function(data) {
        },
        'json'
    );
});

$(".option-3").click(function (e) {
    $.post("<?= Yii::$app->getUrlManager()->createUrl(['home/check-answer'])?>", {
        test_answer_id : test_answer_id,
        answer : 3, 
    }, function(data) {
        },
        'json'
    );
});

$(".option-4").click(function (e) {
    $.post("<?= Yii::$app->getUrlManager()->createUrl(['home/check-answer'])?>", {
        test_answer_id : test_answer_id,
        answer : 4, 
    }, function(data) {
        },
        'json'
    );
});

// timer

var time = document.querySelector('.time_')
    time = new Date(time.innerText)


function getTimeRemaining(endtime) {
    var timer = Date.parse(endtime) - Date.parse(new Date()),
        hour = Math.floor(timer / (1000 * 60 * 60) % 24),
        min = Math.floor(timer / (1000 * 60) % 60),
        sec = Math.floor(timer / (1000) % (60))

        if (timer < 0) {
            hour = 0
            min = 0
            sec = 0
        }
    return {timer, hour, min, sec}

}

function addNol(time) {
    if (time < 10 && time >= 0) {
        return "0"+time
    }

    return time
}

function setClock(endtime) {
    var hours = document.querySelector('.hours'),
        minut =  document.querySelector('.minut'),
        secund =  document.querySelector('.secund'),
        test_singup_id =  document.querySelector('.test_singup_id'),
        timeInterval = setInterval(updateClock, 1000)

    function updateClock() {
        const t = getTimeRemaining(endtime)

        hours.innerHTML = addNol(t.hour)
        minut.innerHTML = addNol(t.min)
        secund.innerHTML = addNol(t.sec)

        if (t.timer <= 0) {
            clearInterval(timeInterval)

            $.ajax({
                type : "POST",  //type of method
                url  : "<?= Yii::$app->getUrlManager()->createUrl(['home/end-test'])?>",  //your page
                data : { test_singup_id : test_singup_id.innerText},// passing the values
                success: function(res){  
                        }
            });

        }                        
    }
}

setClock(time);



window.addEventListener("load", (event) => {
    window.customElements.whenDefined('math-field');
    var question = document.querySelector('#question_text')
    var ML__mathlive = document.querySelector('.ML__mathlive')
    var ML__base = document.querySelector('.ML__base')
    console.dir(question.style.width);
    question.style.width  = "auto"
    ML__mathlive.style.width  = "auto"
    $(document).ready(function() {
    $(".ML__mathlive").remove();
    $(".ML__base").remove();
    )}
  });





