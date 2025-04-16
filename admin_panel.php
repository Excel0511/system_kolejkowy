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
    <title>Panel Administracyjny</title>
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
            color: white;
            font-family: Arial, Helvetica, sans-serif;
        }

        iframe {
            height: 50vh;
            width: 50vw;
        }

        .child {
            display: inline-block;
        }
    </style>
</head>
<body>
    <div id="titlebar">
        <a href = "panel_sterowania.php" id="back"><svg fill="white" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 1024 1024" height="10vh"><path d="M222.927 580.115l301.354 328.512c24.354 28.708 20.825 71.724-7.883 96.078s-71.724 20.825-96.078-7.883L19.576 559.963a67.846 67.846 0 01-13.784-20.022 68.03 68.03 0 01-5.977-29.488l.001-.063a68.343 68.343 0 017.265-29.134 68.28 68.28 0 011.384-2.6 67.59 67.59 0 0110.102-13.687L429.966 21.113c25.592-27.611 68.721-29.247 96.331-3.656s29.247 68.721 3.656 96.331L224.088 443.784h730.46c37.647 0 68.166 30.519 68.166 68.166s-30.519 68.166-68.166 68.166H222.927z"/></svg></a>
    <h1>Panel Administracyjny</h1>
    </div>

    <h2>Zmień hasło</h2>
    <form id="changePasswordForm">
        <label for="password">Nowe hasło:</label>
        <input type="password" id="password" name="password">
        <button type="submit">Zmień</button>
    </form>

    <h2>Zmień powody wizyt</h2>
    <textarea id="reasons" rows="10" cols="30"></textarea>
    <button onclick="updateReasons()">Zapisz powody</button>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch("get_reasons.php")
                .then(response => response.json())
                .then(data => {
                    const reasonsTextarea = document.getElementById("reasons");
                    // Wstawienie powodów wizyt w formacie listy oddzielonej nowymi liniami
                    reasonsTextarea.value = data.map(reason => reason.name).join("\n");
                })
                .catch(error => console.error("Błąd podczas pobierania powodów wizyt:", error));
        });
        document.getElementById("changePasswordForm").addEventListener("submit", function (e) {
            e.preventDefault();
            const password = document.getElementById("password").value;

            fetch("admin_change_password.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `password=${password}`
            }).then(response => response.text()).then(alert);
        });

        function updateReasons() {
            const reasons = document.getElementById("reasons").value.split("\n");

            fetch("admin_update_reasons.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `reasons=${JSON.stringify(reasons)}`
            }).then(response => response.text()).then(alert);
        }
    </script>
</body>
</html>
