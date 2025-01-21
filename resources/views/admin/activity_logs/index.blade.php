@extends('layouts.master')

@section('title', 'Blog IT - Activity Logs')

@section('content')
    {{-- <div class="container"> --}}
    <div class="container-fluid px-4">
        <div class="card mt-4 mb-4">
            <div class="card-header">
                <h4>Activity Logs</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="myDataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Object</th>
                            <th>Data Change</th>
                            <th>Date Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $log->user->name ?? 'System' }}</td>
                                <td>{{ $log->event }}</td>
                                <td>{{ class_basename($log->auditable_type) }} (ID: {{ $log->auditable_id }})</td>

                                <td>
                                    @if ($log->event === 'updated')
                                        <pre style="white-space: pre-wrap">
                                            {{ json_encode(['before_change' => $log->old_values], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                                        </pre>
                                        <pre style="white-space: pre-wrap">
                                            {{ json_encode(['after_change' => $log->new_values], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                                        </pre>
                                    @elseif ($log->event === 'created')
                                        <pre style="white-space: pre-wrap">
                                            {{ json_encode($log->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                                        </pre>
                                    @elseif ($log->event === 'deleted')
                                        <pre style="white-space: pre-wrap">
                                            {{ json_encode($log->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                                        </pre>
                                    @endif
                                </td>

                                <td>
                                    {{ $log->created_at->timezone('UTC')->setTimezone('Asia/Bangkok')->format('H:i:s - d/m/Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No activity recorded.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- {{ $logs->links() }} --}}
    {{-- </div> --}}
@endsection
