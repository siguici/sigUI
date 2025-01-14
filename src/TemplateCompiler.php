<?php

namespace Sigui\UI;

use Illuminate\View\Compilers\BladeCompiler;
use Sigui\UI\Contracts\IsTemplateCompiler;

class TemplateCompiler extends BladeCompiler implements IsTemplateCompiler {}
