<?php
$success = false;
if (!empty($_POST)) {
    try {
            $user = new User();
            $success = $user->load($_POST['id']) && (new UserFormValidator())->validate($_POST) && $user->save($_POST);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
}

class UserFormValidator
{
    public function validate($data)
    {
        $name = strip_tags($data['name']);
        $age = (int) $data['age'];
        $email = strip_tags($data['email']);

        if (empty($name)) {
            throw new Exception('Имя не может быть пустым');
        }

        if (empty($age)) {
            throw new Exception('Возраст не может быть нулевым или пустым');
        }

        if ($age < 18) {
            throw new Exception('Возраст не может быть меньше 18');
        }

        if ( empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Неправильно задан email');
        }

        return true;
    }
}

class User
{
    private $id;

    public function load($id)
    {
        $result = in_array($id, [1, 2, 3, 4, 5]);

        if (!$result) {
            throw new Exception('Пользователь не найден');
        }

        $this->id = $id;
        return true;
    }

    public function save($data)
    {
        $result = rand(0,1);

        if (!$result) {
            throw new Exception('Сохранение не удалось');
        }

        return true;
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Форма с данными</title>
    </head>
    <body>
        <div class="success" style="color: green">
            <?php if ($success) {
                echo 'Данные успешно сохранены';
            } ?>
        </div>
        <div class="error" style="color: red">
            <?php if (isset($error)) : ?>
                <?=  $error;  ?>
            <?php endif?>
        </div>
        <div class="data-form">
            <form class="" action="" method="post">
                <label for="id">
                    ID:
                    <input type="number" min="1" name="id" value="<?= isset($_POST['id']) && $error ? (int) $_POST['id'] : '' ?>">
                </label><br/>
                <label for="name">
                    Введите имя:
                    <input type="text" name="name" value="<?= isset($_POST['name']) && $error ? strip_tags($_POST['name']) : '' ?>">
                </label><br/>
                <label for="age">
                    Введите возраст:
                    <input type="number" min="18" name="age" value="<?= isset($_POST['age']) && $error ? (int) $_POST['age'] : '' ?>">
                </label><br/>
                <label for="email">
                    Введите email:
                    <input type="email" name="email" value="<?= isset($_POST['email']) && $error ? strip_tags($_POST['email']) : '' ?>">
                </label><br/>
                <input type="submit" value="Отправить данные">
            </form>
        </div>
    </body>
</html>
