<!-- resources/views/dashboard/webhook-events.blade.php -->
@extends('layouts.dashboard_master')

@section('content')
    <div class="container">
        <h1>Webhook Events</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Event ID</th>
                    <th>Event Type</th>
                    <th>Timestamp</th>
                    <th>Payload</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->event_id }}</td>
                        <td>{{ $event->event_type }}</td>
                        <td>{{ $event->created_at }}</td>
                        <td><pre>{{ $event->payload }}</pre></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
