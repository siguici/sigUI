# [Sikessem's UI Kit](https://sikessem.github.io/ui)

Design responsive user interfaces with light/dark mode and theme management quickly with this TailwindCSS-based plugin.

## 🚀 Installation

You can install [`@sikessem/ui`](https://sikessem.github.io/ui) from [`JSR`](https://jsr.io/@sikessem/ui):

- Using `npm`:

  ```bash
  npx jsr add @sikessem/ui
  ```

- Using `Yarn`:

  ```bash
  yarn dlx jsr add @sikessem/ui
  ```

- Using `PNPM`:

  ```bash
  pnpm dlx jsr add @sikessem/ui
  ```

- Using `Bun`:

  ```bash
  bunx jsr add @sikessem/ui
  ```

- Using `Deno`:

  ```bash
  deno add @sikessem/ui
  ```

  Without install:

  ```typescript
  import ui from 'jsr:@sikessem/ui';
  ```

## 🔧 Configuration

Add [`@sikessem/ui`](https://sikessem.github.io/ui) to your [TailwindCSS configuration](https://tailwindcss.com/docs/configuration):

- With `NPM` (from `node_modules`):

  ```javascript ins={1,5}
  import ui from '@sikessem/ui';

  /** @type {import('tailwindcss').Config} */
  export default {
    plugins: [ui],
  };
  ```

- With `JSR` (using `Deno`):

  ```javascript ins={1,5}
  import ui from 'jsr:@sikessem/ui';

  /** @type {import('tailwindcss').Config} */
  export default {
    plugins: [ui],
  };
  ```

## 💡 Usage

Simply use the provided class names in your `HTML` or `JSX` to apply color styles that adapt to the light or dark mode.

### Using Color Classes

Use the following class convention to apply color styles that adapt to light/dark themes:

- `variant-color-[light|dark]-X` where variant is a `TailwindCSS` variant (`text`, `bg`, `border`, etc.), color is the color name (e.g., `blue`, `red`, `green`, etc.), and X corresponds to:

  - 0: color-50 in light mode or color-950 in dark mode
  - 1: color-100 in light mode or color-900 in dark mode
  - 2: color-200 in light mode or color-800 in dark mode
  - 3: color-300 in light mode or color-700 in dark mode
  - 4: color-400 in light mode or color-600 in dark mode
- You can also use variant-color for variant-color-500 (adapts to theme)

### Example in HTML

```html
<!-- Light mode -->
<p class="text-blue-light-0">This is text in a light blue shade.</p>

<!-- Dark mode -->
<p class="text-blue-dark-0">This is text in a dark blue shade.</p>

<!-- Default color (adapts to theme) -->
<p class="text-blue-0">This is text in the default blue shade.</p>
```

## 📄 License

This project is licensed under the MIT License - see the [LICENSE.md file](./LICENSE.md) for details.
