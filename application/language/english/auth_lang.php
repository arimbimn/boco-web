<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Name:  Auth Lang - English
 *
 * Author: Ben Edmunds
 * 		  ben.edmunds@gmail.com
 *         @benedmunds
 *
 * Author: Daniel Davis
 *         @ourmaninjapan
 *
 * Location: https://github.com/benedmunds/CodeIgniter-Ion-Auth
 *
 * Created:  03.09.2013
 *
 * Description:  English language file for Ion Auth example views
 *
 */

// Errors
$lang['error_csrf'] = 'This form post did not pass our security checks.';

// Login
$lang['login_heading']         = 'Login';
$lang['login_subheading']      = 'Please login with your email/username and password below.';
$lang['login_identity_label']  = 'Email/Username:';
$lang['login_password_label']  = 'Password:';
$lang['login_remember_label']  = 'Remember Me:';
$lang['login_submit_btn']      = 'Login';
$lang['login_forgot_password'] = 'Forgot your password?';

// Index
$lang['index_heading']           = 'Users';
$lang['index_subheading']        = 'Below is a list of the users.';
$lang['index_fname_th']          = 'First Name';
$lang['index_lname_th']          = 'Last Name';
$lang['index_email_th']          = 'Email';
$lang['index_gender_th']         = 'Gender';
$lang['index_groups_th']         = 'Groups';
$lang['index_status_th']         = 'Status';
$lang['index_action_th']         = 'Action';
$lang['index_active_link']       = 'Active';
$lang['index_inactive_link']     = 'Inactive';
$lang['index_create_user_link']  = 'Create a new user';
$lang['index_create_group_link'] = 'Create a new group';

// Deactivate User
$lang['deactivate_heading']                  = 'Deactivate User';
$lang['deactivate_subheading']               = 'Are you sure you want to deactivate the user \'%s\'';
$lang['deactivate_confirm_y_label']          = 'Yes:';
$lang['deactivate_confirm_n_label']          = 'No:';
$lang['deactivate_submit_btn']               = 'Submit';
$lang['deactivate_validation_confirm_label'] = 'confirmation';
$lang['deactivate_validation_user_id_label'] = 'user ID';

//Create Reseller
$lang['create_user_reseller_heading']   = 'Create Entrepreneurship';
$lang['login_heading_reseller']         = 'Login Entrepreneurship';

// Create User
$lang['create_user_heading']                           = 'Create User';
$lang['create_user_subheading']                        = 'Please enter the user\'s information below.';
$lang['create_user_fname_label']                       = 'First Name:';
$lang['create_user_lname_label']                       = 'Last Name:';
$lang['create_user_company_label']                     = 'Company Name:';
$lang['create_user_identity_label']                    = 'Identity:';
$lang['create_user_email_label']                       = 'Email:';
$lang['create_user_phone_label']                       = 'Phone:';
$lang['create_user_password_label']                    = 'Password:';
$lang['create_user_password_confirm_label']            = 'Confirm Password:';
$lang['create_user_submit_btn']                        = 'Create User';
$lang['create_user_validation_fname_label']            = 'First Name';
$lang['create_user_validation_lname_label']            = 'Last Name';
$lang['create_user_validation_identity_label']         = 'Identity';
$lang['create_user_validation_email_label']            = 'Email Address';
$lang['create_user_validation_phone_label']            = 'Phone';
$lang['create_user_validation_username_label']         = 'Username';
$lang['create_user_validation_company_label']          = 'Company Name';
$lang['create_user_validation_password_label']         = 'Password';
$lang['create_user_validation_password_confirm_label'] = 'Password Confirmation';
$lang['create_user_validation_tglahir_label']          = 'Birth Date Confirmation';
$lang['create_user_validation_referer_label']          = 'Referer';

