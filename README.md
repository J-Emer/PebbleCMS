## Still in development so some features may not be avaliable


# Pebble CMS

Pebble CMS is a lightweight content management system built in PHP, designed for simplicity and flexibility. It allows small businesses and individuals to easily create and manage their websites with dynamic pages, posts, and theme support.

## Features

- **Dynamic Pages & Posts**: Easily create and manage static pages and blog posts.
- **Customizable Themes**: Easily switch between themes or create your own.
- **Content Management**: Organize your posts into categories for better content grouping.
- **Template Engine**: Powered by Twig for flexible and secure templating.
- **Routing**: Simple and intuitive routing system with dynamic URL support.
- **Configuration**: Centralized configuration via YAML files for easy management.

## Requirements

- PHP 7.4 or higher
- Composer
- Web server (Apache or Nginx recommended)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/pebble-cms.git
   cd pebble-cms
   ```

2. Install dependencies using Composer:
   ```bash
   composer install
   ```

3. Set up the database and configure your `.env` file (if applicable).

4. Set up your web server to point to the `public` directory.

5. Access the site via `http://localhost` (or your configured domain).

## Configuration

Configuration is handled through the `config.yaml` file. Here you can set options like site name, theme, content directories, and pagination settings.

Example:
```yaml
site:
  name: "My Pebble Site"
  description: "A simple content management system"
  url: "http://localhost"

theme:
  name: "default"
  path: "/themes/default"

content:
  posts_directory: "/content/posts"
  pages_directory: "/content/pages"

pagination:
  posts_per_page: 10
```

## Adding New Themes

To create a new theme, simply create a new directory under `themes/`, and include the necessary templates and assets. A default theme with example templates is included.

1. Create your theme directory under `themes/`.
2. Add your `base.twig.html`, `page.twig.html`, `post.twig.html`, and any other templates you need.
3. Add your CSS, JavaScript, and other assets to the theme.

## Contributing

Feel free to fork the repository and submit pull requests. Please ensure that your code follows the project's coding style and includes tests for any new functionality.

## License

This project is open-source and available under the [MIT License](LICENSE).
