<?php
namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{
    public function list();
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function show(int $id);
}
