var test_answer_id = $("input[id='test_answer_id']").val()
function SaveAnswer() {
    var option_1 = document.getElementById("option-1");
    var option_2 = document.getElementById("option-2");
    var option_3 = document.getElementById("option-3");
    var option_4 = document.getElementById("option-4");
    var Answer = 0;
    
    if (option_1.checked == true) {
        Answer = 1
    }
    
    if (option_2.checked == true) {
        Answer = 2
    }
    if (option_3.checked == true) {
        Answer = 3
    }
    if (option_4.checked == true) {
        Answer = 4
    }


    $.post("<?= Yii::$app->getUrlManager()->createUrl(['home/check-answer'])?>", {
        test_answer_id : test_answer_id,
        answer : Answer, 
    }, function(data) {
        },
        'json'
    );
}


$(".back__button").click(function (e) {
    SaveAnswer();    
});

$(".next__button").click(function (e) {
    SaveAnswer();    
});


$(".end__test").click(function (e) {
    SaveAnswer();    
});

$(".numbers__test").click(function (e) {
    SaveAnswer();    
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
            SaveAnswer();    
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


var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close__img")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}



