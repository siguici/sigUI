<?php

it('should render menu component', function () {
    $this->render(<<<'BLADE'
<s-menu :list="['Red', 'Green', 'Blue']" class="menu"/>
BLADE)
        ->toStartWith('<ul class="menu">')
        ->toContain('<li>Red</li>', '<li>Green</li>', '<li>Blue</li>')
        ->toEndWith('</ul>');

    $this->render(<<<'BLADE'
<s-menu ordered :list="['Red', 'Green', 'Blue']"/>
BLADE)
        ->toStartWith('<ol>')
        ->toContainInOrder('<li>Red</li>', '<li>Green</li>', '<li>Blue</li>')
        ->toEndWith('</ol>');

    $items = "['Color' => ['Red', 'Green', 'Blue'], 'Author' => ['Firstname' => ['Kessé', 'Emmanuel'], 'Lastname' => 'Sigui']]";

    expect(<<<'HTML'
<ol>
    <li>
        Color
        <ol>
            <li>
                Red
            </li>
            <li>
                Green
            </li>
            <li>
                Blue
            </li>
        </ol>
    </li>
    <li>
        Author
        <ol>
            <li>
                Firstname
                <ol>
                    <li>
                        Kessé
                    </li>
                    <li>
                        Emmanuel
                    </li>
                </ol>
            </li>
            <li>
                Lastname
                <ol>
                    <li>
                        Sigui
                    </li>
                </ol>
            </li>
        </ol>
    </li>
</ol>
HTML)
        ->toBeRenderOf('<s-menu ordered :list="'.$items.'"/>');
});
