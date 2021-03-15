<?php

// Obserever - Наблюдатель - реализует зависимость один ко многим так что все зависящие от него объекты оповещаются об этом
// и автоматически обновляются

interface Observer
{
    public function update($subject);
}

abstract class Subject
{
    protected $observers;

    public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }

    public function attach(Observer $observer)
    {
        $this->observers->attach($observer)
    }

    public function detach(Observer $observer)
    {
        $this->observers->detach($observer)
    }

    protected function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}

class User extends Subject
{
    private $email;

    public function getEmail()
    {
        return $this->email;
    }

    public function changeEmail($email)
    {
        $this->email = $email;
        $this->notify();
    }
}

class UserEmailObserver implements Observer
{
    public function update($subject)
    {
        echo 'Обновлены данные посылаем уведомление на ' . $subject->getEmail() . PHP_EOL;
    }
}

//создаем пользователя
$user = new User();

// прикрепляем к нему наблюдателя
$user->attach(new UserEmailObserver());

// изменяем емаил адрес
$user->changeEmail('new_email@gmail.com');
