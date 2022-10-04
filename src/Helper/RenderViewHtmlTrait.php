<?php

namespace Project\System\Helper;

trait RenderViewHtmlTrait
{
    public function renders(string $path, array $dados): string
    {
        extract($dados);

        ob_start();
        require(__DIR__."/../../view/".$path);
        $html = ob_get_clean();

        return $html;
    }
}