<?php


class AccessObject extends DataCollection2 {

    protected $id;
    protected $name;

    public function __construct(int $id, string $name) {

        $this->id = $id;
        $this->name = $name;
    }
}
