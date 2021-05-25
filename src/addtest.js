$(document).ready(function () {

    const createAnswerHtml = (question, index) => {
        return "<div class='answer' id='answer_" + index + "'><input type = 'checkbox' class = 'radio'  name = 'ischecked[" + question + "][" + index + "]'><input class = 'form-control'type = 'text' name = 'answer[" + question + "][" + index + "]' placeholder = 'Введите вариант ответа:'id = 'input_" + index + "'>&nbsp;<button class='btn btn-primary add-answer' id='answerb_" + index + "'>🔻</button>&nbsp;<button id='remove-answer_" + index + "' class='btn btn-primary remove-answer'>❌</button></div>";
    }

    $(document).on("click", ".add-answer", (e) => {
        const container = $(e.target).closest(".my-container");
        const nextindex = container.find(".answer").length;
        const containerQuestion = $(e.target).closest(".my-container-big");
        var question = containerQuestion.find(".element input[type=text]").attr("id");
        container.append(createAnswerHtml(question, nextindex));
        e.preventDefault();
    });

    $(document).on("click", ".remove-answer", (e) => {
        $(e.target).closest(".answer").remove();
        return false;
    });

    $(".add").click(function (e) {

        var total_element = $(".element").length;
        var lastid = $(".element:last").attr("id");
        var split_id = lastid.split("_");
        var nextindex = Number(split_id[1]) + 1;
        var max = 10;
        var index = 0;
        if (total_element < max) {

            $(".my-container-big:last").after("<div class='my-container-big' id='big_" + nextindex + "'></div>");
            e.preventDefault();

            $("#big_" + nextindex).append("<div class='element' id='element_" + nextindex + "'><input type='text' class ='form-control' id ='" + nextindex + "' name = 'question[" + nextindex + "]' placeholder='Введите текст вопроса:'>&nbsp;<button id='remove_" + nextindex + "' class='btn btn-primary remove'>✖️</button></div>");
            $("#big_" + nextindex).append("<div class='my-container' id='container_" + nextindex + "'>" + createAnswerHtml(nextindex, index) + "</div>");
index++;
        } else {
            $(".add").prop('disabled', true);
        }

    });

    $('.my-container-bigger').on('click', '.remove', function (e) {

        var id = this.id;
        var split_id = id.split("_");
        var deleteindex = split_id[1];

        $("#big_" + deleteindex).remove();
        e.preventDefault();
    });

});
$(document).ready(function () {
    var $checkbox = $('input[type=checkbox]');
    $checkbox .click(function (e) {
        if ($('input[type=checkbox]:checked')) {
            $(e.target).closest("input[type=checkbox]").prop('value', '1');
            $("input[type=checkbox]:not(:checked)").prop('value', '0');
        }
    });
});