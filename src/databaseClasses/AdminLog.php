<?php
class AdminLog
{
    private string $ID_ADMIN;
    private string $Action;
    private string $Fecha;
    private int $ID_LOG;

    public function __construct(int $ID_ADMIN, string $Action, string $Fecha, int|null $ID_LOG)  
    {
        $this->$ID_ADMIN = $ID_ADMIN;
        $this->$Action = $Action;
        $this->$Fecha = $Fecha;
        $this->$ID_LOG = $ID_LOG;
    }
    public function getID_ADMIN() {
        return $this->ID_ADMIN;
    }
    public function getAction() {
        return $this->Action;
    }
    public function getFecha() {
        return $this->Fecha;
    }
    public function getID_LOG() {
        return $this->ID_LOG;
    }
}