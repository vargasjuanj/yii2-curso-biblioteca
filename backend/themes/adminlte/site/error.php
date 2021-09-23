<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="error-page">
    <div class="error-content" style="margin-left: auto;">
        <h3><i class="fas fa-exclamation-triangle text-danger"></i> Atencion</h3>
        <?php
        $exception = Yii::$app->getErrorHandler()->exception;
        $errorCode = $exception->statusCode;

        echo "<h1> Error : " . $errorCode . " - " . nl2br(Html::encode($message))  . "</h1>";

        if ($errorCode == 404) {
            echo "<p> Lo sentimos creo que la página que busca ha cambiado o ya no existe</p>";
        } else if ($errorCode == 403) {
            echo "<p> Lo sentimos usted no tiene permitido entrar a esta página /p>";
        } else if ($errorCode == 451) {
            echo "<p> Lo sentimos se ha producido un error matemático /p>";
        } else {
            echo "<p> Lo sentimos, encontramos un problema </p>
           <p> Ocurrió un error mientras el servidor web procesaba su solicitud</p>
           <p>Comuniquese con nuestro equipo de soporte y cuéntenos qué estaba tratando de hacer</p>
           <p>Gracias</p>";
        }
