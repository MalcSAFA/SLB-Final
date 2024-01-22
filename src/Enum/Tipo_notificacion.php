<?php

namespace App\Enum;

enum Tipo_notificacion
{
    case LIKE;
    case SEGUIMIENTO;
    case MD;
    case RETWEET;
    case RESPUESTA;
    case MENCIONES;
    case CITAS;
}
