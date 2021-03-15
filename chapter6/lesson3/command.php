<?php
// Поведенческие шаблоны описывают варианты реализации того, как объекты взаимодействуют друг с другом.
// описывают  взаимодействие одних объектов с другими без жестких связей между ними

// Command - Команда - позволяет превращать запросы в объекты  и передавать их в качестве параметров.

interface CommandInterface
{
    public function execute();
}

// Отправитель
class Invoker
{
    // ссылка на экземпляр класса CommandInterface
    private $command;

    public function setCommand(CommandInterface $cmd)
    {
        $this->command = $cmd;
    }

    public function run()
    {
        $this->command->execute();
    }
}

// Получатель
class Receiver
{
    private $enableDate = false;
    private $output = [];

    public function write(string $str)
    {
        if ($this->enableDate) {
            $str .= '[' . date('Y-m-d H:i:s') . ']';
        }

        $this->output[] = $str;
    }

    public function getOutput()
    {
        return join('\n', $this->output);
    }

    public function enableDate()
    {
        $this->enableDate = true;
    }

    public function disableDate()
    {
        $this->enableDate = false;
    }
}

// сами комманды
class HelloCommand implements CommandInterface
{
    private $output; // здесь хранится Receiver

    public function __construct(Receiver $console)
    {
        $this->output = $console;
    }

    public function execute()
    {
        $this->output->write('Hello Word');
    }
}

class AddMessageDateCommand implements CommandInterface
{
    private $output;

    public function __construct(Receiver $console)
    {
        $this->output = $console;
    }

    public function execute()
    {
        $this->output->enableDate();
    }

    public function undo()
    {
        $this->output->disableDate();
    }
}

echo '<pre>';
$invoker = new Invoker();
$receiver = new Receiver();

$invoker->setCommand(new HelloCommand($receiver));
$invoker->run();

echo $receiver->getOutput() . PHP_EOL;
echo '###############' . PHP_EOL;

$messageDateCommand = new AddMessageDateCommand($receiver);
$messageDateCommand->execute();
$invoker->run();

echo $receiver->getOutput() . PHP_EOL;

echo '</pre>';
