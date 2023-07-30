<?php

namespace Sikessem\UI;

use Illuminate\View\Compilers\BladeCompiler;
use Sikessem\UI\Contracts\TemplateCompilerContract;

class UITemplateCompiler extends BladeCompiler implements TemplateCompilerContract
{
}
