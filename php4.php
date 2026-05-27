<?php

function isLuckyTicket(string $ticket): bool {

    $sum1 =
        (int)$ticket[0] +
        (int)$ticket[1] +
        (int)$ticket[2];

    $sum2 =
        (int)$ticket[3] +
        (int)$ticket[4] +
        (int)$ticket[5];

    return $sum1 === $sum2;
}

function getPostParameter(string $key): ?string {

    if (isset($_POST[$key])) {
        return $_POST[$key];
    } else {
        return null;
    }
}

$result = [];
$error = null;

$start = getPostParameter('start');
$end = getPostParameter('end');

if ($start !== null && $end !== null) {

    if (
        strlen($start) !== 6 ||
        strlen($end) !== 6 ||
        !is_numeric($start) ||
        !is_numeric($end)
    ) {
        $error = "Введите два шестизначных числа";
    } else {
        for ($i = (int)$start; $i <= (int)$end; $i++) {
            $ticket = str_pad((string)$i, 6, '0', STR_PAD_LEFT);
            if (isLuckyTicket($ticket)) {
                $result[] = $ticket;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Счастливые билеты</title>
    <style>

        .error {
            color: red;
        }

        input {
            padding: 5px;
            margin: 5px 0;
        }

        button {
            padding: 5px 15px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<form method="post">
    <label for="start">
        Начальный билет:
    </label>
    <input
        type="text"
        name="start"
        id="start"
        maxlength="6"
        required
    >
    <br>
    <label for="end">
        Конечный билет:
    </label>
    <input
        type="text"
        name="end"
        id="end"
        maxlength="6"
        required
    >
    <br>
    <button type="submit">
        Найти
    </button>
</form>
<?php if ($error !== null): ?>
    <p class="error">
        <?php echo $error; ?>
    </p>
<?php endif; ?>
<?php if (!empty($result)): ?>
    <h3>Счастливые билеты:</h3>
    <?php foreach ($result as $ticket): ?>
        <p><?php echo $ticket; ?></p>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>