$(document).ready(function() {

    const createAnswerHtml = (index) => {
        return "<div class='answer' id='answer_" + index + "'><input class = 'form-control'type = 'text' name = 'answer[]' placeholder = 'Введите вариант ответа:'id = 'txt_" + index + "'>&nbsp;<button class='btn btn-primary add-answer' id='answerb_" + index + "'>🔻</button>&nbsp;<button id='remove-answer_" + index + "' class='btn btn-primary remove-answer'>❌</button></div>";
    }

    $(document).on("click", ".add-answer", (e) => {
        const container = $(e.target).closest(".my-container");
        const nextindex = container.find(".answer").length;
        container.append(createAnswerHtml(nextindex));
        e.preventDefault();
    });

    $(document).on("click", ".remove-answer", (e) => {
        $(e.target).closest(".answer").remove();
        return false;
    });

    $(".add").click(function(e) {

        var total_element = $(".element").length;

        var lastid = $(".element:last").attr("id");
        var split_id = lastid.split("_");
        var nextindex = Number(split_id[1]) + 1;
        var max = 10;

        if (total_element < max) {

            $(".my-container-big:last").after("<div class='my-container-big' id='big_" + nextindex + "'></div>");
            e.preventDefault();

            $("#big_" + nextindex).append("<div class='element' id='element_" + nextindex + "'><input type='text' class ='form-control' name = 'question[]' placeholder='Введите текст вопроса:' id='txt_" + nextindex + "'>&nbsp;<button id='remove_" + nextindex + "' class='btn btn-primary remove'>✖️</button></div>");
            $("#big_" + nextindex).append("<div class='my-container' id='container_" + nextindex + "'>" + createAnswerHtml(nextindex) +"</div>");
        } else {
            $(".add").prop('disabled', true);
        }

    });

    $('.my-container-bigger').on('click', '.remove', function(e) {

        var id = this.id;
        var split_id = id.split("_");
        var deleteindex = split_id[1];

        $("#big_" + deleteindex).remove();
        e.preventDefault();
    });

});