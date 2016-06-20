<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMicroSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Access Tables===========================================================================Begin*/
        //Table:ms_users
        Schema::create(config('access.users_table'), function (Blueprint $table) {
            $table->increments('user_id')->unsigned();
            $table->string('user_name', 50);
            $table->string('user_nick', 50);
            $table->string('email', 60)->unique();
            $table->string('password', 60);
            $table->tinyInteger('status')->default(1)->unsigned();
            $table->string('weixin_id', 60);
            $table->string('confirmation_code');
            $table->boolean('confirmed')->default(config('access.users.confirm_email') ? false : true);
            $table->rememberToken();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');
            $table->softDeletes();
            $table->timestamp('login_at')->nullable();
            $table->string('login_ip', 20)->nullable();
            $table->string('remark', 100)->nullable();
        });

        //Table:ms_roles
        Schema::create(config('access.roles_table'), function (Blueprint $table) {
            $table->increments('role_id')->unsigned();
            $table->string('role_name', 30)->unique();
            $table->boolean('all_permission')->default(false);
            $table->smallInteger('sort_order')->default(0)->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');
        });

        //Table:ms_assigned_roles
        Schema::create(config('access.assigned_roles_table'), function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();

            /**
             * Add Foreign/Unique/Index
             */
            $table->foreign('user_id')
                ->references('user_id')
                ->on(config('access.users_table'))
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('role_id')
                ->on(config('access.roles_table'))
                ->onDelete('cascade');
        });

        //Table:ms_permissions
        Schema::create(config('access.permissions_table'), function (Blueprint $table) {
            $table->increments('permission_id')->unsigned();
            $table->integer('group_id')->nullable()->unsigned();
            $table->string('name', 50)->unique();
            $table->string('display_name', 50);
            $table->boolean('system')->default(false);
            $table->smallInteger('sort_order')->default(0)->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');
        });

        //Table:ms_permission_dependencies
        Schema::create(config('access.permission_dependencies_table'), function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->integer('dependency_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');

            /**
             * Add Foreign/Unique/Index
             */
            $table->foreign('permission_id')
                ->references('permission_id')
                ->on(config('access.permissions_table'))
                ->onDelete('cascade');

            $table->foreign('dependency_id')
                ->references('permission_id')
                ->on(config('access.permissions_table'))
                ->onDelete('cascade');
        });

        //Table:ms_permission_groups
        Schema::create(config('access.permission_group_table'), function (Blueprint $table) {
            $table->increments('group_id')->unsigned();
            $table->integer('parent_id')->nullable();
            $table->string('name', 50);
            $table->smallInteger('sort_order')->default(0)->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');
        });

        //Table:ms_user_permissions
        Schema::create(config('access.permission_user_table'), function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->integer('user_id')->unsigned();

            /**
             * Add Foreign/Unique/Index
             */
            $table->foreign('permission_id')
                ->references('permission_id')
                ->on(config('access.permissions_table'))
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('user_id')
                ->on(config('access.users_table'))
                ->onDelete('cascade');
        });

        //Table:ms_role_permissions
        Schema::create(config('access.permission_role_table'), function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            /**
             * Add Foreign/Unique/Index
             */
            $table->foreign('permission_id')
                ->references('permission_id')
                ->on(config('access.permissions_table'))
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('role_id')
                ->on(config('access.roles_table'))
                ->onDelete('cascade');
        });

        //Table:ms_social_logins
        Schema::create('ms_social_logins', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on(config('access.users_table'))->onDelete('cascade');
            $table->string('provider', 32);
            $table->string('provider_id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');
        });

        //Table:password_resets
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        /*Access Tables===========================================================================End*/

        /*Report Tables============================================================================Begin*/
        //Table:ms_reports
        Schema::create(config('report.reports_table'), function (Blueprint $table) {
            $table->increments('report_id')->unsigned();
            $table->string('report_no', 10)->unique();
            $table->integer('group_id')->nullable()->unsigned();
            $table->string('name', 100)->unique();
            $table->string('format', 20);
            $table->string('schedule', 100)->nullable();
            $table->tinyInteger('status')->default(1)->unsigned();
            $table->enum('allow_subscribe', ['true', 'false']);
            $table->enum('allow_query', ['true', 'false']);
            $table->string('receive_mode', 50)->nullable();
            $table->string('query_url', 200)->nullable();
            $table->string('description', 200)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');
        });

        //Table:ms_report_groups
        Schema::create(config('report.report_group_table'), function (Blueprint $table) {
            $table->increments('group_id')->unsigned();
            $table->integer('parent_id')->nullable();
            $table->string('name', 50);
            $table->smallInteger('sort_order')->default(0)->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');
        });

        //Table:ms_report_snapshots
        Schema::create(config('report.snapshots_table'), function (Blueprint $table) {
            $table->increments('snapshot_id')->unsigned();
            $table->integer('report_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('expiration_at')->nullable();
            $table->string('file_name', 50)->nullable();
            $table->string('file_path', 200)->nullable();
            $table->string('file_type',10);
            $table->tinyInteger('status');
            $table->string('abstract', 200)->nullable();
            $table->string('client_ip', 50)->nullable();

            /**
             * Add Foreign/Unique/Index
             */

            $table->foreign('report_id')
                ->references('report_id')
                ->on(config('report.reports_table'))
                ->onDelete('cascade');
        });

        //Table:ms_report_parameters
        Schema::create(config('report.report_parameter_table'), function (Blueprint $table) {
            $table->increments('parameter_id')->unsigned();
            $table->integer('report_id')->unsigned();
            $table->string('name', 50);
            $table->string('display_name', 50);
            $table->string('data_type', 20);
            $table->enum('nullable', ['true', 'false'])->default('false');
            $table->enum('multi_value', ['true', 'false']);
            $table->string('default_value', 100);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');

            /**
             * Add Foreign/Unique/Index
             */

            $table->foreign('report_id')
                ->references('report_id')
                ->on(config('report.reports_table'))
                ->onDelete('cascade');
        });

        //Table:ms_user_subscriptions
        Schema::create(config('report.user_subscriptions_table'), function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('report_id')->unsigned();
            $table->tinyInteger('subscribe_status')->default(0)->unsigned();
            $table->timestamp('subscribe_time')->nullable();
            $table->string('receive_mode', 50)->nullable();

            /**
             * Add Foreign/Unique/Index
             */

            $table->foreign('user_id')
                ->references('user_id')
                ->on(config('access.users_table'))
                ->onDelete('cascade');

            $table->foreign('report_id')
                ->references('report_id')
                ->on(config('report.reports_table'))
                ->onDelete('cascade');

        });
        /*Report Tables==============================================================================End*/

        /*WeChat Tables============================================================================Begin*/
        //Table:ms_weixin_fans
        Schema::create('ms_weixin_fans', function (Blueprint $table) {
            $table->increments('weixin_id')->unsigned();
            $table->integer('open_id')->unsigned();
            $table->timestamp('subscribe_time')->nullable();
            $table->string('nick_name', 50)->nullable();
            $table->tinyInteger('gender')->unsigned();
            $table->string('language', 50)->nullable();
            $table->string('country', 30)->nullable();
            $table->string('province', 30)->nullable();
            $table->string('city', 30)->nullable();
            $table->string('head_image_url', 255)->nullable();
            $table->tinyInteger('status')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('remark', 50)->nullable();
        });

        //Table:ms_weixin_messages
        Schema::create('ms_weixin_messages', function (Blueprint $table) {
            $table->increments('msg_id')->unsigned();
            $table->string('msg_type', 20);
            $table->string('input_code', 20)->nullable();
            $table->string('rule', 20)->nullable();
            $table->Integer('read_count')->unsigned()->default(0)->nullable();
            $table->Integer('favour_count')->unsigned()->default(0)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        /*WeChat Tables==============================================================================End*/

        /*System Tables============================================================================Begin*/
        //Table:ms_configurations
        Schema::create('ms_configurations', function (Blueprint $table) {
            $table->increments('config_id')->unsigned();
            $table->string('name', 50);
            $table->string('display_name', 50);
            $table->string('value', 50);
            $table->enum('encrypt', ['true', 'false']);
        });

        //Table:ms_usage_logs
        Schema::create('ms_usage_logs', function (Blueprint $table) {
            $table->increments('log_id')->unsigned();
            $table->char('action_id', 4);
            $table->timestamp('begin_time');
            $table->timestamp('end_time');
            $table->integer('user_id')->unsigned();
            $table->string('description', 50)->nullable();
            $table->tinyInteger('result')->unsigned();
            $table->string('error_desc', 200)->nullable();
        });
        /*System Tables==============================================================================End*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Drop Index============================================================================Begin*/
        //Table:ms_roles
        Schema::table(config('access.roles_table'), function (Blueprint $table) {
            $table->dropUnique(config('access.roles_table') . '_role_name_unique');
        });

        //Table:ms_assigned_roles
        Schema::table(config('access.assigned_roles_table'), function (Blueprint $table) {
            $table->dropForeign(config('access.assigned_roles_table') . '_user_id_foreign');
            $table->dropForeign(config('access.assigned_roles_table') . '_role_id_foreign');
        });

        //Table:ms_permissions
        Schema::table(config('access.permissions_table'), function (Blueprint $table) {
            $table->dropUnique(config('access.permissions_table') . '_name_unique');
        });

        //Table:ms_permission_dependencies
        Schema::table(config('access.permission_dependencies_table'), function (Blueprint $table) {
            $table->dropForeign(config('access.permission_dependencies_table') . '_permission_id_foreign');
            $table->dropForeign(config('access.permission_dependencies_table') . '_dependency_id_foreign');
        });

        //Table:ms_user_permissions
        Schema::table(config('access.permission_user_table'), function (Blueprint $table) {
            $table->dropForeign(config('access.permission_user_table') . '_permission_id_foreign');
            $table->dropForeign(config('access.permission_user_table') . '_user_id_foreign');
        });

        //Table:ms_role_permissions
        Schema::table(config('access.permission_role_table'), function (Blueprint $table) {
            $table->dropForeign(config('access.permission_role_table') . '_permission_id_foreign');
            $table->dropForeign(config('access.permission_role_table') . '_role_id_foreign');
        });

        //Table:ms_social_login
        Schema::table('ms_social_logins', function (Blueprint $table) {
            $table->dropForeign('ms_social_logins_user_id_foreign');
        });

        //Table:ms_report_snapshots
        Schema::table(config('report.snapshots_table'), function (Blueprint $table) {
            $table->dropForeign(config('report.snapshots_table') . '_report_id_foreign');
        });

        //Table:ms_report_parameters
        Schema::table(config('report.report_parameter_table'), function (Blueprint $table) {
            $table->dropForeign(config('report.report_parameter_table') . '_report_id_foreign');
        });

        //Table:ms_user_subscriptions
        Schema::table(config('report.user_subscriptions_table'), function (Blueprint $table) {
            $table->dropForeign(config('report.user_subscriptions_table') . '_user_id_foreign');
            $table->dropForeign(config('report.user_subscriptions_table') . '_report_id_foreign');
        });

        //Table:ms_reports
        Schema::table(config('report.reports_table'), function (Blueprint $table) {
            $table->dropUnique(config('report.reports_table') . '_name_unique');
        });

        /*Index Index=============================================================================End*/

        /*Drop Tables============================================================================Begin*/
        Schema::drop(config('access.users_table'));
        Schema::drop(config('access.roles_table'));
        Schema::drop(config('access.assigned_roles_table'));
        Schema::drop(config('access.permissions_table'));
        Schema::drop(config('access.permission_dependencies_table'));
        Schema::drop(config('access.permission_group_table'));
        Schema::drop(config('access.permission_user_table'));
        Schema::drop(config('access.permission_role_table'));
        Schema::drop(config('report.reports_table'));
        Schema::drop(config('report.report_group_table'));
        Schema::drop(config('report.snapshots_table'));
        Schema::drop(config('report.report_parameter_table'));
        Schema::drop(config('report.user_subscriptions_table'));
        Schema::drop('ms_social_logins');
        Schema::drop('ms_weixin_fans');
        Schema::drop('ms_weixin_messages');
        Schema::drop('ms_configurations');
        Schema::drop('ms_usage_logs');
        Schema::drop('password_resets');
        /*Drop Tables==============================================================================End*/
    }
}
