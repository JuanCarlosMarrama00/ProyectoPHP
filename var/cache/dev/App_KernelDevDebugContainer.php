<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerUeLhNpe\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerUeLhNpe/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerUeLhNpe.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerUeLhNpe\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerUeLhNpe\App_KernelDevDebugContainer([
    'container.build_hash' => 'UeLhNpe',
    'container.build_id' => 'e96f6dd3',
    'container.build_time' => 1697612549,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerUeLhNpe');
