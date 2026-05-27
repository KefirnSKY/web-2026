<?php

function isDigit(int $digit): string {
    switch ($digit) {
        case 0:
            return "Ноль";
        case 1:
            return "Один";
        case 2:
            return "Два";
        case 3:
            return "Три";
        case 4:
            return "Четыре";
        case 5:
            return "Пять";
        case 6:
            return "Шесть";
        case 7:
            return "Семь";
        case 8:
            return "Восемь";
        case 9:
            return "Девять";
        default:
            return "Это не цифра";
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

$digitString = getPostParameter('digit');

if ($digitString !== null) {

    $digit = (int)$digitString;

    if ($digit < 0 || $digit > 9) {
        $error = 'Введите цифру от 0 до 9';
    } else {
        $result = isDigit($digit);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>task2</title>

    <style>
        .error {
            color: red;
        }
        input[type=number] {
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
    <label for="digit">Введите цифру:</label>
    <input
        type="number"
        name="digit"
        id="digit"
        min="0"
        max="9"
        required
    >
    <button type="submit">Перевести</button>
</form>
<?php if ($error !== null): ?>
    <p class="error">
        Ошибка: <?php echo $error; ?>
    </p>
<?php elseif ($result !== null): ?>
    <p>
        Результат: <?php echo $result; ?>
    </p>
<?php endif; ?>
</body>
</html>
