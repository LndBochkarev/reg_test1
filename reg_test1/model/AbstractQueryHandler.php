<?php

abstract class AbstractQueryHandler {

    protected $db;
    protected $registry;

    public function __construct($registry, $db) {
        $this->registry = $registry;
        $this->db = $db;
    }
}
