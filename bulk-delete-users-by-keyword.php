<?php
/*
Plugin Name: Bulk Delete Users by Keyword
Description: This plugin allows you to bulk delete WordPress users based on a specified keyword.
Version: 1.0
Author: Sheikh MiZan (Shiek Md Anwar Hussain Mizan)
Author URI: https://sheikhmizan.com
Requires at least: 4.7
Tested up to: 6.6.1
Requires PHP: 7.0
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// Ensure the code is not executed outside of WordPress.
defined('ABSPATH') || exit;

class BDUBK_Bulk_Delete_Users {

    public function __construct() {
        add_action('admin_menu', [$this, 'bdubk_custom_admin_page']);
        add_action('admin_init', [$this, 'bdubk_process_bulk_delete']);
        add_action('admin_enqueue_scripts', [$this, 'bdubk_enqueue_admin_styles']);
    }

    // Enqueue admin styles
    public function bdubk_enqueue_admin_styles($hook_suffix) {
        if ($hook_suffix === 'toplevel_page_bdubk_bulk_delete_users') {
            wp_enqueue_style('bdubk-admin-styles', plugin_dir_url(__FILE__) . 'css/bdubk-admin-styles.css', [], '1.0');
        }
    }

    // Add admin menu
    public function bdubk_custom_admin_page() {
        add_menu_page(
            'Bulk Delete Users by Keyword',
            'Bulk Delete Users',
            'manage_options',
            'bdubk_bulk_delete_users',
            [$this, 'bdubk_render_keyword_settings_page'],
            'dashicons-trash'
        );
    }

    // Render settings page
    public function bdubk_render_keyword_settings_page() {
        ?>
        <div class="wrap">
            <h2><?php esc_html_e('Bulk Delete Users by Keyword', 'bdubk'); ?></h2>

            <?php
            // Display notices if any
            settings_errors('bdubk_bulk_delete_users');
            ?>

            <form method="post" action="">
                <?php
                wp_nonce_field('bdubk_bulk_delete_users_action', 'bdubk_bulk_delete_users_nonce');
                ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><?php esc_html_e('Keyword', 'bdubk'); ?></th>
                        <td><input type="text" name="bdubk_keyword" value="" class="regular-text" /></td>
                    </tr>
                </table>
                <?php submit_button(__('Bulk Delete Users', 'bdubk')); ?>
            </form>

            <div class="warning">
                <h2><?php esc_html_e('Warning!', 'bdubk'); ?></h2>
                <p><?php esc_html_e('Deleting users will permanently remove them from the database. Proceed with caution. It\'s recommended to backup your database before performing bulk deletion.', 'bdubk'); ?></p>
            </div>
        </div>
        <?php
    }

    // Process bulk delete
    public function bdubk_process_bulk_delete() {
        if (isset($_POST['bdubk_bulk_delete_users_nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['bdubk_bulk_delete_users_nonce'])), 'bdubk_bulk_delete_users_action')) {
            $keyword = isset($_POST['bdubk_keyword']) ? sanitize_text_field(wp_unslash($_POST['bdubk_keyword'])) : '';
            if (!empty($keyword)) {
                $this->bdubk_delete_users_by_keyword($keyword);
            }
        }
    }

    // Delete users by keyword
    private function bdubk_delete_users_by_keyword($keyword) {
        global $wpdb;
        $users = get_users(['search' => '*' . esc_attr($keyword) . '*', 'search_columns' => ['user_login', 'user_nicename', 'display_name', 'user_email']]);

        if (!empty($users)) {
            foreach ($users as $user) {
                wp_delete_user($user->ID);
            }
            $deleted_count = count($users);
            // Translators: %d is the number of users deleted.
            add_settings_error('bdubk_bulk_delete_users', 'bdubk_bulk_delete_users_notice', sprintf(__('%d users deleted successfully.', 'bdubk'), $deleted_count), 'updated');
        } else {
            add_settings_error('bdubk_bulk_delete_users', 'bdubk_bulk_delete_users_notice', __('No users found with the specified keyword.', 'bdubk'), 'error');
        }
    }
}

new BDUBK_Bulk_Delete_Users();