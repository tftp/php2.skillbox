<?php

// Пользователь

class User
{
    public $fio;    // ФИО - обязательное поле
    public $email;  // email - обязательное поле
    public $sex;    // пол - необязательное поле
    public $age;    // возраст - необязательное поле
    public $phone;  // телефон - необязательное поле

    public function __construct(
        $fio,
        $email,
        $sex = null,
        $age = null,
        $phone = null
    ) {
        $this->fio = $fio;
        $this->email = $email;
        $this->sex = $sex;
        $this->age = $age;
        $this->phone = $phone;
    }

    private function notifyOnEmail($message)
    {
        $note = new Notification($this, 'email');
        return $note->send($message);
    }

    private function notifyOnPhone($message)
    {
        if ($this->phone) {
            $notification = new Notification($this, 'phone');
            return $notification->send($message);
        }
    }

    public function notify($message)
    {
        $result = '';
        $age = $this->age;
        if (empty($age) || $age < 18) {
            $message = $this->censor($message);
        }
        $result .= $this->notifyOnEmail($message);
        $result .= $this->notifyOnPhone($message);
        return $result;
    }

    private function censor($message)
    {
        $dictionary = ['редиск', 'сардельк'];
        $message = str_replace($dictionary, '***', $message);
        return $message;
    }
}

// Уведомление

class Notification
{
    private $receiver; // имя получателя
    private $via;      // канал уведомления
    private $to;       // адрес получателя (номер телефона или значение email)

    public function __construct(User $user, $via)
    {
        $this->via = $via;
        $this->receiver = $user->fio;
        $this->to = $this->via === 'phone' ? $user->phone : $user->email;
    }

    public function send(string $message)
    {
        return "Уведомление клиенту: $this->receiver на $this->via ($this->to): $message";
    }
}

$user1 = new User('User1', 'user1@localhost', 'male', 40, '316-11-22');
$user2 = new User('User2', 'user2@localhost', 'male', 16, '311-00-11');
$user3 = new User('User2', 'user2@localhost', 'male', 16);

var_dump($user1->notify('ты не человек, а плохая редиска'));
var_dump($user2->notify('съешь сардельку на обед'));
var_dump($user3->notify('я напишу только хорошие слова'));
