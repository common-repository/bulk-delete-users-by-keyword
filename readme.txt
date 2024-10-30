=== Bulk Delete Users by Keyword ===
Contributors: sheikhmizanbd
Tags: bulk delete, delete users, keyword-based deletion, user management
Requires at least: 4.0
Tested up to: 6.6.1
Stable tag: 1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Easily bulk delete WordPress users by filtering them based on a specified keyword.

== Description ==

The **Bulk Delete Users by Keyword** plugin provides an easy way to manage user cleanup in WordPress by allowing you to bulk delete users based on a specific keyword. Whether you need to manage users for better performance, remove spam accounts, or clean up your database, this plugin makes it simple.

**Main Features:**
- Bulk delete users by filtering their usernames or display names using a specific keyword.
- Intuitive custom admin interface for keyword input and management.
- Displays a warning message to ensure users are aware that this action cannot be undone.

**How It Works:**
1. Set the keyword on the custom admin page to filter users for deletion.
2. Click the "Bulk Delete" button to initiate the process.
3. All users whose usernames or display names contain the specified keyword will be permanently deleted from your WordPress database.

This plugin is ideal for administrators who need to remove inactive or spam users quickly and efficiently.

== Features ==
- **Keyword-based User Deletion:** Quickly delete multiple users whose usernames or display names match the specified keyword.
- **Custom Admin Page:** A simple settings page for managing the keyword used in bulk deletion.
- **Safe Execution:** Includes a confirmation prompt before deletion to avoid accidental removals.

== Installation ==

**From your WordPress Dashboard:**
1. Navigate to "Plugins > Add New".
2. Search for "Bulk Delete Users by Keyword".
3. Install and activate the plugin.

**From WordPress.org:**
1. Download the plugin ZIP file from the [plugin page](https://wordpress.org/plugins/bulk-delete-users-by-keyword).
2. In your WordPress admin, go to "Plugins > Add New > Upload Plugin".
3. Upload the ZIP file and click "Install Now".
4. After installation, click "Activate".

== Frequently Asked Questions ==

= Will this plugin delete users permanently? =
Yes. When users are deleted using this plugin, they are permanently removed from the database. Please be cautious when using the bulk delete functionality.

= Can I undo a bulk delete? =
No, this action is irreversible. Ensure you have backups of your database before performing a bulk deletion.

= How is the keyword matched? =
The keyword is matched against both the username and display name fields of users. If either field contains the keyword, the user will be selected for deletion.

== Screenshots ==

1. **Admin Settings Page:** The custom admin interface where you enter the keyword and manage user deletions.

== Changelog ==

= 1.0 =
- Initial release with keyword-based bulk user deletion.

== Upgrade Notice ==

= 1.0 =
Initial release. Install this version for easy bulk deletion of users based on a keyword.

== License ==

This plugin is licensed under the [GNU General Public License v2.0 or later](https://www.gnu.org/licenses/gpl-2.0.html).
