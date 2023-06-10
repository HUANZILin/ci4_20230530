<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timer</title>
    <style>
        * {
            padding: 0px;
            margin: 0px;
        }

        html,
        body {
            box-sizing: border-box;
            text-align: center;
        }

        .title {
            margin: 20px auto;
        }

        label {
            font-size: 18px;
            font-weight: bold;
            margin-right: 10px;
        }

        input {
            padding: 2px 6px;
        }

        button {
            padding: 5px 10px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            color: white;
            background-color: #0C4842;
            cursor: pointer;
            letter-spacing: 2px;
            font-size: 18px;
            text-align: center;
        }

        #stop {
            background-color: #2B5F75;
        }

        #resume {
            background-color: #ED784A;
            display: none;
        }

        #cancel {
            background-color: #B5495B;
        }

        .showTime {
            display: flex;
            flex-direction: column;
        }

        .time {
            display: flex;
            justify-content: center;
            margin: 20px;
            font-size: 48px;
        }
    </style>
</head>

<body>
    <h1 class="title">計時器</h1>
    <form action="" id="timeForm">
        <input type="number" name="hour" max="23" min="0" placeholder="00">
        <label for="hour">時</label>
        <input type="number" name="minute" max="59" min="0" placeholder="00">
        <label for="minute">分</label>
        <input type="number" name="second" max="59" min="0" placeholder="00">
        <label for="second">秒</label>
        <button type="submit" style="margin-left: 10px;">開始</button>
    </form>

    <div class="showTime">
        <div class="time">
            <h1 id="hour">00:</h1>
            <h1 id="minute">00:</h1>
            <h1 id="second">00</h1>
        </div>

        <div>
            <button id="stop">暫停</button>
            <button id="resume">繼續</button>
            <button id="cancel">取消</button>
        </div>
    </div>

    <script>
        let tForm = document.getElementById("timeForm");
        tForm.addEventListener("submit", (e) => {
            e.preventDefault();
            let formData = new FormData(tForm);
            let time = Object.fromEntries(formData);
            let hour, minute, second;
            if (time.hour == "") {
                hour = 0;
            } else {
                hour = parseInt(time.hour);
            }
            if (time.minute == "") {
                minute = 0;
            } else {
                minute = parseInt(time.minute);
            }
            if (time.second == "") {
                second = 0;
            } else {
                second = parseInt(time.second);
            }
            setHour(time.hour);
            setMinute(time.minute);
            setSecond(time.second);
            startTimer(hour, minute, second);
        });

        let seconds, countdownTime;
        const startTimer = (hour, minute, second) => {
            seconds = hour * 3600 + minute * 60 + second;
            countdownTime = setInterval(getRemainingTime, 1000);
        }

        const getRemainingTime = () => {
            let hours = Math.floor(seconds / 3600);
            let minutes = Math.floor((seconds % 3600) / 60);
            let second = (seconds % 3600) % 60;
            setHour(hours);
            setMinute(minutes);
            setSecond(second);
            if (seconds == 0) {
                clearInterval(countdownTime);
            }
            seconds -= 1;
        }

        const setHour = (h) => {
            if (h == "") {
                document.getElementById("hour").innerHTML = "00:";
            } else if (parseInt(h) / 10 < 1) {
                document.getElementById("hour").innerHTML = "0" + h + ":";
            } else {
                document.getElementById("hour").innerHTML = h + ":";
            }
        }

        const setMinute = (m) => {
            if (m == "") {
                document.getElementById("minute").innerHTML = "00:";
            } else if (parseInt(m) / 10 < 1) {
                document.getElementById("minute").innerHTML = "0" + m + ":";
            } else {
                document.getElementById("minute").innerHTML = m + ":";
            }
        }
        const setSecond = (s) => {
            if (s == "") {
                document.getElementById("second").innerHTML = "00";
            } else if (parseInt(s) / 10 < 1) {
                document.getElementById("second").innerHTML = "0" + s;
            } else {
                document.getElementById("second").innerHTML = s;
            }
        }

        let sButton = document.getElementById("stop");
        let rButton = document.getElementById("resume");
        sButton.addEventListener("click", () => {
            clearInterval(countdownTime);
            sButton.style.display = "none";
            rButton.style.display = "inline-block";
        });
        rButton.addEventListener("click", () => {
            sButton.style.display = "inline-block";
            rButton.style.display = "none";
            countdownTime = setInterval(getRemainingTime, 1000);
        });

        let cButton = document.getElementById("cancel");
        cButton.addEventListener("click", () => {
            clearInterval(countdownTime);
            document.getElementById("hour").innerHTML = "00:";
            document.getElementById("minute").innerHTML = "00:";
            document.getElementById("second").innerHTML = "00";
        });
    </script>
</body>

</html>