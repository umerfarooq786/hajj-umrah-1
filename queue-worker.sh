#!/bin/bash

# Path to your project
PROJECT_PATH="/mnt/c/xampp/htdocs/hajj-ummrah"

# Navigate to project directory
cd $PROJECT_PATH

# Run Laravel queue worker
/usr/bin/php artisan queue:work >> storage/logs/queue_worker.log 2>&1