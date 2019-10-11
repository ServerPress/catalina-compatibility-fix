<?php

// Only on mac, ds version 3.9.3, look for update_server event
global $ds_runtime;
if ( PHP_OS !== 'Darwin' ) return;
if ( false === $ds_runtime->last_ui_event ) return;
if ( 'update_server' != $ds_runtime->last_ui_event->action ) return;
if ( json_decode( file_get_contents( '/Users/Shared/.com.serverpress.desktopserver.json' ) )->version  !== "3.9.3") return;

// Force apache out of memory
$r = shell_exec("kill -9 $(ps aux | grep '/Applications/XAMPP/xamppfiles/bin/[h]ttpd' | awk '{print $2}')");

// Copy over xdebug with catalina support
copy("/Applications/XAMPP/ds-plugins/catalina-compatibility-fix/xdebug.so",
    "/Applications/XAMPP/xamppfiles/lib/php/extensions/no-debug-non-zts-20180731/xdebug.so");
