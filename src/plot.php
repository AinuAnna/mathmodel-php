<?php
session_start();
include("bd.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Личный кабинет | Построение графиков</title>
    <?php include("head.php"); ?>
    <script src="https://unpkg.com/mathjs@9.3.2/lib/browser/math.js"></script>

    <script src="https://cdn.plot.ly/plotly-1.35.2.min.js"></script>

    <style>
        input[type=text] {
            width: 300px;
        }

        input {
            padding: 6px;
        }

        form {
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <?php include("headerStudent.php"); ?>
    <section class="slice bg-section-secondary">
        <div class="content will-help-you">
            <div class="container">
                <div class="row" style="flex-direction: column; align-items: center;">
                    <h2 class="display-5 text-shadow font-weight-bold" style="margin-bottom: 50px; color:#00090b;">Построение графиков по координатам</h2>
                    <form id="form">
                        <label class="form-label" for="eq">Введите данные:</label>
                        <input class="form-control" type="text" id="eq" value="x^2" />
                        <input class="form-control" type="text"  style = "margin-top: 1rem" id="eq2" value="x*3" />
                        <div class="col-md-12 text-center" style="margin-top: 2rem">
                            <button class="btn btn-primary" type="submit">Нарисовать</button>
                        </div>
                    </form>
                    <div id="plot"></div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function draw() {
            try {
                // compile the expression once
                const expression = document.getElementById('eq').value
                const expr = math.compile(expression)
                const expression2 = document.getElementById('eq2').value
                const expr2 = math.compile(expression2)

                // evaluate the expression repeatedly for different values of x
                const xValues = math.range(-10, 10, 0.5).toArray()
                const yValues = xValues.map(function(x) {
                    return expr.evaluate({
                        x: x,
                    })
                })
                const yValues2 = xValues.map(function(x) {
                    return expr2.evaluate({
                        x: x,
                    })
                })

                // render the plot using plotly
                const trace1 = {
                    x: xValues,
                    y: yValues,
                    type: 'polyline',
                }
                const trace2 = {
                    x: xValues,
                    y: yValues2,
                    type: 'polyline',
                }
                const data = [trace1, trace2]
                Plotly.newPlot('plot', data)
            } catch (err) {
                console.error(err)
                alert(err)
            }
        }

        document.getElementById('form').onsubmit = function(event) {
            event.preventDefault()
            draw()
        }

        draw()
    </script>

</body>

</html>