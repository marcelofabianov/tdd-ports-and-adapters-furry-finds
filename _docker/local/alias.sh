alias furry='cat alias.sh'
alias furry.up='docker compose up -d'
alias furry.down='docker compose down'
alias furry.restart='docker compose restart'
alias furry.ps='docker compose ps'
alias furry.logs='docker compose logs -f'
alias furry.build='docker compose build'
alias furry.rebuild='docker compose build --no-cache'
alias furry.zsh='docker exec -it furry_app zsh'
alias furry.exec='docker exec -it furry_app'
alias furry.php='docker exec -it furry_app php'
alias furry.composer='docker exec -it furry_app composer'
alias furry.test='furry.php ./vendor/bin/pest'
alias furry.coverage='furry.test --coverage'
alias furry.type-coverage='furry.test --type-coverage'
alias furry.phpstan='furry.php vendor/bin/phpstan analyse'
alias furry.phpcs='furry.php ./vendor/bin/phpcs --standard=PSR12'
alias furry.phpcbf='furry.php ./vendor/bin/phpcs --standard=PSR12'