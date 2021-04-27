jQuery(function($) {
    var max = 10;
    var x = 0;
    $('#add').click(function(e) {
        if (x < max) {
            $('#inp').append('<div data-item=true><label class="form-label" for="questiontext">Введите текст вопроса:</label><p id = "addInput"><input class = "form-control" name = "questiontext" id = "questiontext"type = "text" placeholder = "Модель - это" ><button class = "btn btn-primary remove_field" href = "#">-</button> <div id="inputasw"></div><button class = "btn btn-primary" id = "addansw">+</button></p><div>');
            x++;
            e.preventDefault();
        } else {
            $('#add').prop('disabled', true);
        }
    });
    $('#inp').on('click', '.remove_field', function(e) {
        $(this).closest('div[data-item]').remove();
        x--;
        e.preventDefault();
    })

});

jQuery(function($) {
    var max = 5;
    var x = 0;
    $('#addanswer').click(function(event) {
        if (x < max) {
            $('#inputasw').append('<div data-item=true><label class="form-label" for="questiontext">Введите вариант ответа:</label><p id = "addInput"><textarea class = "form-control" placeholder = "объект, который...." ></textarea><button class = "btn btn-primary remove_field" href = "#">-</button></p><div>');
            x++;
            event.preventDefault();
        } else {
            $('#addanswer').prop('disabled', true);
        }
    });
    $('#inputasw').on('click', '.remove_field_answer', function(event) {
        $(this).closest('div[data-item]').remove();
        x--;
        event.preventDefault();
    })
});