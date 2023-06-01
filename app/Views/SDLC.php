<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDLC</title>
</head>

<body>
    <h1><?= esc($heading) ?></h1>
    <table>
        <tr>
            <th>Time Used</th>
            <th>Step</th>
            <th>Description</th>
        </tr>
        <?php foreach ($todo_list as $todo => $todo_num) : ?>
            <tr>
                <td><?= esc($todo) ?></td>
                <? foreach ($todo_num as $todo_item) : ?>
                    <td><?= esc($todo_item) ?></td>
                <? endforeach ?>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>