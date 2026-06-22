# Stage 1: Build frontend assets using Node
FROM node:20-alpine AS builder
WORKDIR /app
COPY package*.json ./
RUN npm ci || npm install
COPY . .
RUN npm run build

# Stage 2: Production PHP/Nginx environment
FROM serversideup/php:8.3-fpm-nginx-alpine

WORKDIR /var/www/html

# Switch to root to configure permissions
USER root

# Copy application files
COPY . .

# Copy compiled frontend assets from builder stage
COPY --from=builder /app/public/build ./public/build

# Install dependencies using Composer
RUN composer install --no-interaction --no-ansi --no-progress --optimize-autoloader --no-dev

# Set permissions for storage & bootstrap cache
RUN mkdir -p storage bootstrap/cache && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 775 storage bootstrap/cache

# Switch to unprivileged user
USER www-data

# Expose default port
EXPOSE 8080
