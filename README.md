<div align="center">

[![sikessem-logo]][sikessem-link]

<br/>

[![php-icon]][php-link]
[![typescript-icon]][typescript-link]
[![javascript-icon]][javascript-link]
[![packagist-version-icon]][packagist-version-link]
[![packagist-download-icon]][packagist-download-link]
[![license-icon]][license-link]
[![enabled-icon]][enabled-link]
[![actions-icon]][actions-link]
[![pr-icon]][pr-link]
[![twitter-icon]][twitter-link]

</div>

[sikessem-logo]: https://github.com/sikessem/art/blob/HEAD/images/sikessem.svg
[sikessem-link]: https://github.com/sikessem "Sikessem"

[php-icon]: https://img.shields.io/badge/PHP-ccc.svg?style=flat&logo=php
[php-link]: https://github.com/sikessem/ui/search?l=php "PHP code"

[typescript-icon]: https://img.shields.io/badge/TypeScript-294E80.svg?logo=typescript
[typescript-link]:  https://github.com/sikessem/ui/search?l=typescript "TypeScript code"

[javascript-icon]: https://img.shields.io/badge/JavaScript-yellow.svg?logo=javascript
[javascript-link]:  https://github.com/sikessem/ui/search?l=javascript "JavaScript code"

[packagist-version-icon]: https://img.shields.io/packagist/v/sikessem/ui
[packagist-version-link]: https://packagist.org/packages/sikessem/ui "Starter Releases"

[packagist-download-icon]: https://img.shields.io/packagist/dt/sikessem/ui
[packagist-download-link]: https://packagist.org/packages/sikessem/ui "Starter Downloads"

[enabled-icon]: https://img.shields.io/badge/Starter-enabled-brightgreen.svg?style=flat
[enabled-link]: https://github.com/sikessem/ui "Starter enabled"

[actions-icon]: https://github.com/sikessem/ui/workflows/CI/badge.svg
[actions-link]: https://github.com/sikessem/ui/actions "Starter status"

[pr-icon]: https://img.shields.io/badge/PRs-welcome-brightgreen.svg?color=brightgreen
[pr-link]: [contrib-link] "PRs welcome!"

[twitter-icon]: https://img.shields.io/twitter/follow/sikessem_tweets.svg?label=@sikessem_tweets
[twitter-link]: https://twitter.com/intent/follow?screen_name=sikessem_tweets "Ping Sikessem"

[license-icon]: https://img.shields.io/badge/license-MIT-blue.svg
[license-link]: https://github.com/sikessem/ui/blob/HEAD/LICENSE "Starter License"
[conduct-link]: https://github.com/sikessem/ui/blob/HEAD/CODE_OF_CONDUCT.md
[contrib-link]: https://github.com/sikessem/.github/blob/HEAD/CONTRIBUTING.md
[discuss-link]: https://github.com/orgs/sikessem/discussions
[docs-link]: https://github.com/sikessem/ui#readme "Starter Documentation"

[tailwindcss-home]: https://tailwindcss.com "TailwindCSS"
[alpinejs-home]: https://alpinejs.dev "Alpine.js"
[laravel-home]: https://laravel.com "Laravel"
[livewire-home]: https://laravel-livewire.com "Laravel Livewire"

***

# 🍱 Sikessem's UI kit

[TailwindCSS][tailwindcss-home], [Alpine.js][alpinejs-home] and [Laravel][laravel-home] [Livewire][livewire-home] UI kit for Artisans.

## 🔖 Contents

