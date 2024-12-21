<?php

namespace App\Models;

abstract class Model {
    abstract protected function mapToEntity(array $data);
}