// Edit User
$lang['edit_user_heading']                           = 'Edit User';
$lang['edit_user_subheading']                        = 'Please enter the user\'s information below.';
$lang['edit_user_fname_label']                       = 'First Name:';
$lang['edit_user_lname_label']                       = 'Last Name:';
$lang['edit_user_company_label']                     = 'Company Name:';
$lang['edit_user_email_label']                       = 'Email:';
$lang['edit_user_phone_label']                       = 'Phone:';
$lang['edit_user_password_label']                    = 'Password: (if changing password)';
$lang['edit_user_password_confirm_label']            = 'Confirm Password: (if changing password)';
$lang['edit_user_groups_heading']                    = 'Member of groups';
$lang['edit_user_submit_btn']                        = 'Save User';
$lang['edit_user_validation_fname_label']            = 'First Name';
$lang['edit_user_validation_lname_label']            = 'Last Name';
$lang['edit_user_validation_email_label']            = 'Email Address';
$lang['edit_user_validation_phone_label']            = 'Phone';
$lang['edit_user_validation_company_label']          = 'Company Name';
$lang['edit_user_validation_groups_label']           = 'Groups';
$lang['edit_user_validation_password_label']         = 'Password';
$lang['edit_user_validation_password_confirm_label'] = 'Password Confirmation';

// Create Group
$lang['create_group_title']                  = 'Create Group';
$lang['create_group_heading']                = 'Create Group';
$lang['create_group_subheading']             = 'Please enter the group information below.';
$lang['create_group_name_label']             = 'Group Name:';
$lang['create_group_desc_label']             = 'Description:';
$lang['create_group_submit_btn']             = 'Create Group';
$lang['create_group_validation_name_label']  = 'Group Name';
$lang['create_group_validation_desc_label']  = 'Description';

// Edit Group
$lang['edit_group_title']                  = 'Edit Group';
$lang['edit_group_saved']                  = 'Group Saved';
$lang['edit_group_heading']                = 'Edit Group';
$lang['edit_group_subheading']             = 'Please enter the group information below.';
$lang['edit_group_name_label']             = 'Group Name:';
$lang['edit_group_desc_label']             = 'Description:';
$lang['edit_group_submit_btn']             = 'Save Group';
$lang['edit_group_validation_name_label']  = 'Group Name';
$lang['edit_group_validation_desc_label']  = 'Description';

