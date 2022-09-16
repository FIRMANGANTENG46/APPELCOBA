set -e

echo "Deploying application ..."

# Enter maintenance mode
(php artisan down --message 'Deploying new version of the application') || true

    # Update codebase
    git pull origin master
# Exit maintenance mode
php artisan up

echo "Application deployed!"    

