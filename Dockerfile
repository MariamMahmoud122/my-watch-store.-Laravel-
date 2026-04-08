# نختار نسخة PHP المناسبة
FROM php:8.2-fpm

# تثبيت الإضافات اللي لارافل بيحتاجها
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl

# تثبيت إضافات PHP للداتابيز
RUN docker-php-ext-install pdo_mysql gd

# تحديد مكان الشغل جوه السيرفر
WORKDIR /var/www

# نسخ ملفات المشروع للسيرفر
COPY . .

# تثبيت الـ Composer (مدير المكتبات)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# إعطاء صلاحيات للمجلدات المهمة
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# تشغيل السيرفر على بورت 8080 (المناسب للمواقع المجانية)
EXPOSE 8080

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]