FROM php:8.4-fpm

# 必要なパッケージのインストール
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    nginx

# PHP拡張のインストール
RUN docker-php-ext-install pdo_mysql gd

# Composerのインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ソースコードのコピー
WORKDIR /var/www
COPY . .

# ライブラリのインストール
RUN composer install --no-dev --optimize-autoloader

# 権限の設定
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# サーバー起動用コマンド
CMD service nginx start && php-fpm