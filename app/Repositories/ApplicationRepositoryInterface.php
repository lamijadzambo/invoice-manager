<?php

namespace App\Repositories;

interface ApplicationRepositoryInterface
{
    public function allByIdDesc();

    public function allByIdAsc();

    public function findById($id);

    public function updateName($id);
}
