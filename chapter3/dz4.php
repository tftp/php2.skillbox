<?php

interface Reader
{
    public function read(): array;
}

interface Writer
{
    public function write(array $data);
}

interface Converter
{
    public function convert($item);
}

class ArrayReader implements Reader
{
    public $array;

    public function __construct(array $array)
    {
        $this->array = $array;
    }
    public function read(): array
    {
        return $this->array;
    }
}

class FileReader implements Reader
{
    public $array;

    public function __construct(string $path)
    {
        $this->array = file($path);
    }
    public function read(): array
    {
        return $this->array;
    }
}

class StringWriter implements Writer
{
    public function write(array $data)
    {
        echo implode($data, '<br />');
    }
}

class FileWriter implements Writer
{
    public $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function write(array $data)
    {
        file_put_contents($this->path, $data);
    }
}

class CryptConvert implements Converter
{
    public function convert($item)
    {
        return crypt($item);
    }
}

class CryptTo64Convert implements Converter
{
    public function convert($item)
    {
        return base64_encode($item);
    }
}

class CryptFrom64Convert implements Converter
{
    public function convert($item)
    {
        return base64_decode($item);
    }
}

class Import
{
    public $reader;
    public $writer;
    public $converters = [];

    public function from(Reader $reader)
    {
        $this->reader = $reader;
        return $this;
    }

    public function to(Writer $writer)
    {
        $this->writer = $writer;
        return $this;
    }

    public function with(Converter $converter)
    {
        $this->converters[] = $converter;
        return $this;
    }

    public function execute()
    {
        $data = $this->reader->read();
        foreach ($data as $key => $value) {
            foreach ($this->converters as $converter) {
                $value = $converter->convert($value);
            }
            $data[$key] = $value;
        }
        $this->writer->write($data);
    }
}

$import = new Import();
// $import->from(new ArrayReader([1,2,3,4,5]))->to(new StringWriter())->with(new CryptTo64Convert())->execute();
// $import->from(new FileReader($_SERVER['DOCUMENT_ROOT'] . '/01.jpeg'))->to(new StringWriter())->with(new CryptTo64Convert())->execute();
// $import->from(new ArrayReader([1,2,3,4,5]))->to(new FileWriter('002.txt'))->with(new CryptTo64Convert())->execute();
// $import->from(new FileReader($_SERVER['DOCUMENT_ROOT'] . '/01.jpeg'))->to(new FileWriter('002.txt'))->with(new CryptTo64Convert())->execute();
