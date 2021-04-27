$(document).ready(function() {
    jQuery(function($) {
        var max = 10;
        var x = 0;
        var count = 0;
        $('#add').click(function(e) {
            if (x < max) {
                $('#inp').append(`<div data-item=true><label class="form-label" for="questiontext">Введите текст вопроса:</label><p id="addInput"><input class="form-control" name="questiontext" id = "questiontext"type = "text" placeholder = "Модель - это" ><button class = "btn btn-primary remove_field">-</button><div class="inputasw ${count}"></div><button class="btn btn-primary addanswer" data-item = ${count}>+</button></p></div>`);
                x++;
                count++;
                e.preventDefault();
                e.stopPropagation();
                var maxy = 5;
                var y = 0;
                $('.addanswer').click(function(event) {
                    event.stopPropagation();
                    event.preventDefault();
                    var target = $(event.target).attr('data-item');
                    if (y < maxy) {
                        $(`.inputasw ${target}`).append('<div data-item2=true><label class="form-label" for="answer">Введите вариант ответа:</label><p id = "addInput"><textarea placeholder = "объект, который...." ></textarea><button class = "btn btn-primary remove_field_answer">-</button></p></div>');
                        y++;
                    } else {
                        $('.addanswer').prop('disabled', true);
                    }
                });
                $(`.inputasw ${this.count}`).on('click', '.remove_field_answer', function(event) {
                    event.stopPropagation();
                    event.preventDefault();
                    $(this).closest('div[data-item2]').remove();
                    y--;
                });

            } else {
                $('#add').prop('disabled', true);
            }
        });
        $('#inp').on('click', '.remove_field', function(e) {
            $(this).closest('div[data-item]').remove();
            x--;
            count--;
            e.preventDefault();
            e.stopPropagation();
        })

    });
});