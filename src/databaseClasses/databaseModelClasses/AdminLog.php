<?php
class AdminLog
{
    private $ID_ADMIN;
    private $Action;
    private $Fecha;
    private $ID_LOG;

    public function __construct(int $ID_ADMIN, string $Action, string $Fecha, ?int $ID_LOG = null)  
    {
        $this->ID_ADMIN = $ID_ADMIN;
        $this->Action = $Action;
        $this->Fecha = $Fecha;
        $this->ID_LOG = $ID_LOG;
    }
    public function getID_ADMIN(): string {
        return $this->ID_ADMIN;
    }
    public function getAction(): string {
        return $this->Action;
    }
    public function getFecha(): string {
        return $this->Fecha;
    }
    public function getID_LOG(): int {
        return $this->ID_LOG;
    }
}