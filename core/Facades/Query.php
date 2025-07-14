<?php

    namespace Devyuha\Lunaris\Facades;

    abstract class Query {
        protected $args;
        protected array $data = [];
        protected ?int $lastInsertId = null;
        protected int $affectedRows = 0;

        public function __construct($args = [])
        {
            $this->args = $args;
        }

        public function getArgs() {
            return $this->args;
        }

        abstract public function sql();

        public function setData(array $data) {
            $this->data = $data;
        }

        public function getData() {
            return $this->data ?? [];
        }

        public function first() {
            return $this->data[0] ?? [];
        }

        public function setId(?int $id) {
            $this->lastInsertId = $id;
        }

        public function getId() {
            return $this->lastInsertId;
        }

        public function setAffectedRows(int $rows) {
            $this->affectedRows = $rows;
        }

        public function getAffectedRows() {
            return $this->affectedRows;
        }

        public function count() {
            return count($this->data);
        }
    }
