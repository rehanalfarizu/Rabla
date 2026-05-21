#!/bin/bash
set -e

# Build Vue frontend
cd /app/frontend

# Generate .env.production from Heroku config vars
cat > .env.production << EOF
VITE_API_URL=${VITE_API_URL}
VITE_FIREBASE_API_KEY=${VITE_FIREBASE_API_KEY}
VITE_FIREBASE_AUTH_DOMAIN=${VITE_FIREBASE_AUTH_DOMAIN}
VITE_FIREBASE_PROJECT_ID=${VITE_FIREBASE_PROJECT_ID}
VITE_FIREBASE_STORAGE_BUCKET=${VITE_FIREBASE_STORAGE_BUCKET}
VITE_FIREBASE_MESSAGING_SENDER_ID=${VITE_FIREBASE_MESSAGING_SENDER_ID}
VITE_FIREBASE_APP_ID=${VITE_FIREBASE_APP_ID}
EOF

npm install
npm run build

# Copy built files to Laravel public folder
rm -rf /app/public/*
cp -r /app/frontend/dist/* /app/public/

# Go back to backend
cd /app

# Create storage directories
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs

# Make firebase credentials available (base64 encoded in config)
if [ -n "$FIREBASE_CREDENTIALS_BASE64" ]; then
    echo "$FIREBASE_CREDENTIALS_BASE64" | base64 -d > firebase/service-account.json
fi

# Start PHP
php artisan serve --host=0.0.0.0 --port=$PORT