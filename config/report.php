<?php
/**
 * Created by PhpStorm.
 * User: LinHuiMin
 * Date: 16/4/2016
 * Time: 12:21
 */

return [

    /*
     * Reports table used to store reports
     */
    'reports_table' => 'ms_reports',

    /*
     * Report model used by Report to create correct relations. Update the report if it is in a different namespace.
    */
    'report' => App\Models\Report\Report::class,

    /*
     * user_subscriptions table used by Report to save relationship between users and reports to the database.
     */
    'user_subscriptions_table' => 'ms_user_subscriptions',

    /*
    * UserSubscription model used by Report to create correct relations.
    * Update the user_subscription if it is in a different namespace.
    */
    'user_subscription' => App\Models\Access\User\UserSubscription::class,

    /*
    * Snapshots table used by Access to save snapshots to the database.
    */
    'snapshots_table' => 'ms_report_snapshots',

    /*
    * ReportSnapshot model used by Access to create correct relations.
    * Update the report_snapshot if it is in a different namespace.
    */
    'report_snapshot' => App\Models\Report\ReportSnapshot::class,

    /*
     * 'report_group table used by Access to save permissions to the database.
     */
    'report_group_table' => 'ms_report_groups',

    /*
    * ReportGroup model used by Report to create correct relations.
    * Update the report_group if it is in a different namespace.
    */
    'report_group' => App\Models\Report\ReportGroup::class,

    /*
     * report_parameter table used by Report to save ReportParameter to the database.
     */
    'report_parameter_table' => 'ms_report_parameters',

    /*
    * ReportParameter model used by Report to create correct relations.
    * Update the report_parameter if it is in a different namespace.
    */
    'report_parameter' => App\Models\Report\ReportParameter::class,

    /*
     * Configurations for the report
     */
    'reports' => [
        /*
         * Reports tables
         */
        'default_per_page' => 25,

        /*
         * The report default format
         */
        'default_format' => 'XLS',

        /*
        * The report format type
        */
        'format_type' => ['XLS', 'PDF', 'JPG', 'PNG'],

        /*
         * The report default receive mode
         */
        'default_receive_mode' => 'email',

        /*
        * The report receive_mode
        */
        'receive_mode' => ['wechat', 'email'],


        /*
         * Whether or not the user has to confirm their email when signing up
         */
        'confirm_email' => true,

        /*
         * Whether or not the users email can be changed on the edit profile screen
         */
        'change_email' => false,
    ],

    /*
     * Configuration for roles
     */
    'reports' => [
        /*
         * Whether a report must contain a parameter or can be used standalone as a label
         */
        'report_must_contain_parameter' => false
    ],

];