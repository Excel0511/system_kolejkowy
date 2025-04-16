<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel sterowania</title>
    <style>
        body {
            background-color: #5887FF;
            height: auto;
        }

        button {
            width: 20%;
            background-color: #1B264F;
            color: rgb(255, 255, 255);
            margin: .5%;
            padding: .5%;
            font-size: 4.5vh;
            border-radius: 20px;
            border-color: rgba(0, 0, 0, 0.24);
            border: solid;
            display: flex;
            display: inline-block;

        }

        button:hover {
            background-color: rgb(98, 0, 255); /* Drobne przyciemnienie */
        }

        button:active {
            transform: translateY(4px); /* Przycisk zapada się w dół */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.90); /* Cień */
            background-color: rgba(255, 255, 255, 0.2); /* Drobne przyciemnienie */
        }
        
        #titlebar {
            background-color: #715AFF;
            border-radius: 10px;
            border-color: white;
            border: solid;
            color: white;
            padding: 1%;
            display: flex;
        }

        h1 {
            margin-left: auto;
            margin-right: auto;
            font-size: 10vh;
            font-family: Arial, Helvetica, sans-serif;
        }

        #settings {
            background-color:rgb(220, 47, 255);
            border-radius: 10px;
            border-color: white;
            border: solid;
            color: white;
            padding: 1%;
            display: flex;
            height: 100%;
        }

        #settings:hover {
            background-color: rgb(250, 111, 255); /* Drobne przyciemnienie */
        }

        #settings:active {
            background-color: rgb(174, 0, 255); /* Drobne przyciemnienie */
        }

        #back {
            background-color:rgb(54, 54, 54);
            border-radius: 10px;
            border-color: white;
            border: solid;
            color: white;
            padding: 1%;
            display: flex;
            height: 100%;
        }

        #back:hover {
            background-color: rgb(77, 77, 77); /* Drobne przyciemnienie */
        }

        #back:active {
            background-color: rgb(39, 39, 39); /* Drobne przyciemnienie */
        }

        h2 {
            font-size: 50px;
            font-family: Arial, Helvetica, sans-serif;
        }

        iframe {
            height: 50vh;
            width: 50vw;
        }

        .child {
            display: inline-block;
        }

        #queue {
            color: white;
            font-size: 5vh;
        } 
    </style>
</head>
<header>
    <div id="titlebar">
        <a href = "logout.php" id="back"><svg fill="white" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 384.971 384.971" height="10vh"><path d="M180.455,360.91H24.061V24.061h156.394c6.641,0,12.03-5.39,12.03-12.03s-5.39-12.03-12.03-12.03H12.03
			C5.39,0.001,0,5.39,0,12.031V372.94c0,6.641,5.39,12.03,12.03,12.03h168.424c6.641,0,12.03-5.39,12.03-12.03
			C192.485,366.299,187.095,360.91,180.455,360.91z"/>
		<path d="M381.481,184.088l-83.009-84.2c-4.704-4.752-12.319-4.74-17.011,0c-4.704,4.74-4.704,12.439,0,17.179l62.558,63.46H96.279
			c-6.641,0-12.03,5.438-12.03,12.151c0,6.713,5.39,12.151,12.03,12.151h247.74l-62.558,63.46c-4.704,4.752-4.704,12.439,0,17.179
			c4.704,4.752,12.319,4.752,17.011,0l82.997-84.2C386.113,196.588,386.161,188.756,381.481,184.088z"/></svg></a>
        <h1>Panel sterowania</h1>
        <a href="admin_panel.php" id="settings"><svg fill="white" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 16 16" height="10vh"><path d="M 6.570313 1 L 6.328125 2.289063 C 5.398438 2.5625 4.570313 3.046875 3.890625 3.695313 L 2.652344 3.261719 L 1.222656 5.738281 L 2.210938 6.585938 C 2.097656 7.042969 2 7.507813 2 8 C 2 8.492188 2.097656 8.957031 2.210938 9.414063 L 1.222656 10.261719 L 2.652344 12.738281 L 3.886719 12.300781 C 4.570313 12.957031 5.398438 13.4375 6.328125 13.714844 L 6.570313 15 L 9.429688 15 L 9.671875 13.714844 C 10.601563 13.4375 11.429688 12.953125 12.109375 12.300781 L 13.34375 12.738281 L 14.777344 10.261719 L 13.785156 9.414063 C 13.898438 8.957031 14 8.492188 14 8 C 14 7.507813 13.902344 7.042969 13.789063 6.585938 L 14.777344 5.738281 L 13.347656 3.261719 L 12.113281 3.695313 C 11.429688 3.042969 10.601563 2.5625 9.671875 2.289063 L 9.429688 1 Z M 7.398438 2 L 8.601563 2 L 8.796875 3.054688 L 9.117188 3.132813 C 10.109375 3.359375 10.984375 3.878906 11.65625 4.597656 L 11.878906 4.835938 L 12.894531 4.480469 L 13.496094 5.519531 L 12.683594 6.21875 L 12.78125 6.53125 C 12.921875 6.992188 13 7.488281 13 8 C 13 8.511719 12.921875 9.003906 12.78125 9.46875 L 12.683594 9.78125 L 13.496094 10.480469 L 12.894531 11.519531 L 11.878906 11.160156 L 11.65625 11.402344 C 10.984375 12.121094 10.109375 12.640625 9.117188 12.871094 L 8.796875 12.941406 L 8.601563 14 L 7.398438 14 L 7.203125 12.941406 L 6.882813 12.871094 C 5.890625 12.640625 5.015625 12.121094 4.34375 11.402344 L 4.117188 11.160156 L 3.101563 11.519531 L 2.503906 10.480469 L 3.316406 9.78125 L 3.21875 9.46875 C 3.078125 9.007813 3 8.511719 3 8 C 3 7.488281 3.078125 6.992188 3.21875 6.53125 L 3.316406 6.21875 L 2.503906 5.519531 L 3.101563 4.480469 L 4.121094 4.835938 L 4.34375 4.597656 C 5.015625 3.878906 5.890625 3.359375 6.882813 3.132813 L 7.203125 3.054688 Z M 8 5 C 6.347656 5 5 6.347656 5 8 C 5 9.652344 6.347656 11 8 11 C 9.652344 11 11 9.652344 11 8 C 11 6.347656 9.652344 5 8 5 Z M 8 6 C 9.109375 6 10 6.890625 10 8 C 10 9.109375 9.109375 10 8 10 C 6.890625 10 6 9.109375 6 8 C 6 6.890625 6.890625 6 8 6 Z"/></svg></a>
    </div>

    <button onclick="control('next')">Następna osoba</button>
    <button onclick="control('stop')">Koniec/Przerwa</button>
</header>
<body>
    <div id="main" class="child">
            <iframe src="number_display.html"></iframe>       
    </div>

    <div id="queue" class="child"></div>

    <script>
        function fetchQueue() {
            fetch("get_queue.php")
                .then(response => response.json())
                .then(data => {
                    const queueDiv = document.getElementById("queue");
                    queueDiv.innerHTML = "";
                    data.forEach(item => {
                        const div = document.createElement("div");
                        div.id = `${item.id}`;
                        div.onclick = () => control(item.id)
                        div.textContent = `${item.id} ${item.name}`;
                        queueDiv.appendChild(div);
                    });
                });
        }

        function control(action) {
            fetch("update_status.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `action=${action}`
            }).then(fetchQueue);
        }

        fetchQueue();
        setInterval(fetchQueue, 5000);
    </script>
</body>
</html>
