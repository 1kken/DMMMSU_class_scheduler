<?php
    function is_schedule_code_taken(object $pdo, string $code): bool {
        $stmt = $pdo->prepare("SELECT * FROM schedule WHERE code = :code");
        $stmt->execute(['code' => $code]);
        return $stmt->rowCount() > 0;
    }