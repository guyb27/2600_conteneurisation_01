#!/bin/bash

# Chemin optionnel vers les fichiers de log
LOG_DIR="/var/log"

echo "Démarrage de PHP-FPM..."
php-fpm -D
# ou `php-fpm` si vous avez une seule version installée

echo "Démarrage de Nginx..."
nginx -g 'daemon off;'

echo "✅ Serveur démarré !"
echo "🌐 Accédez à votre site : http://localhost:8080"