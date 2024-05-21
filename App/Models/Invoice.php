<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;

class Invoice extends Model
{

    public function create(float $amount, int $userId): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO invoices (amount, user_id)
            VALUES(?, ?)'
        );

        $stmt->execute([$amount, $userId]);

        return (int)$this->db->lastInsertId();
    }
}