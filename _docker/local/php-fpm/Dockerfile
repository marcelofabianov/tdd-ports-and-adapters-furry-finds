FROM php:8.2-fpm

ENV TZ=America/Sao_Paulo
ENV DEBIAN_FRONTEND noninteractive

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN rm /etc/apt/preferences.d/no-debian-php && \
    apt-get update -yqq && \
    apt-get upgrade -y && \
    apt-get install -y --no-install-recommends \
    git \
    wget \
    curl \
    unzip \
    zip \
    zsh \
    nano \
    openssl \
    libpq-dev \
    libaio1 \
    libaio-dev \
    zlib1g-dev \
    libonig-dev \
    libzip-dev \
    libicu-dev \
    libssl-dev \
    libxml2-dev \
    libmemcached-dev \
    libodbc1 \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev

RUN docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql && \
    docker-php-ext-configure intl && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install \
    gd \
    intl \
    zip \
    mbstring \
    pcntl \
    sockets \
    exif \
    bcmath \
    soap \
    simplexml \
    pgsql \
    pdo_pgsql

RUN pecl install \
    redis \
    apcu \
    xdebug \
    swoole && \
    docker-php-ext-enable \
    xdebug \
    redis \
    opcache \
    swoole \
    apcu && \
    pecl clear-cache

COPY php.ini /usr/local/etc/php/

RUN curl -L -C - --progress-bar -o /usr/local/bin/composer https://getcomposer.org/composer.phar && \
    chmod 755 /usr/local/bin/composer && \
    useradd -m developer && \
    usermod -u 1000 developer

RUN composer self-update

RUN rm -rf /var/lib/apt/lists/* && \
    apt-get clean && \
    apt-get autoremove -y && \
    rm -rf /tmp/* /var/tmp/* && \
    chsh -s $(which zsh) developer

COPY --chown=developer:www-data . /var/www

RUN chown -R www-data /var/www && \
    chmod -R 775 /var/www && \
    chmod -R g+s /var/www && \
    find /var/www -type d -exec chmod 775 {} + && \
    find /var/www -type f -exec chmod 664 {} + && \
    rm -rf /var/www/html

USER developer

RUN curl -fsSL https://raw.githubusercontent.com/robbyrussell/oh-my-zsh/master/tools/install.sh | sh; zsh && \
    git clone https://github.com/zsh-users/zsh-autosuggestions.git /home/developer/.oh-my-zsh/plugins/zsh-autosuggestions && \
    git clone https://github.com/zsh-users/zsh-syntax-highlighting.git /home/developer/.oh-my-zsh/plugins/zsh-syntax-highlighting

RUN zsh

COPY .zshrc /home/developer/.zshrc

WORKDIR /var/www

EXPOSE 9000
EXPOSE 9003

CMD ["php-fpm"]