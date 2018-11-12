@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.wizard.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-magic fa-fw" aria-hidden="true"></i>
    {!! trans('installer_messages.environment.wizard.title') !!}
@endsection

@section('container')
    <div class="tabs tabs-full">

        <input id="tab1" type="radio" name="tabs" class="tab-input" checked/>
        <label for="tab1" class="tab-label">
            <i class="fa fa-cog fa-2x fa-fw" aria-hidden="true"></i>
            <br/>
            {{ trans('installer_messages.environment.wizard.tabs.environment') }}
        </label>

        <input id="tab2" type="radio" name="tabs" class="tab-input"/>
        <label for="tab2" class="tab-label">
            <i class="fa fa-database fa-2x fa-fw" aria-hidden="true"></i>
            <br/>
            {{ trans('installer_messages.environment.wizard.tabs.database') }}
        </label>

        <input id="tab3" type="radio" name="tabs" class="tab-input"/>
        <label for="tab3" class="tab-label">
            <i class="fa fa-cogs fa-2x fa-fw" aria-hidden="true"></i>
            <br/>
            {{ trans('installer_messages.environment.wizard.tabs.application') }}
        </label>

        <form method="post" action="{{ route('LaravelVisualInstaller::environmentSaveWizard') }}" class="tabs-wrap">
            <div class="tab" id="tab1content">
                {{csrf_field()}}

                <div class="form-group {{ $errors->has('app_name') ? ' has-error ' : '' }}">
                    <label for="app_name">
                        {{ trans('installer_messages.environment.wizard.form.app_name_label') }}
                    </label>
                    <input type="text" name="app_name" id="app_name" value="{{old('app_name')}}"
                           placeholder="{{ trans('installer_messages.environment.wizard.form.app_name_placeholder') }}"/>
                    @if ($errors->has('app_name'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_name') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('environment') ? ' has-error ' : '' }}">
                    <label for="environment">
                        {{ trans('installer_messages.environment.wizard.form.app_environment_label') }}
                    </label>
                    <select name="environment" id="environment" onchange='checkEnvironment(this.value);'>
                        <option value="local"
                                selected>{{ trans('installer_messages.environment.wizard.form.app_environment_label_local') }}</option>
                        <option value="development">{{ trans('installer_messages.environment.wizard.form.app_environment_label_development') }}</option>
                        <option value="qa">{{ trans('installer_messages.environment.wizard.form.app_environment_label_qa') }}</option>
                        <option value="production">{{ trans('installer_messages.environment.wizard.form.app_environment_label_production') }}</option>
                        <option value="other">{{ trans('installer_messages.environment.wizard.form.app_environment_label_other') }}</option>
                    </select>
                    <div id="environment_text_input" style="display: none;">
                        <input type="text" name="environment_custom" id="environment_custom"
                               placeholder="{{ trans('installer_messages.environment.wizard.form.app_environment_placeholder_other') }}"/>
                    </div>
                    @if ($errors->has('environment'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('environment') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('app_debug') ? ' has-error ' : '' }}">
                    <label for="app_debug">
                        {{ trans('installer_messages.environment.wizard.form.app_debug_label') }}
                    </label>
                    <label for="app_debug_true">
                        <input type="radio" name="app_debug" id="app_debug_true" value=true checked/>
                        {{ trans('installer_messages.environment.wizard.form.app_debug_label_true') }}
                    </label>
                    <label for="app_debug_false">
                        <input type="radio" name="app_debug" id="app_debug_false" value=false />
                        {{ trans('installer_messages.environment.wizard.form.app_debug_label_false') }}
                    </label>
                    @if ($errors->has('app_debug'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_debug') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('app_url') ? ' has-error ' : '' }}">
                    <label for="app_url">
                        {{ trans('installer_messages.environment.wizard.form.app_url_label') }}
                    </label>
                    <input type="url" name="app_url" id="app_url" value="{{old('app_url') ?? 'http://localhost'}}"
                           placeholder="{{ trans('installer_messages.environment.wizard.form.app_url_placeholder') }}"/>
                    @if ($errors->has('app_url'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_url') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('app_log_channel') ? ' has-error ' : '' }}">
                    <label for="app_log_channel">
                        {{ trans('installer_messages.environment.wizard.form.app_log_channel_label') }}
                    </label>
                    <select name="app_log_channel" id="app_log_channel">
                        <option value="stack"
                                selected>{{ trans('installer_messages.environment.wizard.form.app_log_channel_label_stack') }}</option>
                        <option value="single">{{ trans('installer_messages.environment.wizard.form.app_log_channel_label_single') }}</option>
                        <option value="daily">{{ trans('installer_messages.environment.wizard.form.app_log_channel_label_daily') }}</option>
                        <option value="stderr">{{ trans('installer_messages.environment.wizard.form.app_log_channel_label_stderr') }}</option>
                        <option value="syslog">{{ trans('installer_messages.environment.wizard.form.app_log_channel_label_syslog') }}</option>
                        <option value="errorlog">{{ trans('installer_messages.environment.wizard.form.app_log_channel_label_errorlog') }}</option>
                        <option value="slack">{{ trans('installer_messages.environment.wizard.form.app_log_channel_label_slack') }}</option>
                        <option value="papertrail">{{ trans('installer_messages.environment.wizard.form.app_log_channel_label_papertrail') }}</option>
                    </select>
                    @if ($errors->has('app_log_channel'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_log_channel') }}
                        </span>
                    @endif
                </div>

                <div class="slack_web_url form-group {{ $errors->has('log_slack_webhook_url') ? ' has-error ' : '' }}"
                     style="display:none;">
                    <label for="log_slack_webhook_url">
                        {{ trans('installer_messages.environment.wizard.form.log_slack_webhook_url_label') }}
                    </label>
                    <input type="url" name="log_slack_webhook_url" value="{{old('log_slack_webhook_url')}}" id="log_slack_webhook_url"
                           placeholder="{{ trans('installer_messages.environment.wizard.form.log_slack_webhook_url_label') }}"/>
                    @if ($errors->has('log_slack_webhook_url'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('log_slack_webhook_url') }}
                        </span>
                    @endif
                </div>

                <div class="papertrail form-group {{ $errors->has('papertrail_url') ? ' has-error ' : '' }}"
                     style="display:none;">
                    <label for="papertrail_url">
                        {{ trans('installer_messages.environment.wizard.form.papertrail_url_label') }}
                    </label>
                    <input type="url" name="papertrail_url" value="{{old('papertrail_url')}}" id="papertrail_url"
                           placeholder="{{ trans('installer_messages.environment.wizard.form.papertrail_url_label') }}"/>
                    @if ($errors->has('papertrail_url'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('papertrail_url') }}
                        </span>
                    @endif
                </div>

                <div class="papertrail form-group {{ $errors->has('papertrail_port') ? ' has-error ' : '' }}"
                     style="display:none;">
                    <label for="papertrail_port">
                        {{ trans('installer_messages.environment.wizard.form.papertrail_port_label') }}
                    </label>
                    <input type="text" name="papertrail_url" value="{{old('papertrail_port')}}" id="papertrail_port"
                           placeholder="{{ trans('installer_messages.environment.wizard.form.papertrail_port_label') }}"/>
                    @if ($errors->has('papertrail_port'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('papertrail_port') }}
                        </span>
                    @endif
                </div>

                <div class="buttons">
                    <button class="button" onclick="showDatabaseSettings();return false">
                        {{ trans('installer_messages.environment.wizard.form.buttons.setup_database') }}
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="tab" id="tab2content">

                <div class="form-group {{ $errors->has('database_connection') ? ' has-error ' : '' }}">
                    <label for="database_connection">
                        {{ trans('installer_messages.environment.wizard.form.db_connection_label') }}
                    </label>
                    <select name="database_connection" id="database_connection">
                        <option value="mysql"
                                selected>{{ trans('installer_messages.environment.wizard.form.db_connection_label_mysql') }}</option>
                        <option value="sqlite">{{ trans('installer_messages.environment.wizard.form.db_connection_label_sqlite') }}</option>
                        <option value="pgsql">{{ trans('installer_messages.environment.wizard.form.db_connection_label_pgsql') }}</option>
                        <option value="sqlsrv">{{ trans('installer_messages.environment.wizard.form.db_connection_label_sqlsrv') }}</option>
                    </select>
                    @if ($errors->has('database_connection'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_connection') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_hostname') ? ' has-error ' : '' }}">
                    <label for="database_hostname">
                        {{ trans('installer_messages.environment.wizard.form.db_host_label') }}
                    </label>
                    <input type="text" name="database_hostname" id="database_hostname" value="{{old('database_hostname') ?? '127.0.0.1'}}"
                           placeholder="{{ trans('installer_messages.environment.wizard.form.db_host_placeholder') }}"/>
                    @if ($errors->has('database_hostname'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_hostname') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_port') ? ' has-error ' : '' }}">
                    <label for="database_port">
                        {{ trans('installer_messages.environment.wizard.form.db_port_label') }}
                    </label>
                    <input type="number" name="database_port" id="database_port" value="{{old('database_port') ?? '3306'}}"
                           placeholder="{{ trans('installer_messages.environment.wizard.form.db_port_placeholder') }}"/>
                    @if ($errors->has('database_port'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_port') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_name') ? ' has-error ' : '' }}">
                    <label for="database_name">
                        {{ trans('installer_messages.environment.wizard.form.db_name_label') }}
                    </label>
                    <input type="text" name="database_name" id="database_name" value="{{old('database_name')}}"
                           placeholder="{{ trans('installer_messages.environment.wizard.form.db_name_placeholder') }}"/>
                    @if ($errors->has('database_name'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_name') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_username') ? ' has-error ' : '' }}">
                    <label for="database_username">
                        {{ trans('installer_messages.environment.wizard.form.db_username_label') }}
                    </label>
                    <input type="text" name="database_username" id="database_username" value="{{old('database_username')}}"
                           placeholder="{{ trans('installer_messages.environment.wizard.form.db_username_placeholder') }}"/>
                    @if ($errors->has('database_username'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_username') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_password') ? ' has-error ' : '' }}">
                    <label for="database_password">
                        {{ trans('installer_messages.environment.wizard.form.db_password_label') }}
                    </label>
                    <input type="password" name="database_password" id="database_password" value=""
                           placeholder="{{ trans('installer_messages.environment.wizard.form.db_password_placeholder') }}"/>
                    @if ($errors->has('database_password'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_password') }}
                        </span>
                    @endif
                </div>

                <div class="buttons">
                    <button class="button" onclick="showApplicationSettings();return false">
                        {{ trans('installer_messages.environment.wizard.form.buttons.setup_application') }}
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="tab" id="tab3content">
                <div class="block">
                    <input type="radio" name="appSettingsTabs" id="appSettingsTab1" value="null" checked/>
                    <label for="appSettingsTab1">
                        <span>
                            {{ trans('installer_messages.environment.wizard.form.app_tabs.broadcasting_title') }}
                        </span>
                    </label>


                    <div class="info">
                        <div class="form-group {{ $errors->has('broadcast_driver') ? ' has-error ' : '' }}">
                            <label for="broadcast_driver">{{ trans('installer_messages.environment.wizard.form.app_tabs.broadcasting_label') }}
                                <sup>
                                    <a href="https://laravel.com/docs/broadcasting" target="_blank"
                                       title="{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}">
                                        <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only">{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}</span>
                                    </a>
                                </sup>
                            </label>
                            <input type="text" name="broadcast_driver" id="broadcast_driver" value="{{old('broadcast_driver') ?? 'log'}}"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.broadcasting_placeholder') }}"/>
                            @if ($errors->has('broadcast_driver'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('broadcast_driver') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('cache_driver') ? ' has-error ' : '' }}">
                            <label for="cache_driver">{{ trans('installer_messages.environment.wizard.form.app_tabs.cache_label') }}
                                <sup>
                                    <a href="https://laravel.com/docs/cache" target="_blank"
                                       title="{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}">
                                        <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only">{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}</span>
                                    </a>
                                </sup>
                            </label>
                            <input type="text" name="cache_driver" id="cache_driver" value="{{old('cache_driver') ?? 'file'}}"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.cache_placeholder') }}"/>
                            @if ($errors->has('cache_driver'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('cache_driver') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('queue_connection') ? ' has-error ' : '' }}">
                            <label for="queue_connection">{{ trans('installer_messages.environment.wizard.form.app_tabs.queue_connection_label') }}
                                <sup>
                                    <a href="https://laravel.com/docs/queues" target="_blank"
                                       title="{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}">
                                        <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only">{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}</span>
                                    </a>
                                </sup>
                            </label>
                            <input type="text" name="queue_connection" id="queue_connection" value="{{old('queue_connection') ?? 'sync'}}"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.queue_connection_placeholder') }}"/>
                            @if ($errors->has('queue_connection'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('queue_connection') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('session_driver') ? ' has-error ' : '' }}">
                            <label for="session_driver">{{ trans('installer_messages.environment.wizard.form.app_tabs.session_label') }}
                                <sup>
                                    <a href="https://laravel.com/docs/session" target="_blank"
                                       title="{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}">
                                        <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only">{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}</span>
                                    </a>
                                </sup>
                            </label>
                            <input type="text" name="session_driver" id="session_driver" value="{{old('session_driver') ?? 'file'}}"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.session_placeholder') }}"/>
                            @if ($errors->has('session_driver'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('session_driver') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('session_lifetime') ? ' has-error ' : '' }}">
                            <label for="session_lifetime">{{ trans('installer_messages.environment.wizard.form.app_tabs.session_lifetime') }}
                                <sup>
                                    <i class="fa fa-info-circle fa-fw"
                                       title="{{ trans('installer_messages.environment.wizard.form.app_tabs.session_lifetime_info') }}"
                                       aria-hidden="true"></i>
                                </sup>
                            </label>
                            <input type="text" name="session_lifetime" id="session_lifetime" value="{{old('session_lifetime') ?? '120'}}"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.session_lifetime') }}"/>
                            @if ($errors->has('session_lifetime'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('session_lifetime') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="block">
                    <input type="radio" name="appSettingsTabs" id="appSettingsTab2" value="null"/>
                    <label for="appSettingsTab2">
                        <span>
                            {{ trans('installer_messages.environment.wizard.form.app_tabs.redis_label') }}
                        </span>
                    </label>
                    <div class="info">
                        <div class="form-group {{ $errors->has('redis_hostname') ? ' has-error ' : '' }}">
                            <label for="redis_hostname">
                                {{ trans('installer_messages.environment.wizard.form.app_tabs.redis_host') }}
                                <sup>
                                    <a href="https://laravel.com/docs/redis" target="_blank"
                                       title="{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}">
                                        <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only">{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}</span>
                                    </a>
                                </sup>
                            </label>
                            <input type="text" name="redis_hostname" id="redis_hostname" value="{{old('redis_hostname') ?? '127.0.0.1'}}"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.redis_host') }}"/>
                            @if ($errors->has('redis_hostname'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('redis_hostname') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('redis_password') ? ' has-error ' : '' }}">
                            <label for="redis_password">{{ trans('installer_messages.environment.wizard.form.app_tabs.redis_password') }}</label>
                            <input type="password" name="redis_password" id="redis_password" value="null"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.redis_password') }}"/>
                            @if ($errors->has('redis_password'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('redis_password') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('redis_port') ? ' has-error ' : '' }}">
                            <label for="redis_port">{{ trans('installer_messages.environment.wizard.form.app_tabs.redis_port') }}</label>
                            <input type="number" name="redis_port" id="redis_port" value="{{old('redis_port') ?? '6379'}}"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.redis_port') }}"/>
                            @if ($errors->has('redis_port'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('redis_port') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="block">
                    <input type="radio" name="appSettingsTabs" id="appSettingsTab3" value="null"/>
                    <label for="appSettingsTab3">
                        <span>
                            {{ trans('installer_messages.environment.wizard.form.app_tabs.mail_label') }}
                        </span>
                    </label>
                    <div class="info">
                        <div class="form-group {{ $errors->has('mail_driver') ? ' has-error ' : '' }}">
                            <label for="mail_driver">
                                {{ trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_label') }}
                                <sup>
                                    <a href="https://laravel.com/docs/mail" target="_blank"
                                       title="{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}">
                                        <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only">{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}</span>
                                    </a>
                                </sup>
                            </label>
                            <input type="text" name="mail_driver" id="mail_driver" value="{{old('mail_driver') ?? 'smtp'}}"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_placeholder') }}"/>
                            @if ($errors->has('mail_driver'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('mail_driver') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('mail_host') ? ' has-error ' : '' }}">
                            <label for="mail_host">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_host_label') }}</label>
                            <input type="text" name="mail_host" id="mail_host" value="{{old('mail_host') ?? 'smtp.mailtrap.io'}}"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_host_placeholder') }}"/>
                            @if ($errors->has('mail_host'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('mail_host') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('mail_port') ? ' has-error ' : '' }}">
                            <label for="mail_port">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_port_label') }}</label>
                            <input type="number" name="mail_port" id="mail_port" value="{{old('mail_port') ?? '2525'}}"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_port_placeholder') }}"/>
                            @if ($errors->has('mail_port'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('mail_port') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('mail_username') ? ' has-error ' : '' }}">
                            <label for="mail_username">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_username_label') }}</label>
                            <input type="text" name="mail_username" id="mail_username" value="{{old('mail_username') ?? 'null'}}"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_username_placeholder') }}"/>
                            @if ($errors->has('mail_username'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('mail_username') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('mail_password') ? ' has-error ' : '' }}">
                            <label for="mail_password">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_password_label') }}</label>
                            <input type="text" name="mail_password" id="mail_password" value="null"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_password_placeholder') }}"/>
                            @if ($errors->has('mail_password'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('mail_password') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('mail_encryption') ? ' has-error ' : '' }}">
                            <label for="mail_encryption">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_label') }}</label>
                            <input type="text" name="mail_encryption" id="mail_encryption" value="{{old('mail_encryption') ?? 'null'}}"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_placeholder') }}"/>
                            @if ($errors->has('mail_encryption'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('mail_encryption') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('mail_to_address') ? ' has-error ' : '' }}">
                            <label for="mail_to_address">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_to_address_label') }}</label>
                            <input type="text" name="mail_to_address" value="{{old('mail_to_address') ?? ''}}" id="mail_to_address"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_to_address_placeholder') }}"/>
                            @if ($errors->has('mail_to_address'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('mail_to_address') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('mail_from_address') ? ' has-error ' : '' }}">
                            <label for="mail_from_address">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_from_address_label') }}</label>
                            <input type="text" name="mail_from_address" value="{{old('mail_from_address') ?? ''}}" id="mail_from_address"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_from_address_placeholder') }}"/>
                            @if ($errors->has('mail_from_address'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('mail_from_address') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('mail_from_name') ? ' has-error ' : '' }}">
                            <label for="mail_from_name">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_from_name_label') }}</label>
                            <input type="text" name="mail_from_name" value="{{old('mail_from_name') ?? ''}}" id="mail_from_name"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_from_name_placeholder') }}"/>
                            @if ($errors->has('mail_from_name'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('mail_from_name') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="block">
                    <input type="radio" name="appSettingsTabs" id="appSettingsTab4" value="null"/>
                    <label for="appSettingsTab4">
                        <span>
                            {{ trans('installer_messages.environment.wizard.form.app_tabs.pusher_label') }}
                        </span>
                    </label>
                    <div class="info">
                        <div class="form-group {{ $errors->has('pusher_app_id') ? ' has-error ' : '' }}">
                            <label for="pusher_app_id">
                                {{ trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_id_label') }}
                                <sup>
                                    <a href="https://pusher.com/docs/server_api_guide" target="_blank"
                                       title="{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}">
                                        <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only">{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}</span>
                                    </a>
                                </sup>
                            </label>
                            <input type="text" name="pusher_app_id" id="pusher_app_id" value="{{old('pusher_app_id') ?? ''}}"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_id_placeholder') }}"/>
                            @if ($errors->has('pusher_app_id'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('pusher_app_id') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('pusher_app_key') ? ' has-error ' : '' }}">
                            <label for="pusher_app_key">{{ trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_key_label') }}</label>
                            <input type="text" name="pusher_app_key" id="pusher_app_key" value="{{old('pusher_app_key') ?? ''}}"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_key_placeholder') }}"/>
                            @if ($errors->has('pusher_app_key'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('pusher_app_key') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('pusher_app_secret') ? ' has-error ' : '' }}">
                            <label for="pusher_app_secret">{{ trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_secret_label') }}</label>
                            <input type="password" name="pusher_app_secret" id="pusher_app_secret" value="{{old('pusher_app_secret') ?? ''}}"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.pusher_app_secret_placeholder') }}"/>
                            @if ($errors->has('pusher_app_secret'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('pusher_app_secret') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="block">
                    <input type="radio" name="appSettingsTabs" id="appSettingsTab5" value="null"/>
                    <label for="appSettingsTab5">
                        <span>
                            {{ trans('installer_messages.environment.wizard.form.app_tabs.jwt_label') }}
                        </span>
                    </label>
                    <div class="info">
                        <div class="form-group {{ $errors->has('jwt_ttl') ? ' has-error ' : '' }}">
                            <label for="jwt_ttl">
                                {{ trans('installer_messages.environment.wizard.form.app_tabs.jwt_ttl_label') }}
                                <sup>
                                    <a href="https://github.com/tymondesigns/jwt-auth" target="_blank"
                                       title="{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}">
                                        <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only">{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}</span>
                                    </a>
                                </sup>
                            </label>
                            <input type="text" name="jwt_ttl" id="jwt_ttl" value="{{old('jwt_ttl') ?? '10080'}}"
                                   placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.jwt_ttl_label') }}"/>
                            @if ($errors->has('jwt_ttl'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('jwt_ttl') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="block margin-bottom-2">
                    <input type="radio" name="appSettingsTabs" id="appSettingsTab6" value="null"/>
                    <label for="appSettingsTab6">
                        <span>
                            {{ trans('installer_messages.environment.wizard.form.app_tabs.scout_label') }}
                        </span>
                    </label>
                    <div class="info">
                        <div class="form-group {{ $errors->has('jwt_ttl') ? ' has-error ' : '' }}">
                            <label for="scout_driver">
                                {{ trans('installer_messages.environment.wizard.form.app_tabs.scout_driver_label') }}
                                <sup>
                                    <a href="https://laravel.com/docs/scout" target="_blank"
                                       title="{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}">
                                        <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only">{{ trans('installer_messages.environment.wizard.form.app_tabs.more_info') }}</span>
                                    </a>
                                </sup>
                            </label>
                            <select name="scout_driver" id="scout_driver" onchange="showAlgolia(this.value);">
                                <option value="mysql"
                                        selected>{{ trans('installer_messages.environment.wizard.form.app_tabs.scout_driver_mysql') }}</option>
                                <option value="algolia">{{ trans('installer_messages.environment.wizard.form.app_tabs.scout_driver_algolia') }}</option>
                            </select>
                            <div id="algolia_extra" style="display: none;">
                                <input type="text" name="algolia_app_id" id="algolia_app_id" value="{{old('algolia_app_id') ?? ''}}"
                                       placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.algolia_app_id_label') }}"/>
                                <input type="text" name="algolia_secret" id="algolia_secret" value="{{old('algolia_secret') ?? ''}}"
                                       placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.algolia_secret_label') }}"/>
                            </div>
                            @if ($errors->has('scout_driver'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('scout_driver') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="buttons">
                    <button class="button" type="submit">
                        {{ trans('installer_messages.environment.wizard.form.buttons.install') }}
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </form>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function checkEnvironment(val) {
            var element = document.getElementById('environment_text_input');
            if (val === 'other') {
                element.style.display = 'block';
            } else {
                element.style.display = 'none';
            }
        }

        function showDatabaseSettings() {
            document.getElementById('tab2').checked = true;
        }

        function showApplicationSettings() {
            document.getElementById('tab3').checked = true;
        }

        function showAlgolia(val) {
            var element = document.getElementById('algolia_extra');
            if (val === 'algolia') {
                element.style.display = 'block';
            } else {
                element.style.display = 'none';
            }
        }

        var app_log_channel = document.querySelector('#app_log_channel');
        app_log_channel.addEventListener('change', function (event) {
            switch (event.target.value) {
                case 'slack':
                    document.querySelector('.slack_web_url').setAttribute('style', 'display: block');
                    break;
                case 'papertrail':
                    document.querySelectorAll('.papertrail').forEach(function (item) {
                        item.setAttribute('style', 'display: block');
                    });
                    break;
                default:
                    document.querySelector('.slack_web_url').setAttribute('style', 'display: none');
                    document.querySelectorAll('.papertrail').forEach(function (item) {
                        item.setAttribute('style', 'display: none');
                    });
                    break;
            }
        })
    </script>
@endsection
