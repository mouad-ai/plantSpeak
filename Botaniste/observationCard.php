<style>
.container {
    width: 45%;
    min-height: 30vh;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;

}

.center {
    align-items: center;
    justify-content: center;
}

.card {
    border: #282828 solid 2px;
    background-color: white;
    width: 80%;
    display: flex;
    flex-direction: column;
    padding: 10px;
    margin: 2px;
    box-shadow: -10px -10px 0px 0px #74c2cf;
    border-radius: 10px;
    -webkit-animation-name: shadow-show;
    /* Safari 4.0 - 8.0 */
    -webkit-animation-duration: 1.5s;
    /* Safari 4.0 - 8.0 */
    animation-name: shadow-show;
    animation-duration: 1.5s;
    transition-timing-function: cubic-bezier(0.795, 0, 0.165, 1);
    /* custom */
}


.card h2 {
    margin: 0px;
    padding: 0px 0px 0px 0px;
    font-family: "Noto Sans KR", sans-serif;
    font-size: 20px;
    color: #282828;
}

.card hr {
    display: block;
    border: none;
    height: 3px;
    background-color: #0b7486;
    margin: 0px;
    -webkit-animation-name: line-show;
    /* Safari 4.0 - 8.0 */
    -webkit-animation-duration: 0.3s;
    /* Safari 4.0 - 8.0 */
    animation-name: line-show;
    animation-duration: 0.3s;
    transition-timing-function: cubic-bezier(0.795, 0, 0.165, 1);
    /* custom */
}

.card p {
    margin: 15px 0px 0px 0px;
    font-family: "Noto Sans KR", sans-serif;
    font-weight: 100;
    letter-spacing: -0.25px;
    line-height: 1.25;
    font-size: 16px;
    word-break: break-all;
    word-wrap: pre-wrap;
    color: #282828;
    -webkit-animation-name: p-show;
    /* Safari 4.0 - 8.0 */
    -webkit-animation-duration: 1.5s;
    /* Safari 4.0 - 8.0 */
    animation-name: p-show;
    animation-duration: 1.5s;
}

.card span {
    border: none;
    background-color: #0b7486;
    width: 50%;
    margin: 10px auto;
    padding: 10px 30px;
    color: white;
    border-radius: 10px;
    font-family: "Noto Sans KR", sans-serif;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
}




@keyframes line-show {
    from {
        margin: 0px 100px;
    }

    to {
        margin: 0px;
    }
}




@keyframes p-show {
    from {
        color: white;
    }

    to {
        color: black;
    }
}


@keyframes shadow-show {
    from {
        box-shadow: 0px 0px 0px 0px #e0e0e0;
    }

    to {
        box-shadow: -10px -10px 0px 0px #74c2cf;
    }
}
</style>
<?php
    function observationCard($title, $desc,$date){
        echo '<div class="container center">
  <div class="card">
    <h2>'.$title.'</h2>
    <hr/>
    <p>'.$desc.'</p>


    <div></div>
    <span>Cree en '.$date.'</span>
  </div>
</div>';
    }

?>