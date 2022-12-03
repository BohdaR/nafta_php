<?php

abstract class Operation
{
    protected array $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function set_data($data): void
    {
        $this->data = $data;
    }

    public function get_data($data): array
    {
        return $this->data;
    }

    abstract public function get_result(): float;
}

class Sum extends Operation
{
    private float $result = 0;

    public function get_result(): float
    {
        foreach ($this->data as $row){
            foreach ($row as $item)
            {
                $this->result += $item;
            }
        }
        return $this->result;
    }
}

class Average extends Sum
{
    private function calculate_matrix_length(): int
    {
        return count($this->data) * count($this->data[0]);
    }

    public function get_result(): float
    {
        return parent::get_result() / $this->calculate_matrix_length();
    }
}

class Multiplication extends Operation
{
    private float $result = 1;

    public function get_result(): float
    {
        foreach ($this->data as $row){
            foreach ($row as $item)
            {
                $this->result *= $item;
            }
        }
        if ($this->result == 1)
        {
            return 0;
        }

        return $this->result;
    }
}
