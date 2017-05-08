<?php
declare(strict_types=1);

namespace SONFin\Repository;


interface RepositoryInterface
{
    public function all() : array ;
    public function find(int $id, bool $failIfNotExist);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function fundByField(string $field, $value) : array;
}