// Change Password
$lang['change_password_heading']                               = 'Change Password';
$lang['change_password_old_password_label']                    = 'Old Password:';
$lang['change_password_new_password_label']                    = 'New Password (at least %s characters long):';
$lang['change_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['change_password_submit_btn']                            = 'Change';
$lang['change_password_validation_old_password_label']         = 'Old Password';
$lang['change_password_validation_new_password_label']         = 'New Password';
$lang['change_password_validation_new_password_confirm_label'] = 'Confirm New Password';

// Forgot Password
$lang['forgot_password_heading']                 = 'Forgot Password';
$lang['forgot_password_subheading']              = 'Please enter your %s so we can send you an email to reset your password.';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = 'Submit';
$lang['forgot_password_validation_email_label']  = 'Email Address';
$lang['forgot_password_identity_label']          = 'Identity';
$lang['forgot_password_email_identity_label']    = 'Email';
$lang['forgot_password_email_not_found']         = 'No record of the email address.';
$lang['forgot_password_identity_not_found']      = 'No record of theusername.';

// Reset Password
$lang['reset_password_heading']                               = 'Change Password';
$lang['reset_password_new_password_label']                    = 'New Password (at least %s characters long):';
$lang['reset_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['reset_password_submit_btn']                            = 'Change';
$lang['reset_password_validation_new_password_label']         = 'New Password';
$lang['reset_password_validation_new_password_confirm_label'] = 'Confirm New Password';

$lang['birth_date'] = 'Birth Date';
$lang['email_refer_user'] = 'REFERRER (USERNAME/EMAIL)';
$lang['lewatkan'] = 'Next';
$lang['desc_login'] = 'Sign up for a free account at our store. Registration is quick and easy. It allows you to be able to order from our shop. To start shopping click register.';
$lang['first_name'] = 'First Name';
$lang['last_name'] = 'Last Name';
$lang['phone'] = 'Phone';
$lang['password'] = 'Password';
$lang['confirm_password'] = 'Confirm Password';
$lang['referrer_user'] = 'referrer user';
$lang['placeholder_refferrer_email_username'] = 'Enter email or username';
$lang['submit_button'] = 'Submit';
$lang['skip_button'] = 'Skip';

$lang['comment_sent_success'] = 'Successfully sent your comment';
$lang['error_occured'] = 'Sorry, an error occured. Please try again.';
$lang['quantity_more_than_0'] = 'Quantity should be more than 0';
$lang['cart_added'] = 'Successfully added product to cart';
$lang['cart_deleted'] = 'Successfully deleted product to cart';
$lang['cart_updated'] = 'Successfully updated product to cart';
$lang['no_product_cart'] = 'No product in cart';
$lang['no_referr_to_self'] = ' You can not put your username/email as referral';
$lang['referral_email_not_found'] = 'Referral email/username is not found';
$lang['success_exchange'] = 'Successfully sent your exchange request';
$lang['invalid_email_newsletter'] = 'Invalid email address!';
$lang['success_newsletter'] = 'Your email address has been successfully added!';
$lang['registered_newsletter'] = 'Your email address is already registered!';
$lang['language_change'] = 'Successfully change language';
$lang['compare_product_existed'] = 'This product already exists on compare list.';
$lang['compare_product_removed'] = 'Product is successfully removed from compare list.';
$lang['review_added'] = 'Review is successfully added.';
$lang['already_put_referral'] = 'You already referr a user';
$lang['referr_sucess'] = 'Successfully set referrer link, continue shopping';
$lang['referr_not_found'] = 'Referrer link is not found';
$lang['request_refund_success'] = 'Successfully sent request refund';
$lang['success_referr'] = 'Successfully added user referral';
$lang['exist_product_wishlist'] = 'This product already exists on wishlist';

$lang['success_add_wishlist'] = 'Successfully added product to wishlist';
$lang['success_deleted_wishlist'] = 'Successfully deleted product from wishlist';
$lang['failed_deleted_wishlist'] = 'Failed deleted product from wishlist';

$lang['not_allowed_delete_notification'] = 'Not allow to delete notification';
$lang['notification_deleted'] = 'Successfully deleted notification';

$lang['voucher_not_available'] = 'Voucher is not available';

$lang['minimum_purchase_1'] = 'Minimum item purchase to use this voucher : ';

$lang['referrer_voucher_message'] = 'This voucher can be used if you already have more than 1 user that put you as referral';

$lang['birthday_voucher_message'] = 'This voucher is available for you in your birthday month';

$lang['birthday_voucher_message_2'] = 'You already used birthday voucher for this year';

$lang['voucher_code_not_available'] = 'Voucher code is not available';

$lang['vip_voucher_not_avail'] = 'User with VIP voucher username is not available';

$lang['cant_use_vip_voucher'] = 'VIP voucher has been fully redeemed ';


$lang['user_redemption_404'] = 'User with email/username voucher redemption is not available';

$lang['user_redemption_cant'] = 'Voucher has been fully redeemed or referrer user is not found';

$lang['voucher_already_used'] = 'This voucher has been fully redeemed';

$lang['member_not_valid'] = 'Member is invalid';

$lang['success_use_voucher'] = 'Successfully added voucher';

$lang['voucher_invalid_for_product'] = 'Voucher can not be used for this product';

$lang['renewal_voucher'] = 'For renew this voucher, you need to have finished total purchase for IDR 20.000.000 ,-';

$lang['desc_formreffer'] = "insert the username of the person who refers this program to you";