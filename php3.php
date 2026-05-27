<?php
function getZodiacSign(int $day, int $month): string {
    switch ($month) {
        case 1:
            return ($day <= 19) ? "Козерог" : "Водолей";
        case 2:
            return ($day <= 18) ? "Водолей" : "Рыбы";
        case 3:
            return ($day <= 20) ? "Рыбы" : "Овен";
        case 4:
            return ($day <= 19) ? "Овен" : "Телец";
        case 5:
            return ($day <= 20) ? "Телец" : "Близнецы";
        case 6:
            return ($day <= 20) ? "Близнецы" : "Рак";
        case 7:
            return ($day <= 22) ? "Рак" : "Лев";
        case 8:
            return ($day <= 22) ? "Лев" : "Дева";
        case 9:
            return ($day <= 22) ? "Дева" : "Весы";
        case 10:
            return ($day <= 22) ? "Весы" : "Скорпион";
        case 11:
            return ($day <= 21) ? "Скорпион" : "Стрелец";
        case 12:
            return ($day <= 21) ? "Стрелец" : "Козерог";
        default:
            return "Неверная дата";
    }
}

function getPostParameter(string $key): ?string {
    if (isset($_POST[$key])) {
        return $_POST[$key];
    } else {
        return null;
    }
}

$result = null;
$error = null;

$dateString = getPostParameter('date');

if ($dateString !== null) {
    $dateParts = explode('.', $dateString);
    if (count($dateParts) === 3) {
        $day = (int)$dateParts[0];
        $month = (int)$dateParts[1];
        $year = (int)$dateParts[2];
        if (checkdate($month, $day, $year)) {
            $result = getZodiacSign($day, $month);
        } else {
            $error = "Неверная дата";
        }
    } else {
        $error = "Введите дату в формате ДД.ММ.ГГГГ";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>task3</title>
    <style>
        .error {
            color: red;
        }
        input[type=text] {
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
    <label for="date">
        Введите дату:
    </label>
    <input
        type="text"
        name="date"
        id="date"
        placeholder="ДД.ММ.ГГГГ"
        required
    >
    <button type="submit">
        Проверить
    </button>
</form>
<?php if ($error !== null): ?>
    <p class="error">
        Ошибка: <?php echo $error; ?>
    </p>
<?php elseif ($result !== null): ?>
    <p>
        Знак зодиака: <?php echo $result; ?>
    </p>
<?php endif; ?>
</body>
</html>