- [🍱 Sikessem's UI kit](#-sikessems-ui-kit)
  - [🔖 Contents](#-contents)
  - [📋 Requirements](#-requirements)
  - [🎉 Getting Started](#-getting-started)
    - [⚡️ Installation](#️-installation)
    - [🧑‍💻 Usage](#-usage)
      - [📝 Syntax](#-syntax)
        - [View namespace](#view-namespace)
        - [Component alias](#component-alias)
        - [Component tags](#component-tags)
        - [Component slots](#component-slots)
        - [Blade directives](#blade-directives)
        - [ui() helper](#ui-helper)
        - [UI facade](#ui-facade)
      - [🍱 UI Components](#-ui-components)
        - [Text component](#text-component)
        - [Link component](#link-component)
        - [Button component](#button-component)
        - [Menu component](#menu-component)
        - [Label component](#label-component)
        - [Flash component](#flash-component)
        - [Flashes component](#flashes-component)
        - [Form component](#form-component)
        - [Error component](#error-component)
        - [Errors component](#errors-component)
        - [Entry component](#entry-component)
        - [Icon component](#icon-component)
      - [🎨 Custom components](#-custom-components)
    - [🧪 Testing and debugging](#-testing-and-debugging)
      - [🧹 Keep a modern codebase](#-keep-a-modern-codebase)
      - [⚗️ Run static analysis](#️-run-static-analysis)
      - [✅ Run unit tests](#-run-unit-tests)
      - [🐛 Check all code bugs](#-check-all-code-bugs)
  - [📖 Documentation](#-documentation)
  - [👏 Contribution](#-contribution)
    - [👷 Code of Conduct](#-code-of-conduct)
    - [👥 Contributing Guide](#-contributing-guide)
    - [🔒️ Good First Issues](#️-good-first-issues)
    - [💬 Discussions](#-discussions)
  - [🔐 Security Reports](#-security-reports)
  - [📄 License](#-license)

## 📋 Requirements

> - **Requires [PHP 8.1+](https://php.net/releases/)** (at least 8.1.21 recommended to avoid potential bugs).
> - **Requires [Node JS 18.16+](https://nodejs.org/)** (at least 18.16.1 recommended to avoid potential bugs).
> - **Requires [Composer >=2.5.8](https://getcomposer.org/)** to manage [PHP][php-link] dependencies.
> - **Requires [pnpm@^8.0.0](https://pnpm.io/)** to manage [JS][javascript-link] and [TS][typescript-link] dependencies.
> - **Requires [Git ~2.40.0](https://git-scm.com/)** to manage source code versions.

## 🎉 Getting Started

### ⚡️ Installation

Install [the Sikessem UI kit](https://packagist.org/packages/sikessem/ui) using [Composer](https://getcomposer.org/):

- By adding the `sikessem/ui` dependency to your `composer.json` file:

```json
{
    "require" : {
        "sikessem/ui": "self.version"
    }
}
```

- Or by including the dependency:

```shell
composer require sikessem/ui --no-dev
```

### 🧑‍💻 Usage

#### 📝 Syntax

There are several ways to use Sikessem's UI components.

In the following examples **component-name** represents the name of the desired UI component.
If you want to use the text component, replace **component-name** with **text** as needed.

You can find the list of [all components here](#-ui-components).

##### View namespace

```html
<x-ui::component-name property="value">
  Content
</x-ui::component-name>
```

##### Component alias

```html
<x-ui-component-name property="value">
  Content
</x-ui-component-name>
```

##### Component tags

```html
<s-component-name property="value"/>
```

```html
<s-component-name property="value">
  {{ $slot }}
</s-component-name>
```

##### Component slots

```html
<s-component-name property="value">
  <s:slot-name slot-property="property-value">
    My Slot
  </s:slot-name>
</s-component-name>
```

##### Blade directives

Render a UI component:

```blade
@ui('component-name', ['property' => 'value'], 'Optional component slot or content')
```

If **component-name** is not a [UI component](#-ui-components) it will be rendered as an HTML element.

Render an HTML orphan tag:

```blade
@tag('element-name', ['property' => 'value'])
```

Render an HTML paired tag:

```blade
@tag('element-name', ['property' => 'value'])
  Here, element content or nothing.
@endtag
```

Note that the name of the element is not specified when closing. This is automatically detected according to the nesting order of the paired elements.

##### ui() helper

```php
ui()->make('component-name', ['property' => 'value'], 'content')
```

##### UI facade

```php
UI::make('component-name', ['property' => 'value'], 'content')
```

#### 🍱 UI Components

In the following examples, we will use [component tags](#component-tags). However, the result will be the same if you prefer to [use another syntax](#-syntax).

##### Text component

Allows to translate and/or escape a text:

```html
<s-text value="Sigui Kessé Emmanuel<contact@sigui.ci>" escape translate/>
```

This will output the following HTML:

```html
Sigui Kessé Emmanuel&lt;contact@sigui.ci&gt;
```

##### Link component

Create an anchor pointing to a route or URL:

```html
<s-link route="home">Back to home</s-link>
```

```html
<s-link href="/">Back to home</s-link>
```

This will output the following HTML:

```html
<a href="/">Back to home</a>
```

```html
<a href="http://localhost/">Back to home</a>
```

##### Button component

Create a button or an anchor:

```html
<s-button>Click me</s-button>
```

```html
<s-button type="submit">Click me</s-button>
```

```html
<s-button href="/">Click me</s-button>
```

This will output the following HTML:

```html
<button type="button">Click me</button>
```

```html
<button type="submit">Click me</button>
```

```html
<a href="http://localhost">Click me</a>
```

##### Menu component

Create a menu containing a list of entries:

```html
<s-menu ordered :list="['Red', 'Green', 'Blue']"/>
```

```html
<s-menu href="['Color' => ['Red', 'Green', 'Blue'], 'Author' => ['Kessé Emmanuel', 'Sigui']]"/>
```

This will output the following HTML:

```html
<ol>
  <li>Red</li>
  <li>Green</li>
  <li>Blue</li>
</ol>
```

```html
<ul>
  <li>
    Color
    <ul>
      <li>Red</li>
      <li>Green</li>
      <li>Blue</li>
    </ul>
  </li>
  <li>
    Author
    <ul>
      <li>Kessé Emmanuel</li>
      <li>Sigui</li>
    </ul>
  </li>
</ul>
```

##### Label component

Create a label:

```html
<s-label>Content</s-label>
```

```html
<s-label for="name" text="Name"/>
```

This will output the following HTML:

```html
<label>Content</label>
```

```html
<label for="name">Name</label>
```

##### Flash component

Create a flash:

```html
<s-flash type="info"/>
```

```html
<s-flash class="alert" type="info" message="Default info"/>
```

If session "info" was set to "Info", the output will be:

```html
<p>Info</p>
```

Otherwise, the output will be:

```html
<p></p>
```

Or (in the second example):

```html
<p class="alert">Default info</p>
```

##### Flashes component

```html
<s-flashes :messages="['info' => 'Info', 'warning']"/>
```

If the "info" and "warning" sessions have been set to "Info" and "Warning" respectively, the output will be:

```html
<ul>
  <li>Info</li>
  <li>Warning</li>
</ul>
```

Otherwise, the output will be:

```html
<ul>
  <li>Info</li>
</ul>
```

##### Form component

Create a form:

```html
<s-form>
  Put the form content here
</s-form>
```

This will output the following HTML:

```html
<form method="GET" action="#">
  <input type="hidden" name="_token" value="...">
</form>

```

##### Error component

Create a error:

```html
<s-error field="name"/>
```

##### Errors component

```html
<s-errors/>
```

##### Entry component

Create an entry:

```html
<s-entry type="email"/>
```

```html
<s-entry type="textarea" name="comment"/>
```

This will output the following HTML:

```html
<input type="email" name="email" id="email" autocomplete="email" aria-invalid="false"/>
```

```html
<textarea name="comment" id="comment" autocomplete="comment" aria-invalid="false">
</textarea>
```

##### Icon component

```html
<s-icon name="user-group"/>
```

```html
<s-icon element="svg" name="user-group" type="solid" width="20" height="20" size="20"/>
```

```html
<s-icon element="i" name="user-group" type="solid" width="20" height="20" size="20"/>
```

```html
<s-icon element="img" name="user-group" type="solid" width="20" height="20" size="20"/>
```

#### 🎨 Custom components

Create custom components from `config/ui.php` file.

```blade
@ui('custom', ['class' => 'element', 'id' => 'myElement'], '')
  My custom component
@endui
```

Output:

```html
<custom-element class="my custom element" id="myElement">
  My custom component
</custom-element>

```

### 🧪 Testing and debugging

#### 🧹 Keep a modern codebase

- with **Rome**:

```shell
pnpm check
```

- with **Pint**:

```shell
composer check
```

#### ⚗️ Run static analysis

- Using **PHPStan**:

```shell
composer analyse
```

#### ✅ Run unit tests

- using **Vitest**:

```shell
pnpm test
```

- using **PEST**:

```shell
composer test
```

#### 🐛 Check all code bugs

- Frontend:

```shell
pnpm debug
```

- Backend:

```shell
composer debug
```

## 📖 Documentation

The full documentation for the Sikessem Starter can be found on [this address][docs-link].

## 👏 Contribution

The main purpose of this repository is to continue evolving Sikessem. We want to make contributing to this project as easy and transparent as possible, and we are grateful to the community for contributing bug fixes and improvements. Read below to learn how you can take part in improving Sikessem.

### [👷 Code of Conduct][conduct-link]

Sikessem has adopted a Code of Conduct that we expect project participants to adhere to.
Please read the [full text][conduct-link] so that you can understand what actions will and will not be tolerated.

### 👥 [Contributing Guide][contrib-link]

Read our [**Contributing Guide**][contrib-link] to learn about our development process, how to propose bugfixes and improvements, and how to build and test your changes to Sikessem.

### 🔒️ Good First Issues

We have a list of [good first issues][gfi] that contain bugs which have a relatively limited scope. This is a great place to get started, gain experience, and get familiar with our contribution process.

[gfi]: https://github.com/sikessem/ui/labels/good%20first%20issue

### 💬 Discussions

Larger discussions and proposals are discussed in [**Sikessem's GitHub discussions**][discuss-link].

## 🔐 Security Reports

If you discover a security vulnerability within [Sikessem](https://sikessem.com), please email [SIGUI Kessé Emmanuel](https://github.com/siguici) at [contact@sigui.ci](mailto:contact@sigui.ci). All security vulnerabilities will be promptly addressed.

## 📄 License

The Sikessem Starter is open-sourced software licensed under the  [MIT License](https://opensource.org/licenses/MIT) - see the [LICENSE][license-link] file for details.

***

<div align="center"><sub>Made with ❤︎ by <a href="https://twitter.com/intent/follow?screen_name=siguici" style="content:url(https://img.shields.io/twitter/follow/siguici.svg?label=@siguici);margin-bottom:-6px">@siguici</a>.</sub></div>
