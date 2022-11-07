@extends('layouts.app')

@section('title', __('project.subscriptions').' | '.$project->name)

@section('content')

@include('projects.partials.breadcrumb',['title' => __('project.subscriptions')])

<h1 class="page-header">
    <div class="pull-right">
        {!! link_to_route('subscriptions.create', __('subscription.create'), ['project_id' => $project->id, 'customer_id' => $project->customer_id], ['class'=>'btn btn-success']) !!}
    </div>
    {{ $project->name }} <small>{{ __('project.subscriptions') }}</small>
</h1>

@include('projects.partials.nav-tabs')

<div class="panel panel-success">
    <div class="panel-heading"><h3 class="panel-title">{{ __('app.active') }}</h3></div>
    <div class="panel-body table-responsive">
        <table class="table table-condensed">
            <thead>
                <th>{{ __('app.table_no') }}</th>
                <th class="text-center">{{ __('app.type') }}</th>
                <th>{{ __('subscription.subscription') }}</th>
                <th class="text-center">{{ __('app.status') }}</th>
                <th class="text-right">{{ __('subscription.start_date') }}</th>
                <th class="text-right">{{ __('subscription.due_date') }}</th>
                <th class="text-right">{{ __('subscription.extension_price') }}</th>
                <th>{{ __('app.action') }}</th>
            </thead>
            <tbody>
                @forelse($activeSbscriptions as $key => $subscription)
                <tr>
                    <td>{{ 1 + $key }}</td>
                    <td class="text-center">{{ $subscription->type }}</td>
                    <td>{{ $subscription->name_link }}</td>
                    <td class="text-center">{{ $subscription->status() }}</td>
                    <td class="text-right">{{ date_id($subscription->start_date) }}</td>
                    <td class="text-right">{{ date_id($subscription->due_date) }} {!! $subscription->nearOfDueDateSign() !!}</td>
                    <td class="text-right">{{ format_money($subscription->price) }}</td>
                    <td>
                        {!! link_to_route('subscriptions.show',__('app.show'),[$subscription->id],['class'=>'btn btn-info btn-xs']) !!}
                        {!! link_to_route('subscriptions.edit',__('app.edit'),[$subscription->id],['class'=>'btn btn-warning btn-xs']) !!}
                    </td>
                </tr>
                @empty
                <tr><td>{{ __('subscription.empty') }}</td></tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6" class="text-right">{{ __('app.total') }}</th>
                    <th class="text-right">{{ format_money($activeSbscriptions->sum('price')) }}</th>
                    <th>&nbsp;</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title">{{ __('app.in_active') }}</h3></div>
    <div class="panel-body table-responsive">
        <table class="table table-condensed">
            <thead>
                <th>{{ __('app.table_no') }}</th>
                <th class="text-center">{{ __('app.type') }}</th>
                <th>{{ __('subscription.subscription') }}</th>
                <th class="text-center">{{ __('app.status') }}</th>
                <th class="text-right">{{ __('subscription.start_date') }}</th>
                <th class="text-right">{{ __('subscription.due_date') }}</th>
                <th class="text-right">{{ __('subscription.extension_price') }}</th>
                <th>{{ __('app.action') }}</th>
            </thead>
            <tbody>
                @forelse($inactiveSbscriptions as $key => $subscription)
                <tr>
                    <td>{{ 1 + $key }}</td>
                    <td class="text-center">{{ $subscription->type }}</td>
                    <td>{{ $subscription->name_link }}</td>
                    <td class="text-center">{{ $subscription->status() }}</td>
                    <td class="text-right">{{ date_id($subscription->start_date) }}</td>
                    <td class="text-right">{{ date_id($subscription->due_date) }} {!! $subscription->nearOfDueDateSign() !!}</td>
                    <td class="text-right">{{ format_money($subscription->price) }}</td>
                    <td>
                        {!! link_to_route('subscriptions.show',__('app.show'),[$subscription->id],['class'=>'btn btn-info btn-xs']) !!}
                        {!! link_to_route('subscriptions.edit',__('app.edit'),[$subscription->id],['class'=>'btn btn-warning btn-xs']) !!}
                    </td>
                </tr>
                @empty
                <tr><td>{{ __('subscription.empty') }}</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
