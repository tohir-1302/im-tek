AvtoCreate('question');
AvtoCreate('option_a');
AvtoCreate('option_b');
AvtoCreate('option_c');
AvtoCreate('option_d');

function AvtoCreate(element) {
    var question_math = document.querySelector('#'+element+'_math');
    var question_formula =  document.querySelector('#'+element+'__formula');
    var formula_question =  document.querySelector('.formula_'+element);
    var question = document.querySelector('#questions-'+element);
    var question__formula__save = document.querySelector('#'+element+'__formula__save');

    question__formula__save.addEventListener('click',(ev) => {
        var text = question_math.value, new_text = '';
        question.value +=  '<math-field readonly >' + text + '</math-field>'; 
        question_math.value ='';
        formula_question.style.display = "none";
    }); 

    question_formula.addEventListener('click',(ev) => {
        if (formula_question.style.display == "flex") {
            formula_question.style.display = "none";
        }else{
            formula_question.style.display = "flex";
        }
    }); 
    
}

var question__file_button = document.querySelector('#question__file_button');
var question__file = document.querySelector('.question__file');

question__file_button.addEventListener('click',(ev) => {
    if (question__file.style.display == "inline") {
        question__file.style.display = "none";
    }else{
        question__file.style.display = "inline";
    }
});

