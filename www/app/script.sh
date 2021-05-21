#!/bin/bash
echo apachecms_frontend_dinamic_$1: >> $2  
echo '    'path: /$1/{slug} >> $2
echo '    'defaults: { _controller: ApachecmsFrontendBundle:Default:land } >> $2
chmod -R 777 ../var/logs/
chmod -R 777 ../var/cache/
php ../bin/console cache:clear --env prod
php ../bin/console cache:clear --env dev
chmod -R 777 ../var/logs/
chmod -R 777 ../var/cache/
