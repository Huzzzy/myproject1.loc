<?php

return [
    '~^hello/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayHello'],
    '~^articles/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'view'],
    '~^articles/(\d+)/edit$~' => [\MyProject\Controllers\ArticlesController::class, 'edit'],
    '~^articles/add$~' => [\MyProject\Controllers\ArticlesController::class, 'add'],
    '~^articles/(\d+)/delete$~' => [\MyProject\Controllers\ArticlesController::class, 'delete'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
    '~^bye/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayBye']
];