<body>
    <?php
include('sideBar.php')

?>
    <link rel="stylesheet" href="../styles/shop.css">

    <div class="main">
        <div class="condition">
            <label for="start"> La date:</label>
            <input type="date" id="start" name="trip-start" value="2022-04-27">
            <label class="specialLabel" for="option"> Type de graphe:</label>
            <select class="option" name="option" id="type">
                <option value="Humidite">Humidite</option>
                <option value="Humidite de sol">Humidite de sol</option>
                <option value="Temp">Temp</option>
                <option value="light">light</option>
            </select>
            <button class="consulter">Consulter</button>

        </div>
        <div class="chart">
            <canvas id="humidityChart">
            </canvas>
        </div>
        <div class="chart">
            <canvas id="tempChart">
            </canvas>
        </div>
        <div class="chart">
            <canvas id="lightChart">
            </canvas>
        </div>
        <div class="chart">
            <canvas id="solChart">
            </canvas>
        </div>

        <a class="buttonFixed" href="javascript:void(0)"
            onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">Ridiger
            une observation</a>
        <div id="light" class="white_content">
            <div>
                <form action="plante.php" method="GET">
                    <textarea name="message" rows="2" class="question" id="msg" required autocomplete="off"></textarea>
                    <label for="msg"><span id="etq">Ecrire ici votre observation</span>
                    </label>
                    <input type="text" name="idPlante" <?php echo 'value='.$_GET["idPlante"] ?> style="display:none ;">
                    <input type="submit" value="Enregistrer!" />
                </form>

            </div>
            <a class="buttonFixed" href="javascript:void(0)"
                onclick="document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Fermer
                la fenetre</a>
        </div>
        <div id="fade" class="black_overlay"></div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

    <script>
    var ctx = document.querySelector("#humidityChart");
    var chart2 = document.querySelector("#lightChart");
    var chart3 = document.querySelector("#tempChart");
    var chart4 = document.querySelector("#solChart");
    const params = new URLSearchParams(window.location.search);
    if (!params.has('idPlante')) {
        location.href = './consulter.php';

    }
    idPlante = params.get('idPlante');
    document.querySelector('.consulter').addEventListener("click", (e) => {


        const date = document.getElementById("start").value;
        let typeOfGraphe = document.getElementById('type').value;
        console.log(typeOfGraphe)

        switch (typeOfGraphe) {
            case 'Humidite':

                fetch('./getHumidity.php?idPlante=' + idPlante + '&date=' + date)
                    .then(response => response.json())
                    .then(data => {




                        var date = [];
                        var humidity = [];




                        for (var i in data) {
                            date.push(data[i].Date);
                            humidity.push(data[i].HumiditeAir);
                        }


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
                                text: "Humidty Graph",
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

                        var body = document.body,
                            html = document.documentElement;


                        var height = Math.max(body.scrollHeight, body.offsetHeight,
                            html.clientHeight, html.scrollHeight, html.offsetHeight);
                        document.querySelector('.menu').style.height = height;


                    }, );


                break;
            case 'Humidite de sol':

                fetch('./getSol.php?idPlante=' + idPlante + '&date=' + date)
                    .then(response => response.json())
                    .then(data => {



                        console.log(data)
                        var date = [];
                        var humidity = [];




                        for (var i in data) {
                            date.push(data[i].Date);
                            humidity.push(data[i].HumiditeSol);
                        }


                        var data = {
                            labels: date,
                            datasets: [{
                                label: "HumiditeSol",
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
                                        min: 1900
                                    },
                                }]
                            },
                            title: {
                                display: true,
                                position: "top",
                                text: "HumiditeSol Graph",
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
                        var chart = new Chart(chart2, {
                            type: "line",
                            data: data,
                            options: options
                        });

                        var body = document.body,
                            html = document.documentElement;


                        var height = Math.max(body.scrollHeight, body.offsetHeight,
                            html.clientHeight, html.scrollHeight, html.offsetHeight);
                        document.querySelector('.menu').style.height = height;


                    }, );

                break
            case 'Temp':

                fetch('./getTemp.php?idPlante=' + idPlante + '&date=' + date)
                    .then(response => response.json())
                    .then(data => {



                        console.log(data)
                        var date = [];
                        var humidity = [];




                        for (var i in data) {
                            date.push(data[i].Date);
                            humidity.push(data[i].Temperature);
                        }


                        var data = {
                            labels: date,
                            datasets: [{
                                label: "Temperature",
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
                                        min: 15
                                    },
                                }]
                            },
                            title: {
                                display: true,
                                position: "top",
                                text: "Temperature Graphe",
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
                        var chart = new Chart(chart4, {
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


                break

            default:
                fetch('./getLight.php?idPlante=' + idPlante + '&date=' + date)
                    .then(response => response.json())
                    .then(data => {




                        var date = [];
                        var humidity = [];




                        for (var i in data) {
                            date.push(data[i].Date);
                            humidity.push(data[i].IndiceChaleur);
                        }


                        var data = {
                            labels: date,
                            datasets: [{
                                label: "IndiceChaleur",
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
                                        min: 0
                                    },
                                }]
                            },
                            title: {
                                display: true,
                                position: "top",
                                text: "Light Graph",
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
                        var chart = new Chart(chart3, {
                            type: "line",
                            data: data,
                            options: options
                        });

                        var body = document.body,
                            html = document.documentElement;


                        var height = Math.max(body.scrollHeight, body.offsetHeight,
                            html.clientHeight, html.scrollHeight, html.offsetHeight);
                        document.querySelector('.menu').style.height = height;


                    }, );
                break;
        }


    })

    var textarea = document.getElementById("msg");
    var etq = document.getElementById("etq");
    var heightLimit = 200; /* Maximum height: 200px */

    textarea.oninput = () => {
        etq.style.display = "none";
        textarea.style.height = ""; /* Reset the height*/
        textarea.style.height = Math.min(textarea.scrollHeight, heightLimit) + "px";
        if (textarea.value == "") {
            etq.style.display = "block";
        }
    };
    var body = document.body,
        html = document.documentElement;


    var height = Math.max(body.scrollHeight, body.offsetHeight,
        html.clientHeight, html.scrollHeight, html.offsetHeight);
    document.querySelector('.menu').style.height = height;
    console.log(height);
    </script>
</body>
<?php

$id =$_SESSION['id'];

    if (!isset($_GET['idPlante'])) {
        echo("<script>location.href = './consulter.php';</script>");
        # code...
    }
    $idPlante = $_GET['idPlante'];
    if(isset($_GET['message'])){
        $lien = mysqli_connect('localhost','root','','pfe');
        $msg = $_GET['message'];
        
        $id =$_SESSION['id'];
        $now = new DateTime();
$timestring = $now->format('Y-m-d h:i:s');
        $sql = 'insert into observation (PlanteID , PersonneID ,Date ,Contenu	) values ("'.$idPlante.'" ,"'.$id.'", "'.$timestring.'","'.$msg.'") ';
        mysqli_query($lien,$sql)or die('erreur  ' . $sql . mysqli_error($lien));
       echo("<script>location.href = 'plante.php?idPlante='+idPlante;</script>");


    }

?>
<link rel="stylesheet" href="plante.css">
<style>
.chart {
    width: 800px;
}

.black_overlay {
    display: none;
    position: absolute;
    top: 0%;
    left: 0%;
    width: 100%;
    height: 110%;
    background-color: black;
    z-index: 1001;
    -moz-opacity: 0.8;
    opacity: .80;
    filter: alpha(opacity=80);
}

.white_content {
    display: none;
    position: absolute;
    top: 25%;
    left: 25%;
    width: 50%;
    height: 50%;
    padding: 16px;
    border: 16px solid orange;
    background-color: white;
    z-index: 1002;
    overflow: auto;
}

.buttonFixed {
    background: none repeat scroll 0 0 #0c8195;
    border: solid black 3px;
    border-radius: 50px;
    color: white;
    left: 88%;
    position: fixed;
    top: 500px;
    padding: 10px;
    width: 150px;
    margin-top: 30px;
    text-align: center;
    font-weight: bold;
    text-decoration: none;
}

/*
Basic input element using psuedo classes
*/

html {
    font-family: 'Lora', sans-serif;
    width: 100%;
}

body {
    padding: 0;
    margin: 0;
}

h1 {
    font-size: 28px;
    margin-bottom: 2.5%;
}

input,
span,
label,
textarea {
    font-family: 'Ubuntu', sans-serif;
    display: block;
    margin: 10px;
    padding: 5px;
    border: none;
    font-size: 22px;
}

textarea:focus {
    outline: 0;
}

/* Question */

textarea.question {
    font-size: 20px;
    font-weight: 300;
    border-radius: 2px;
    margin: 0;
    border: none;
    width: 80%;
    background: rgba(0, 0, 0, 0);
    transition: padding-top 0.2s ease, margin-top 0.2s ease;
    overflow-x: hidden;
    /* Hack to make "rows" attribute apply in Firefox. */
}

/* Underline and Placeholder */


textarea.question+label {
    display: block;
    position: relative;
    white-space: nowrap;
    padding: 0;
    margin: 0;
    width: 10%;
    border-top: 1px solid red;
    -webkit-transition: width 0.4s ease;
    transition: width 0.4s ease;
    height: 0px;
}

textarea.question:focus+label {
    width: 80%;
}



textarea.question:valid,
textarea.question:focus {
    margin-top: 35px;
}



textarea.question:focus+label>span,
textarea.question:valid+label>span {
    top: -94px;
    font-size: 22px;
    color: #333;
}


textarea.question:valid+label {
    border-color: green;
}


textarea.question:invalid {
    box-shadow: none;
}


textarea.question+label>span {
    font-weight: 300;
    margin: 0;
    position: absolute;
    color: #8F8F8F;
    font-size: 48px;
    top: -66px;
    left: 0px;
    z-index: -1;
    -webkit-transition: top 0.2s ease, font-size 0.2s ease, color 0.2s ease;
    transition: top 0.2s ease, font-size 0.2s ease, color 0.2s ease;
}

input[type="submit"] {
    -webkit-transition: opacity 0.2s ease, background 0.2s ease;
    transition: opacity 0.2s ease, background 0.2s ease;
    display: block;
    opacity: 0;
    margin: 10px 0 0 0;
    padding: 10px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background: #EEE;
}

input[type="submit"]:active {
    background: #999;
}

textarea.question:valid~input[type="submit"] {
    -webkit-animation: appear 1s forwards;
    animation: appear 1s forwards;
}

textarea.question:invalid~input[type="submit"] {
    display: none;
}

@-webkit-keyframes appear {
    100% {
        opacity: 1;
    }
}

@keyframes appear {
    100% {
        opacity: 1;
    }
}

.condition {
    width: 100%;
    justify-content: center;
    display: flex;
    gap: 20px;
    margin: 40px;

}


::-webkit-datetime-edit-fields-wrapper {
    background: #0b7486;
    padding: 10px;
    border-radius: 40px;
}

::-webkit-datetime-edit-text {
    color: white;

}

::-webkit-datetime-edit-month-field {
    color: white;
}

::-webkit-datetime-edit-day-field {
    color: white;
}

::-webkit-datetime-edit-year-field {
    color: white;
}

::-webkit-inner-spin-button {
    display: none;
}

input[type="date"] {
    display: -webkit-inline-flex;
    font-size: 19px;
    overflow: hidden;
    padding: 0;
    -webkit-padding-start: 1px;
    height: 50px;
    margin: 0;
    cursor: pointer;
}

.option {
    padding: 10px;
    width: 20%;
    margin: 0;
    text-align: center;
    background: #0b7486;
    border-radius: 20px;
    color: white;
    font-size: 15px;
    height: 50px;
    cursor: pointer;
}

label {
    padding: 10px;
    height: 50px;
    margin: 2px;
}

.consulter {
    padding: 10px;
    /* width: 20%; */
    background-color: #0b7486;
    color: white;
    border-radius: 20px;
    height: 50px;
    cursor: pointer;
}
</style>