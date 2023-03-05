
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
