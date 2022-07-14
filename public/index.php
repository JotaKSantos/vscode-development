<?php

use Migrate\Models\Nfse\Prestador;
use Migrate\Models\Nfse\Rps;

require(__DIR__.'/../vendor/autoload.php');

$migrate = new Migrate\Client(
    'SUA_CHAVE_DE_API'
);

echo ini_get("memory_limit");

$rps = new Rps();
$rps->RPSNumero = 1;
$rps->RPSSerie = 0;

$prestador = new Prestador();
$prestador->CNPJ_prest = '05432831000156';
$prestador->xName = 'Soft Design Informática LTDA-ME';

$rps->prestador = $prestador;

$nfse = $migrate->nfse()->create($rps);

var_dump($nfse);