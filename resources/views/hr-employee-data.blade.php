@extends('layouts.dashboard')
@section('title', 'Employee Data')
@section('content')

<div class="welcome-banner" style="background:linear-gradient(135deg,#1e4575 0%,#2563eb 60%,#1e4575 100%);border-radius:20px;padding:36px 40px;margin-bottom:28px;position:relative;overflow:hidden;box-shadow:0 8px 32px rgba(30,69,117,.25);">
    <div style="position:relative;z-index:2;">
        <div style="font-size:12px;font-weight:700;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:1.5px;margin-bottom:8px;">Human Resource</div>
        <h1 style="font-size:28px;font-weight:700;color:white;margin:0 0 8px;">Employee Data</h1>
        <p style="font-size:14px;color:rgba(255,255,255,.75);margin:0;">Edit employment details for all active users</p>
    </div>
</div>

@if(session('emp_success'))<div style="background:#d1fae5;color:#065f46;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-weight:500;">&#10003; {{ session('emp_success') }}</div>@endif
@if(session('success'))<div style="background:#d1fae5;color:#065f46;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-weight:500;">&#10003; {{ session('success') }}</div>@endif

@php $isAdmin = auth()->user()->isAdmin(); @endphp

{{-- Add New Employee --}}
<div class="st-card" style="margin-bottom:18px;">
    <div class="st-card-hdr"><div class="st-card-hdr-text"><h3>Add New Employee</h3><p>Pre-register an employee record</p></div></div>
    <div class="st-card-body">
        <form method="POST" action="{{ route('settings.employee.add') }}">@csrf
            <div class="st-form-grid">
                <div class="st-form-group">
                    <label class="st-label">Name <span style="color:#ef4444;">*</span></label>
                    <input class="st-input" type="text" name="name" required placeholder="Full name">
                </div>
                <div class="st-form-group">
                    <label class="st-label">Position <span style="color:#ef4444;">*</span></label>
                    <input class="st-input" type="text" name="position" required placeholder="Job title / position">
                </div>
                <div class="st-form-group">
                    <label class="st-label">Employee ID <span style="color:#ef4444;">*</span></label>
                    <input class="st-input" type="text" name="employee_id" required placeholder="e.g. 0050">
                </div>
                <div class="st-form-group">
                    <label class="st-label">Date Hired <span style="color:#ef4444;">*</span></label>
                    <input class="st-input" type="date" name="date_hired" required>
                </div>
            </div>
            <div style="margin-top:14px;"><button type="submit" class="st-btn st-btn-primary">Add Employee</button></div>
        </form>
    </div>
</div>

{{-- Employee List Table --}}
<div class="st-card">
    <div class="st-card-hdr"><div class="st-card-hdr-text"><h3>Employee Records</h3><p>{{ $activeUsers->count() }} employees on record</p></div></div>
    <div class="st-card-body" style="padding:0;overflow-x:auto;">
        @if($activeUsers->isEmpty())
            <div class="st-empty">No employees yet.</div>
        @else
        <table class="st-user-table" style="min-width:700px;white-space:nowrap;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Employee ID</th>
                    <th>Date Hired</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activeUsers as $u)
                <tr id="emp-view-{{ $u->id }}">
                    <td style="font-weight:600;">{{ $u->name }}</td>
                    <td style="color:#64748b;font-size:12px;">{{ $u->email }}</td>
                    <td>{{ $u->position ?: '—' }}</td>
                    <td>{{ $u->employee_id ?: '—' }}</td>
                    <td>{{ $u->date_hired ? $u->date_hired->format('M d, Y') : '—' }}</td>
                    <td style="white-space:nowrap;">
                        @if($isAdmin)
                        <button type="button" class="st-btn st-btn-primary st-btn-sm" onclick="toggleEmpEdit({{ $u->id }})">Edit</button>
                        @if($u->id !== auth()->id())
                        <form method="POST" action="{{ route('settings.users.remove', $u->id) }}" style="display:inline;" onsubmit="return confirm('Remove {{ addslashes($u->name) }}?')">@csrf @method('DELETE')
                            <button type="submit" class="st-btn st-btn-danger st-btn-sm">Delete</button>
                        </form>
                        @endif
                        @endif
                    </td>
                </tr>
                <tr id="emp-edit-{{ $u->id }}" style="display:none;background:#f0f4ff;">
                    <td colspan="6" style="padding:12px 16px;white-space:normal;">
                        <form method="POST" action="{{ route('settings.users.employee-info', $u->id) }}" style="display:flex;gap:8px;flex-wrap:wrap;align-items:flex-end;">@csrf
                            <div style="flex:1.5;min-width:130px;"><label class="st-label" style="margin-bottom:3px;display:block;">Position</label><input class="st-input" type="text" name="position" value="{{ $u->position }}"></div>
                            <div style="flex:1;min-width:110px;"><label class="st-label" style="margin-bottom:3px;display:block;">Employee ID</label><input class="st-input" type="text" name="employee_id" value="{{ $u->employee_id }}"></div>
                            <div style="flex:1;min-width:140px;"><label class="st-label" style="margin-bottom:3px;display:block;">Date Hired</label><input class="st-input" type="date" name="date_hired" value="{{ $u->date_hired ? $u->date_hired->format('Y-m-d') : '' }}"></div>
                            <div style="display:flex;gap:6px;flex-shrink:0;">
                                <button type="submit" class="st-btn st-btn-primary st-btn-sm">Save</button>
                                <button type="button" class="st-btn st-btn-danger st-btn-sm" onclick="toggleEmpEdit({{ $u->id }})">Cancel</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>

<script>
function toggleEmpEdit(id) {
    var view = document.getElementById('emp-view-' + id);
    var edit = document.getElementById('emp-edit-' + id);
    var isEditing = edit.style.display !== 'none';
    edit.style.display = isEditing ? 'none' : 'table-row';
}
</script>

@endsection
