<div align="center">

# Skeleton

### Symfony Flex starter kit with AssetMapper, SassBundle, Bootstrap SCSS customization, StimulusBundle, UX Icons and UX Twig Components

[![Docker](https://img.shields.io/badge/Docker-Ready-2496ED.svg?style=flat-square)](docker/web/Dockerfile)
[![Apache](https://img.shields.io/badge/Apache-2.4-D22128.svg?style=flat-square)](https://httpd.apache.org/)
[![Composer](https://img.shields.io/badge/Composer-Latest-885630.svg?style=flat-square)](https://getcomposer.org/)
[![MySQL](https://img.shields.io/badge/MySQL-Ready-4479A1.svg?style=flat-square)](https://www.mysql.com/)
[![PostgreSQL](https://img.shields.io/badge/PostgreSQL-Ready-336791.svg?style=flat-square)](https://www.postgresql.org/)
[![Redis](https://img.shields.io/badge/Redis-Enabled-DC382D.svg?style=flat-square)](https://redis.io/)
<br/>
[![Xdebug](https://img.shields.io/badge/Xdebug-Enabled-DB1F29.svg?style=flat-square)](https://xdebug.org/)
[![SSL](https://img.shields.io/badge/SSL-HTTPS%20Ready-green.svg?style=flat-square)](docker/web/apache/certificate/)
[![php](https://img.shields.io/badge/PHP-8.1+-4F5B93.svg?style=flat-square)](https://www.php.net/)
[![symfony](https://img.shields.io/badge/Symfony-6.4%20LTS-1F2937.svg?style=flat-square)](https://www.symfony.com/)
[![bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952b3.svg?style=flat-square)](https://getbootstrap.com/)
[![license](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](LICENSE)

[![PHPStan](https://img.shields.io/badge/PHPStan-Level%206-brightgreen.svg?style=flat-square)](phpstan.dist.neon)
[![PHPUnit](https://img.shields.io/badge/PHPUnit-10.5-brightgreen.svg?style=flat-square)](phpunit.dist.xml)
[![Coverage](https://img.shields.io/badge/Coverage-80%25%20Goal-yellow.svg?style=flat-square)](https://github.com/neuralglitch/skeleton/actions/workflows/tests.yml)
[![Maintenance](https://img.shields.io/badge/Maintained-Yes-green.svg?style=flat-square)](https://github.com/neuralglitch/skeleton/commits/main)
[![Tested on PHP](https://img.shields.io/badge/Tested%20on-PHP%208.1/8.2/8.3/8.4-4F5B93.svg?style=flat-square)](https://www.php.net/)

[![Build](https://github.com/neuralglitch/skeleton/actions/workflows/build.yml/badge.svg?branch=main-6.4)](https://github.com/neuralglitch/skeleton/actions/workflows/build.yml)
[![Tests](https://github.com/neuralglitch/skeleton/actions/workflows/tests.yml/badge.svg?branch=main-6.4)](https://github.com/neuralglitch/skeleton/actions/workflows/tests.yml)
[![Static Analysis](https://github.com/neuralglitch/skeleton/actions/workflows/static-analysis.yml/badge.svg?branch=main-6.4)](https://github.com/neuralglitch/skeleton/actions/workflows/static-analysis.yml)
[![Docker](https://github.com/neuralglitch/skeleton/actions/workflows/docker.yml/badge.svg?branch=main-6.4)](https://github.com/neuralglitch/skeleton/actions/workflows/docker.yml)
</div>

---

## Overview

A modern **Symfony 6.4 LTS** starter kit/boilerplate designed as a production-ready foundation for web applications. This skeleton demonstrates contemporary frontend tooling without Node.js complexity, leveraging Symfony's AssetMapper for a streamlined development experience.

### Purpose

This project serves as a comprehensive starting point that showcases:
- Modern asset management without traditional JavaScript bundlers
- Bootstrap 5.3 with full SCSS customization capabilities
- Stimulus JavaScript framework for progressive enhancement
- Docker-based development environment with SSL
- Enterprise-grade CI/CD pipeline with multiple quality gates
- Best practices for PHP 8.1+ and Symfony 6.4 development

---

## Key Features

### Frontend Stack
- **Bootstrap 5.3** - Full SCSS customization with custom variables
- **AssetMapper** - Modern asset management without Node.js/npm
- **Stimulus Bundle** - Reactive JavaScript controllers
- **SassBundle** - On-the-fly SCSS compilation
- **UX Turbo** - Hotwire Turbo for SPA-like experience
- **UX Icons** - Icon system integration
- **UX Twig Components** - Reusable component system
- **Masonry Layout** - Grid layout library included

### Backend & DevOps
- **Docker Environment** - Complete containerized setup with Apache, SSL, and PHP extensions
- **Comprehensive Testing** - PHPUnit 10.5 with 80% coverage goal
- **Static Analysis** - PHPStan Level 6 for code quality
- **Security Focused** - Roave security advisories integration
- **Web Profiler** - Built-in debugging and profiling tools
- **Custom Error Pages** - Branded error templates (403, 404, 500, 503)

### CI/CD Pipeline
- **Build Workflow** - Asset compilation and validation
- **Test Workflow** - Matrix testing across PHP 8.1-8.4
- **Static Analysis** - PHPStan, composer validation, security audit, YAML/Twig linting
- **Docker Workflow** - Container linting, building, and health checks
- **Auto-Tag Workflow** - Automatic version tagging on Symfony updates
- **Manual-Tag Workflow** - Manual tag creation via GitHub Actions

---

## Technology Stack

### Backend
- **PHP 8.1+** (tested on 8.1, 8.2, 8.3, 8.4)
- **Symfony 6.4** (LTS version with long-term support)
- **Composer** for dependency management

### Frontend
- **Bootstrap 5.3** with customizable SCSS architecture
- **Stimulus** for modern JavaScript interactions
- **AssetMapper** (no Node.js/npm required)
- **ImportMap** for JavaScript module management

### Development Tools
- **PHPUnit 10.5** - Unit and functional testing
- **PHPStan Level 6** - Advanced static analysis
- **Docker** with Apache, SSL certificates, and PHP extensions
- **Symfony CLI** - Enhanced development commands
- **Xdebug** - Easily toggleable debugging and code coverage (disabled by default)

### PHP Extensions Included
- bcmath, exif, gd, intl, mbstring, pcntl
- PDO (MySQL/PostgreSQL support)
- APCu, Redis, Imagick
- Xdebug (disabled by default, easy toggle via `bin/xdebug`)

---

## Quick Start

For detailed installation instructions, see **[INSTALL.md](INSTALL.md)**

### Quick Setup Summary

1. **Clone the repository** (use a specific version tag for production):
   ```bash
   git clone --branch 6.4 --depth 1 https://github.com/neuralglitch/skeleton.git myproject
   ```
2. Build and start Docker containers
3. Install dependencies with Composer
4. Build SCSS and compile assets
5. Visit `https://localhost`

See the [Installation Guide](INSTALL.md) for complete step-by-step instructions and troubleshooting.

### Versioning

This project uses **branch-per-Symfony-version** strategy:

**Clone Symfony 6.4 LTS (Recommended):**
```bash
git clone --branch main-6.4 https://github.com/neuralglitch/skeleton.git myproject
```

**Clone latest version:**
```bash
git clone https://github.com/neuralglitch/skeleton.git myproject
```

See **[VERSIONING.md](VERSIONING.md)** for complete guide including setup instructions, branch strategy, and tagging workflows.

---

## Project Structure

```
skeleton/
├── assets/              # Frontend assets
│   ├── controllers/     # Stimulus controllers
│   ├── styles/          # SCSS files with Bootstrap customization
│   ├── fonts/           # Ubuntu Sans & Mono web fonts
│   ├── icons/           # SVG icons
│   └── vendor/          # JavaScript dependencies (ImportMap managed)
├── bin/                 # CLI utilities and console commands
├── config/              # Symfony configuration files
│   ├── packages/        # Bundle configurations
│   └── routes/          # Routing configuration
├── docker/              # Docker configuration
│   └── web/             # Web container setup
│       ├── Dockerfile   # PHP 8.1-Apache image
│       ├── apache/      # Apache config & SSL certificates
│       └── php/         # PHP configuration
├── public/              # Web root
│   └── index.php        # Front controller
├── src/                 # PHP application code
│   ├── Controller/      # Controllers
│   └── Kernel.php       # Application kernel
├── templates/           # Twig templates
│   ├── base.html.twig   # Base layout
│   ├── skeleton/        # Application templates
│   ├── partials/        # Reusable components (header, footer)
│   └── bundles/         # Custom error page templates
├── tests/               # PHPUnit tests
├── var/                 # Cache, logs, compiled assets
└── vendor/              # Composer dependencies
```

---

## Frontend Architecture

### SCSS Structure
- **Custom Variables** (`_variables.scss`) - Brand colors and theme customization
- **Font System** (`_fonts.scss`) - Ubuntu Sans and Mono web fonts
- **Bootstrap Integration** (`app.scss`) - Modular Bootstrap imports with customization
- **Custom Styles** (`_custom.scss`) - Application-specific styles

### JavaScript Architecture
- **Stimulus Controllers** - Located in `assets/controllers/`
- **ImportMap** - JavaScript dependencies without npm (see `importmap.php`)
- **Turbo Integration** - Enhanced navigation and form handling
- **Bootstrap JS** - Interactive components

---

## Development Environment

### Xdebug Management

Xdebug is **installed but disabled by default** for optimal performance. Enable it when you need debugging or code coverage analysis.

**Quick Toggle:**
```bash
# Check status
docker compose exec web bin/xdebug status

# Enable for debugging
docker compose exec web bin/xdebug on
docker compose restart web

# Enable for coverage
docker compose exec web bin/xdebug coverage
docker compose restart web

# Disable
docker compose exec web bin/xdebug off
docker compose restart web
```

**Enable on Container Start:**
```bash
# Temporary (this session only)
XDEBUG_ENABLED=1 docker compose up -d

# Permanent (via .env file)
echo "XDEBUG_ENABLED=1" > .env
docker compose up -d
```

**Run Tests with Coverage:**
```bash
# Enable coverage mode
docker compose exec web bin/xdebug coverage
docker compose restart web

# Generate coverage report
docker compose exec web vendor/bin/phpunit --coverage-text
docker compose exec web vendor/bin/phpunit --coverage-html coverage/
```

**Performance Note:** Xdebug slows execution by 2-3x. Keep it disabled during regular development and only enable when needed.

**IDE Setup:**
- **Port:** 9003
- **Path mapping:** `/var/www` → `${workspaceFolder}`
- Configure your IDE to listen on port 9003 for Xdebug connections

---

## Code Quality & Testing

### Static Analysis
- **PHPStan Level 6** - High standard static analysis across the entire codebase
- **Strict PHPUnit Configuration** - Fail on risky tests and warnings
- **YAML/Twig Linting** - Automated template validation
- **Composer Validation** - Dependency integrity checks

### Testing
- **PHPUnit 10.5** with comprehensive configuration
- **80% Code Coverage Goal** - Monitored in CI/CD
- **Matrix Testing** - Tested across PHP 8.1, 8.2, 8.3, and 8.4
- **Functional Tests** - Application availability testing included

### Security
- **Roave Security Advisories** - Automated security vulnerability detection
- **Composer Audit** - Regular security checks in CI/CD
- **CSRF Protection** - Built-in with Symfony Security

---

## Use Cases

This skeleton is ideal for:
- 🏗️ Starting new Symfony 6.4 projects with modern tooling
- 📚 Learning Symfony with AssetMapper (no webpack/vite complexity)
- 🎨 Projects requiring deep Bootstrap customization
- 🐳 Teams wanting Docker-based development environments
- ⚡ Applications needing modern JavaScript without Node.js overhead
- 🚀 Projects requiring comprehensive CI/CD from day one
- 🏢 Enterprise applications requiring high code quality standards

---

## Design Philosophy

### Key Architectural Decisions

1. **No Node.js Required** - Uses AssetMapper instead of traditional bundlers, reducing complexity and build times
2. **PHP 8.1+ Only** - Leverages modern PHP features including attributes for routing
3. **Docker-First Approach** - Entire development environment is containerized and reproducible
4. **Symfony Flex** - Modern, minimal Symfony project structure
5. **Multi-Stage Quality Gates** - 4 separate CI/CD workflows for comprehensive validation
6. **Custom Error Pages** - Professional error handling with branded templates
7. **Security-Conscious** - Built-in security scanning and best practices

---

## Configuration Highlights

### Environment Variables
- `APP_ENV` - Application environment (dev, test, prod)
- `APP_SECRET` - Security token for CSRF and sessions
- `DEFAULT_URI` - Default application URI

### Asset Pipeline
- SCSS compilation via SassBundle (no Node.js)
- Asset fingerprinting for cache busting
- Automatic vendor management via ImportMap

### Docker Services
- **Web Service** - PHP 8.1-Apache with SSL
- Exposes ports 80 (HTTP) and 443 (HTTPS)
- Volume mounting for live code updates

---

## CI/CD Pipeline Details

### Build Workflow
- SASS compilation validation  
- ImportMap installation  
- Asset compilation  
- CSS size checks  
- Production cache warmup  

### Test Workflow
- PHP 8.1, 8.2, 8.3, 8.4 matrix testing  
- PHPUnit with testdox output  
- Code coverage reporting  
- Coverage artifacts  

### Static Analysis Workflow
- PHPStan Level 6 analysis  
- Composer validation  
- Security vulnerability scanning  
- YAML file linting  
- Twig template linting  

### Docker Workflow
- Dockerfile linting (hadolint)  
- Docker image building  
- Docker Compose validation  
- Service health checks

### Auto-Tag Workflow
- Triggers on `composer.lock` changes
- Auto-detects Symfony version
- Creates version tags automatically
- Generates GitHub Releases

### Manual-Tag Workflow
- Manual tag creation via GitHub UI
- Custom tag versions and release notes
- Validates Symfony alignment
- Optional GitHub Release creation

---

## Documentation

- **[INSTALL.md](INSTALL.md)** - Complete installation guide with troubleshooting
- **[VERSIONING.md](VERSIONING.md)** - Complete versioning guide (branches, tags, workflows, maintenance)
- **[LICENSE](LICENSE)** - MIT License details
- **composer.json** - PHP dependencies and scripts
- **importmap.php** - JavaScript dependency configuration
- **phpstan.dist.neon** - Static analysis configuration
- **phpunit.dist.xml** - Test suite configuration

---

## Contributing

This is a starter skeleton project. Feel free to:
- Fork and customize for your needs
- Report issues or suggestions
- Share improvements back to the community

---

## License

MIT License - Copyright (c) 2025 neuralglit.ch

See [LICENSE](LICENSE) file for full details.

---

## Credits

Built with:
- [Symfony](https://symfony.com/) - The PHP framework
- [Bootstrap](https://getbootstrap.com/) - Frontend toolkit
- [Stimulus](https://stimulus.hotwired.dev/) - JavaScript framework
- [Docker](https://www.docker.com/) - Containerization platform

---

<div align="center">

**Made with ❤️ by [neuralglit.ch](https://neuralglit.ch)**

</div>