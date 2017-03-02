<?php
/**
 * Plugin Name: Maintenance mode
 * Plugin URI: https://github.com/sboerrigter/maintenance-mode/
 * Description: Really simple WordPress maintenance mode plugin to (temporary) take a website offline with a proper 503 status. Logged in users will be able to see the webite. No fancy admin screens, just activate the plugin and it works.
 * Author: Sjoerd Boerrigter
 * Author URI: https://github.com/sboerrigter/
 *
 * Version: 0.1.0
 */

namespace Sboerrigter\MaintenanceMode;

class Maintenance
{
    public function init()
    {
        add_action('init', [$this, 'checkCapabilities']);
    }

    public function checkCapabilities()
    {
        if (! current_user_can('edit_posts')) {
            $this->activate();
        }
    }

    private function activate()
    {
        $title = 'Temporary down';
        $content = 'This website is temporary down for maintenance.';
        $args = [
            'response' => 503
        ];

        wp_die($content, $title, $args);
    }
}

$maintenance = new Maintenance();
$maintenance->init();
