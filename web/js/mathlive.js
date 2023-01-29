
AvtoCreate('question');
AvtoCreate('option_a');
AvtoCreate('option_b');
AvtoCreate('option_c');
AvtoCreate('option_d');


function AvtoCreate(element) {
    var question_math = document.querySelector('#'+element+'_math');
    var question = document.querySelector('#questions-'+element);
    question_math.addEventListener("keydown", function(event) {
        if (event.keyCode == 32) {
            question_math.value = question_math.value + "\\,";
        }
    });

    question_math.addEventListener('input',(ev) => {
        var text = question_math.value, new_text = '';
        for (let index = 0; index < text.length; index++) {
            if (text[index] != ' ') {
                new_text = new_text + text[index];
            }
        }
        question.value = new_text;
        question_math.value = new_text;
    }); 

    question.addEventListener('input',(ev) => {
        question_math.value = question.value;
    })
}
