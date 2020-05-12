<?php
/**
 * Module information
 */

use D3\Heidelpay\Setup\CleanupRoutine;
use D3\Heidelpay\Setup\InstallRoutine;
use D3\Heidelpay\Setup\UpdateRoutine;

$aModule = array(
    'd3SetupClasses' => array(
        InstallRoutine::class,
        CleanupRoutine::class,
        UpdateRoutine::class,
    ),
);
