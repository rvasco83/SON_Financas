<?php
declare(strict_types = 1);

namespace SONFin\View;

use Psr\Http\Message\ResponseInterface;

interface ViewRendererInterface
{
    public function render(String $template, array $context = []): ResponseInterface;
}
