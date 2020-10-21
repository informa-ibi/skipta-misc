=== Fillable PDFs for Gravity Forms ===
Contributors: travislopes
Tags: pdf, gravity forms
Requires at least: 4.2
Tested up to: 4.7.5
License: GPL-3.0+
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Generate PDFs from form submissions and create forms from PDFs.

= Requirements =

1. [Purchase and install Gravity Forms](https://forgravity.com/gravityforms)
2. WordPress 4.2+
3. Gravity Forms 1.9.14+

= Support =

If you have any problems, please contact support: https://forgravity.com/support/

== Installation ==

1.  Download the zipped file.
1.  Extract and upload the contents of the folder to your /wp-contents/plugins/ folder.
1.  Navigate to the WordPress admin Plugins page and activate the "Fillable PDFs for Gravity Forms" plugin.

== ChangeLog ==

= Version 2.3.3 (2020-07-23) =
- Fixed a fatal error when trying to download a PDF while the fileinfo PHP extension is disabled.
- Fixed an issue where List column values would not populate if a slash was used in the column name.

= Version 2.3.2 (2020-06-16) =
- Added support for Gravity Forms Conditional Shortcode.
- Fixed an issue where input labels do not appear in the mapping drop down.
- Fixed PHP notice when mapping to Date field.
- Removed usage of deprecated get_magic_quotes_gpc() function.

= Version 2.3.1 (2020-06-04) =
- Fixed an issue with PDFs not being attached to notifications.

= Version 2.3 (2020-06-03) =
- Added block to display list of generated PDFs on frontend.
- Added capabilities check for Generated PDFs metabox.
- Added "fg_fillablepdfs_base_path" filter to modify the base folder where generated PDFs are stored.
- Added "fg_fillablepdfs_force_download" filter to allow for PDFs to be displayed inline.
- Added "fg_fillablepdfs_form_path" filter to modify the folder where generated PDFs are stored for a form.
- Added "fg_fillablepdfs_logged_out_timeout" filter to set how many minutes logged out user has to download generated PDF.
- Added "fg_fillablepdfs_view_pdf_capabilities" filter to set capabilities required to view PDF.
- Added GravityView field to display generated PDF links within a View.
- Added notice when generated PDFs folder is publicly accessible.
- Added support for downloading original template files.
- Added support for embedding GFChart charts.
- Added support for exporting and importing Fillable PDFs feeds.
- Added support for replacing existing template file.
- Added "url_signed" modifier for {fillable_pdfs} merge tag.
- Updated Download Permissions setting to Enable Public Address.
- Updated imported form to have default notification.
- Fixed checkbox choices not saving correctly when importing PDF.
- Fixed file name not updating when regenerating PDF.
- Fixed individual Date inputs not populating PDF.
- Fixed plugin settings page not appearing in certain scenarios.
- Fixed visual mapper being unresponsive on forms with more than one hundred fields.
- Removed unused HTTP timeout filter.

= Version 2.2 (2019-09-18) =
- Added support for annual pricing plans.
- Added support for global templates.
- Updated custom value mapping to support multiline PDF fields.
- Fixed PDF field not populating when using multiple brackets in field name.

= Version 2.1 (2019-07-09) =
- Added support for mapping to List fields.
- Fixed Date not being populated using selected date format.
- Fixed Entry Date not using the defined time zone.
- Fixed entry meta not appearing in PDF field values.
- Fixed field mapper not loading when a PDF field has been mapped to a deleted Gravity Forms field.
- Fixed Javascript error when uploading a new template.
- Fixed merge tag not being replaced when no PDFs are found for feed.
- Fixed PDF downloads being corrupted in certain scenarios.
- Fixed template mapper not opening when React dependency could not be loaded.
- Fixed template mapper not opening when using multiple lines for custom values.
- Fixed Time not being populated based on individual inputs.
- Updated Gravity Forms field deletion process to remove PDF field mappings containing field.

= Version 2.0 (2019-01-28) =
- Added a new visual interface for mapping Gravity Forms fields to PDF fields.
- Added support for embedding images and signatures in PDF fields.
- Added support for Gravity Forms Personal Data tools.
- Added support for regenerating PDFs for existing entries.
- Updated template creation to populate template name upon selecting file.

= Version 1.0.5 =
- Fixed Gravity Flow step not loading properly.

= Version 1.0.4 =
- Added support for Gravity Forms 2.3.

= Version 1.0.3 =
- Added support for attaching PDFs when resending notifications.

= Version 1.0.2 =
- Added default file name.
- Added support for monthly overages.

= Version 1.0.1 =
- Fixed incorrect add new template link after deleting a template.

= Version 1.0 =
- It's all new!
