<html>

<head>
    <meta charset="UTF-8">
    <title>Todo List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            padding: 0px;
            margin: 0px;
        }

        html,
        body {
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }

        h1 {
            display: flex;
            margin: 20px auto;
        }

        form {
            margin: 0px auto 10px auto;
        }

        label {
            font-size: 16px;
            font-weight: bold;
        }

        input {
            padding: 3px;
            margin: 0px 5px;
        }

        table {
            margin: auto;
            table-layout: fixed;
            border: solid 1px black;
            border-collapse: collapse;
        }

        table thead th,
        table tbody td {
            padding: 10px;
            border: solid 1px black;
            margin: auto;
            text-align: center;
        }

        button {
            padding: 3px 5px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            letter-spacing: 2px;
        }

        .create {
            background-color: #0C4842;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
    <script type=text/javascript>
        let todoComponent = {
            index: function() {
                axios.get('http://localhost:8080/todo')
                    .then((response) => {
                        renderPage(response.data.data);
                    }).catch((error) => console.log(error))
            },
            show: function(key) {
                axios.get('http://localhost:8080/todo/' + key)
                    .then((response) => console.log(response))
                    .catch((error) => console.log(error))
            },
            create: function(data) {
                axios.post('http://localhost:8080/todo', data)
                    .then((response) => console.log(response))
                    .catch((error) => console.log(error))
            },
            update: function(key, data) {
                axios.put('http://localhost:8080/todo/' + key, data)
                    .then((response) => console.log(response))
                    .catch((error) => console.log(error))
            },
            delete: function(key) {
                axios.delete('http://localhost:8080/todo/' + key)
                    .then((response) => console.log(response))
                    .catch((error) => console.log(error))
            }
        }

        const renderPage = (data) => {
            for (let i = 0; i < data.length; i++) {
                const tr = document.createElement("tr");
                const id = document.createElement("td");
                const title = document.createElement("td");
                const content = document.createElement("td");
                const edit = document.createElement("td");
                const cButton = document.createElement("button");
                const uButton = document.createElement("button");
                const dButton = document.createElement("button");
                id.innerHTML = data[i].t_key;
                title.innerHTML = data[i].t_title;
                content.innerHTML = data[i].t_content;
                uButton.innerHTML = "update";
                uButton.className = "update";
                dButton.innerHTML = "delete";
                dButton.className = "delete";
                uButton.id = dButton.id = data[i].t_key;
                uButton.style.backgroundColor = "#ED784A";
                dButton.style.backgroundColor = "#B5495B";
                tr.appendChild(id);
                tr.appendChild(title);
                tr.appendChild(content);
                edit.appendChild(uButton);
                edit.appendChild(dButton);
                tr.appendChild(edit);

                document.getElementById("tBody").appendChild(tr);
            }
            let uButtons = document.getElementsByClassName("update");
            for (let i = 0; i < uButtons.length; i++) {
                uButtons[i].addEventListener("click", (e) => {
                    let title = prompt("Please enter the step:");
                    if (title == null || title == "") {
                        alert("Title can't be null!");
                    } else {
                        let content = prompt("Please enter the content:");
                        if (content == null || content == "") {
                            alert("Content can't be null!");
                        } else {
                            let data = {
                                "title": title,
                                "content": content
                            };
                            todoComponent.update(uButtons[i].id, data);
                            alert("Updated Successfully!");
                            location.reload();
                        }
                    }
                });
            }

            let dButtons = document.getElementsByClassName("delete");
            for (let i = 0; i < dButtons.length; i++) {
                dButtons[i].addEventListener("click", (e) => {
                    todoComponent.delete(dButtons[i].id);
                    alert("Deleted Successfully!");
                    location.reload();
                });
            }
        }

        todoComponent.index();
    </script>
</head>

<body>
    <h1>Todo List</h1>
    <form action="" id="createForm">
        <label for="title">Step: </label>
        <input type="text" name="title">
        <label for="content">Description: </label>
        <input type="text" name="content">
        <button type="submit" class="create">create</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Time Used</th>
                <th>Step</th>
                <th>Description</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody id="tBody">
        </tbody>
    </table>

    <script>
        let cForm = document.getElementById("createForm");
        cForm.addEventListener("submit", (e) => {
            e.preventDefault();
            let formData = new FormData(cForm);
            todoComponent.create(JSON.stringify(Object.fromEntries(formData)));
            alert("Created Successfully!");
            location.reload();
        });
    </script>
</body>

</html>