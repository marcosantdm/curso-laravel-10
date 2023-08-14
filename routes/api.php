<?php

use App\Http\Controllers\Api\SupportController;
use Illuminate\Support\Facades\Route;

/**
 * Ao criar essa rota, automaticamente estaremos criando as outras para os métodos, reduzindo o número de linhas
 * Exemplo: Rota para store, show, delete e put
 */

Route::apiResource('/supports', SupportController::class);
