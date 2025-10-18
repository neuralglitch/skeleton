#!/bin/bash
set -e

echo "=========================================="
echo "Running startup checks..."
echo "=========================================="

# Change to the application directory
cd /var/www

# Check if vendor directory exists, if not install dependencies
if [ ! -d "vendor" ]; then
    echo ""
    echo ">>> Vendor directory not found, running: composer install"
    echo "------------------------------------------"
    composer install --no-interaction --no-progress --prefer-dist --optimize-autoloader || {
        echo "⚠️  Composer install failed, skipping vendor-dependent checks"
        SKIP_VENDOR_CHECKS=1
    }
fi

# Run check-versions
if [ -f "bin/check-versions" ]; then
    echo ""
    echo ">>> Running: php bin/check-versions"
    echo "------------------------------------------"
    php bin/check-versions || echo "⚠️  check-versions failed with exit code $?"
fi

# Run check-php-extensions
if [ -f "bin/check-php-extensions" ]; then
    echo ""
    echo ">>> Running: php bin/check-php-extensions"
    echo "------------------------------------------"
    php bin/check-php-extensions || echo "⚠️  check-php-extensions failed with exit code $?"
fi

# Run detect-symfony-version
if [ -f "bin/detect-symfony-version" ]; then
    echo ""
    echo ">>> Running: php bin/detect-symfony-version"
    echo "------------------------------------------"
    php bin/detect-symfony-version || echo "⚠️  detect-symfony-version failed with exit code $?"
fi

# Run phpunit if vendor exists
if [ -z "$SKIP_VENDOR_CHECKS" ] && [ -f "vendor/bin/phpunit" ]; then
    echo ""
    echo ">>> Running: vendor/bin/phpunit"
    echo "------------------------------------------"
    vendor/bin/phpunit || echo "⚠️  phpunit failed with exit code $?"
else
    echo ""
    echo "⚠️  Skipping phpunit (not found or vendor checks disabled)"
fi

# Run phpstan if vendor exists
if [ -z "$SKIP_VENDOR_CHECKS" ] && [ -f "vendor/bin/phpstan" ]; then
    echo ""
    echo ">>> Running: vendor/bin/phpstan"
    echo "------------------------------------------"
    vendor/bin/phpstan || echo "⚠️  phpstan failed with exit code $?"
else
    echo ""
    echo "⚠️  Skipping phpstan (not found or vendor checks disabled)"
fi

echo ""
echo "=========================================="
echo "Startup checks completed!"
echo "=========================================="
echo ""

# Start Apache in the foreground
exec apache2-foreground

