<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: login.html");
    die();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO | Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/dashboard.css">
</head>
<body>
    
    <div class="container">
        <h1>I tuoi impegni</h1>
        
        <form action="../PHP/insert_task.php" method="POST">
            <div class="input-group">
                <label for="descrizione">NOME ATTIVITÀ</label>
                <input 
                    id="descrizione"
                    name="descrizione"
                    type="text"
                    maxlength="150"
                    placeholder="Es. Comprare il pane..."
                    required
                >
            </div>
            <button type="submit">Invia</button>
        </form>

        <table id="tabella">
            <tr>
                <th>Nome</th>
                <th>Fatto</th>
            </tr>
        </table>
        <br>
        <button type="submit" onclick="eliminaTasks()">Salva</button>
    </div>

    <script>
        async function getData() {
            try {
                const response = await fetch("../PHP/retrieve.php", {
                    method: "GET",
                    headers: {
                        "Content-Type":"application/json"
                    }
                });

                if(!response.ok) throw new Error("Errore nel recupero delle attività.");

                const result = await response.json();
                
                view(result);

            } catch (error) {
                alert(error.message);
            }   
        }

        function view(tasks) {
            const tabella = document.getElementById("tabella");
            tasks.forEach((task) => {

                const isChecked = task.completato == 1? "checked" : "";
                tabella.innerHTML += `
                <tr>
                    <td> ${task.descrizione} </td>
                    <td> <input data-id="${task.id}" type="checkbox" ${isChecked} class="done-checkbox"> </td>
                </tr>
                `;
            });
        }

        function tasksModificati() {
            let to_remove = [];

            const checkboxes = document.querySelectorAll(".done-checkbox");
            checkboxes.forEach((checkbox) => {
                if(checkbox.checked){
                    to_remove.push(checkbox.dataset.id);
                }
            });
            return to_remove;
        }

        async function eliminaTasks() {
            const to_remove = tasksModificati();

            const response = await fetch("../PHP/remove_tasks.php", {
                method: "POST",
                headers:{
                    "Content-Type":"application/json"
                },
                body: JSON.stringify(to_remove)
            });
            window.location.reload();
        }
        
        document.addEventListener("DOMContentLoaded", getData);

    </script>
</body>
</html>