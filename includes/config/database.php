<?php

function conectarDB(): mysqli
{
  $db = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']); //mysqli es la forma O.Objetos
  if (!$db) {
    echo "Error no se pudo conectar";
    exit;
  }
  $db->set_charset('utf8');
  return $db;
}
