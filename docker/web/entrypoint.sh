#!/bin/bash
set -e

echo "=========================================="
echo "Running startup checks..."
echo "=========================================="

# Change to the application directory
cd /var/www

# Run check-versions
echo ""
echo ">>> Running: php bin/check-versions"
echo "------------------------------------------"
php bin/check-versions || echo "check-versions failed with exit code $?"

# Run check-php-extensions
echo ""
echo ">>> Running: php bin/check-php-extensions"
echo "------------------------------------------"
php bin/check-php-extensions || echo "check-php-extensions failed with exit code $?"

# Run phpunit
echo ""
echo ">>> Running: vendor/bin/phpunit"
echo "------------------------------------------"
vendor/bin/phpunit || echo "phpunit failed with exit code $?"

# Run phpstan
echo ""
echo ">>> Running: vendor/bin/phpstan"
echo "------------------------------------------"
vendor/bin/phpstan || echo "phpstan failed with exit code $?"

echo ""
echo "=========================================="
echo "Startup checks completed!"
echo "=========================================="
echo ""

# Start Apache in the foreground
exec apache2-foreground

