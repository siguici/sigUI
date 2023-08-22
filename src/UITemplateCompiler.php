<?php

namespace Sikessem\UI;

use Illuminate\View\Compilers\BladeCompiler;
use Sikessem\UI\Contracts\IsTemplateCompiler;

class UITemplateCompiler extends BladeCompiler implements IsTemplateCompiler
{
}
