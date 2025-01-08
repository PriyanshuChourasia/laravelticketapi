<?php

namespace App\Services\Interfaces;


interface IItemGroupService
{
    public function getAll();
    public function getById(string $id);
    public function store();
    public function update();
    public function destroy();
}