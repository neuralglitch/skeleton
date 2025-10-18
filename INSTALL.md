# Installation Guide

This guide covers multiple installation methods:
- **Docker** (recommended for full development environment)
- **Symfony CLI** (quick development with local PHP)
- **PHP Built-in Server** (minimal setup for testing)

---

## Table of Contents

- [Quick Setup (Docker)](#quick-setup-docker)
  - [1. Clone the Repository](#1-clone-the-repository)
  - [2. Docker setup](#2-docker-setup)
  - [3. Environment Files](#3-environment-files)
  - [4. Install Dependencies](#4-install-dependencies)
  - [5. Build Assets](#5-build-assets)
  - [6. Run Tests](#6-run-tests)
  - [Verify Installation](#verify-installation)
- [Alternative Server Options](#alternative-server-options)
  - [Option 1: Symfony CLI Server](#option-1-symfony-cli-server-recommended)
  - [Option 2: PHP Built-in Server](#option-2-php-built-in-server)
  - [Comparison](#comparison)
- [Troubleshooting](#troubleshooting)
  - [Clear cache](#clear-cache)
  - [Check requirements](#check-requirements)
  - [Check versions](#check-versions)
  - [Check installed PHP extensions](#check-installed-php-extensions)
  - [Common Issues](#common-issues)

---

## Quick Setup (Docker)

### 1. Clone the Repository

**Latest version (main branch):**
```bash
git clone https://github.com/neuralglitch/skeleton.git <project>
cd <project>
```

**Specific version (recommended for production):**
```bash
# Clone and checkout a specific version tag
git clone --branch 7.3 --depth 1 https://github.com/neuralglitch/skeleton.git <project>
cd <project>
```

**Or clone first, then checkout:**
```bash
git clone https://github.com/neuralglitch/skeleton.git <project>
cd <project>
git checkout 7.3
```

> **Note:** See [available versions/tags](https://github.com/neuralglitch/skeleton/tags) or use `git tag -l` to list all versions.

### 2. Docker setup
#### 2.a. Build the container
```bash
docker compose build
```

#### 2.b. Start the container
```bash
docker compose up -d
```

#### 2.c. Stop and remove the container
```bash
docker compose down
```

### 3. Environment Files

**Important:** Generate a secure `APP_SECRET` for production:
```bash
docker compose exec web php -r "echo bin2hex(random_bytes(16)) . PHP_EOL;"
```

### 4. Install Dependencies

```bash
docker compose exec web composer install
```

### 5. Build Assets
#### 5.a. Locally
```bash
docker compose exec web bin/console asset-map:compile
docker compose exec web bin/console sass:build --watch
```

#### 5.b. Production
```bash
docker compose exec web bin/console asset-map:compile
docker compose exec web bin/console sass:build
```

### 6. Run Tests
```bash
docker compose exec web bin/phpunit
```

Or using PHPUnit directly:
```bash
docker compose exec web vendor/bin/phpunit
```

## Verify installation

Visit: `https://localhost`

---

## Alternative Server Options

If you don't want to use Docker, you can run the application using Symfony CLI or PHP's built-in server.

### Option 1: Symfony CLI Server (Recommended)

The Symfony CLI provides a local web server with TLS support.

#### Prerequisites
- PHP 8.1+ installed locally
- [Symfony CLI](https://symfony.com/download) installed

#### Setup

1. **Install Dependencies**
   ```bash
   composer install
   ```

2. **Create Environment File**
   ```bash
   cp .env .env.local
   # Edit .env.local with your configuration
   ```

3. **Generate APP_SECRET**
   ```bash
   php -r "echo bin2hex(random_bytes(16)) . PHP_EOL;"
   ```

4. **Build Assets**
   ```bash
   php bin/console sass:build
   php bin/console asset-map:compile
   ```

5. **Start the Server**
   ```bash
   symfony serve
   ```
   
   Or with custom port:
   ```bash
   symfony serve --port=8080
   ```
   
   For HTTPS with TLS certificate:
   ```bash
   symfony server:ca:install  # One-time setup
   symfony serve
   ```

6. **Access Application**
   
   Visit: `https://127.0.0.1:8000` (or the port shown in terminal)

#### Watch Assets in Development
   ```bash
   # In a separate terminal
   php bin/console sass:build --watch
   ```

#### Stop the Server
   ```bash
   symfony server:stop
   ```

---

### Option 2: PHP Built-in Server

For quick testing without additional tools.

#### Prerequisites
- PHP 8.2+ installed locally

#### Setup

1. **Install Dependencies**
   ```bash
   composer install
   ```

2. **Create Environment File**
   ```bash
   cp .env .env.local
   # Edit .env.local with your configuration
   ```

3. **Generate APP_SECRET**
   ```bash
   php -r "echo bin2hex(random_bytes(16)) . PHP_EOL;"
   ```

4. **Build Assets**
   ```bash
   php bin/console sass:build
   php bin/console asset-map:compile
   ```

5. **Start the Server**
   ```bash
   php -S 127.0.0.1:8000 -t public/
   ```
   
   Or bind to all interfaces:
   ```bash
   php -S 0.0.0.0:8000 -t public/
   ```

6. **Access Application**
   
   Visit: `http://127.0.0.1:8000`

#### Watch Assets in Development
   ```bash
   # In a separate terminal
   php bin/console sass:build --watch
   ```

#### Stop the Server
   Press `Ctrl+C` in the terminal

---

### Comparison

| Feature | Docker | Symfony CLI | PHP Server |
|---------|--------|-------------|------------|
| **Setup Complexity** | Medium | Low | Minimal |
| **HTTPS Support** | ✅ Yes | ✅ Yes | ❌ No |
| **Database Included** | ✅ Yes | ❌ No | ❌ No |
| **PHP Extensions** | ✅ Pre-installed | ⚠️ Manual | ⚠️ Manual |
| **Production-like** | ✅ Yes | ⚠️ Partial | ❌ No |
| **Best for** | Full dev env | Quick dev | Quick testing |

---

## Troubleshooting

### Clear cache

**Docker:**
```bash
docker compose exec web bin/console cache:clear
```

**Symfony CLI / PHP Server:**
```bash
php bin/console cache:clear
```

### Check requirements

**Docker:**
```bash
docker compose exec web symfony check:requirements
```

**Symfony CLI:**
```bash
symfony check:requirements
```

**PHP Server:**
```bash
php bin/console about
```

### Check versions

**Docker:**
```bash
docker compose exec web bin/check-versions
```

**Symfony CLI / PHP Server:**
```bash
php bin/check-versions
```

### Check installed PHP extensions

**Docker:**
```bash
docker compose exec web bin/check-php-extensions
```

**Symfony CLI / PHP Server:**
```bash
php bin/check-php-extensions
```

### Common Issues

#### SASS not compiling
Make sure you've built the SASS files:
```bash
php bin/console sass:build
```

#### Assets not loading
Compile the asset map:
```bash
php bin/console asset-map:compile
```

#### Permission errors (Linux/Mac)
Fix file permissions:
```bash
chmod -R 777 var/
```

#### Port already in use
Change the port number:
```bash
# Symfony CLI
symfony serve --port=8080

# PHP Server
php -S 127.0.0.1:8080 -t public/
```

