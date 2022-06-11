<link rel="stylesheet" href="../Botaniste/plante.css">
<style>
.chart {
    width: 800px;
}







/*
Basic input element using psuedo classes
*/

html {
    font-family: 'Lora', sans-serif;
    width: 100%;
}





/* Question */


/* Underline and Placeholder */
</style>

<link rel="stylesheet" href="../styles/shop.css">
<link rel="stylesheet" href="../Botaniste/sideBar.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Gestion des plantes</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<body>
    <?php
include('sideBar.php')

?>

    <div class="main">
        <div class="chart">
            <canvas id="humidityChart">
            </canvas>
        </div>
        <div class="chart">
            <canvas id="tempChart">
            </canvas>
        </div>

    </div>

    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

    <script>
    var ctx = document.querySelector("#humidityChart");
    var temp = document.querySelector("#tempChart");
    const params = new URLSearchParams(window.location.search);
    if (!params.has('idPlante')) {
        location.href = './consulter.php';

    }
    idPlante = params.get('idPlante');

    fetch('http://localhost/shop/Botaniste/getHumidity.php?idPlante=' + idPlante)
        .then(response => response.json())
        .then(data => {



            console.log(data)
            var date = [];
            var humidity = [];




            for (var i in data) {
                date.push(data[i].Date);
                humidity.push(data[i].HumiditeAir);
            }
            console.log(date);
            console.log(humidity)

            var data = {
                labels: date,
                datasets: [{
                    label: "Humidty",
                    data: humidity,
                    backgroundColor: "blue",
                    borderColor: "lightblue",

                    fill: false,
                    lineTension: 0,
                    radius: 6
                }]
            };
            //options
            var options = {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 52
                        },
                    }]
                },
                title: {
                    display: true,
                    position: "top",
                    text: "Line Graph",
                    fontSize: 40,
                    fontColor: "#111"
                },
                legend: {
                    display: true,
                    position: "bottom",
                    labels: {
                        fontColor: "#333",
                        fontSize: 20
                    }
                }
            };

            //create Chart class object
            var chart = new Chart(ctx, {
                type: "line",
                data: data,
                options: options
            });
            var chart = new Chart(temp, {
                type: "line",
                data: data,
                options: options
            });

            var body = document.body,
                html = document.documentElement;


            var height = Math.max(body.scrollHeight, body.offsetHeight,
                html.clientHeight, html.scrollHeight, html.offsetHeight);
            document.querySelector('.menu').style.height = height;
            console.log(height);

        }, );
    </script>
</body>
<?php
    if (!isset($_GET['idPlante'])) {
        echo("<script>location.href = './PlanteManage.php';</script>");
        # code...
    }
    $idPlante = $_GET['idPlante'];
    

?>