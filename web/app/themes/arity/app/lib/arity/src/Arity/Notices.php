<?php

declare(strict_types=1);

namespace Arity;

class Notices
{
    public static function error($message = '', $subtitle = '', $title = '', $type = 'error')
    {
        self::themeError($message, $subtitle, $title);
        self::adminNotice($message, $subtitle, $title, $type);
    }

    public static function success($message = '', $subtitle = '', $title = '', $type = 'success')
    {
        self::adminNotice($message, $subtitle, $title, $type);
    }

    public static function notice($message = '', $subtitle = '', $title = '', $type = 'error')
    {
        if ($type != 'error') {
            self::success($message, $subtitle, $title);
        } else {
            self::error($message, $subtitle, $title);
        }
    }

    public static function adminNotice($message = '', $subtitle = '', $title = '', $type = 'error')
    {
        $admin_notice = function () use ($message, $title, $type) {
            $class = 'notice notice-' . $type;
            $title = $title ? $title . ' - ' : '';
            printf('<div class="%1$s"><p>%2$s%3$s</p></div>', esc_attr($class), esc_html($title), esc_html($message));
        };

        add_action('admin_notices', $admin_notice);
    }

    public static function themeError($message = '', $subtitle = '', $title = '')
    {
        if (self::isAdminLoginOrRegisterPage()) {
            return;
        }

        $title = $title ?: __('Theme &rsaquo; Error', config('textdomain'));
        $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p>";
        wp_die($message, $title);
    }

    private static function isAdminLoginOrRegisterPage()
    {
        global $pagenow;
        return is_admin() || in_array($pagenow, ['wp-login.php', 'wp-register.php']);
    }
}
