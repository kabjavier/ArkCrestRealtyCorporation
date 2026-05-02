@extends('layouts.dashboard')
@section('title', 'ARC Contact List')
@section('content')

<div class="welcome-banner" style="background:linear-gradient(135deg,#1e4575 0%,#2563eb 60%,#1e4575 100%);border-radius:20px;padding:36px 40px;margin-bottom:28px;position:relative;overflow:hidden;box-shadow:0 8px 32px rgba(30,69,117,.25);">
    <div style="position:relative;z-index:2;">
        <div style="font-size:12px;font-weight:700;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:1.5px;margin-bottom:8px;">Human Resource</div>
        <h1 style="font-size:28px;font-weight:700;color:white;margin:0 0 8px;">ARC Contact List</h1>
        <p style="font-size:14px;color:rgba(255,255,255,.75);margin:0;">Directory of ARC personnel with their contact information</p>
    </div>
</div>

@if(session('success'))<div style="background:#d1fae5;color:#065f46;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-weight:500;">&#10003; {{ session('success') }}</div>@endif

@php $isAdmin = auth()->user()->isAdmin(); @endphp

<div style="display:flex;justify-content:flex-end;margin-bottom:16px;">
    <button type="button" class="st-btn st-btn-primary" onclick="openAddContactModal('', this)">+ Add New Contact</button>
</div>

@if($personnelContacts->isEmpty())
    <div class="st-card"><div class="st-card-body"><div class="st-empty">No contacts yet.</div></div></div>
@else
@php $grouped = $personnelContacts->groupBy(fn($c) => $c->company ?: 'Others'); @endphp
<div id="contact-groups-wrap">
@foreach($grouped as $grpCompany => $contacts)
<div class="st-card" style="margin-bottom:14px;">
    <div class="st-card-hdr" style="background:linear-gradient(135deg,#0f2444,#1a3a6b);border-radius:11px 11px 0 0;">
        <div style="display:flex;align-items:center;gap:8px;">
            <div style="font-size:12px;font-weight:700;color:#d4a03a;text-transform:uppercase;letter-spacing:1px;">{{ $grpCompany }}</div>
        </div>
        <button type="button" class="st-btn st-btn-sm" style="background:rgba(212,160,58,.2);color:#d4a03a;border:1px solid rgba(212,160,58,.4);" onclick="openAddContactModal('{{ addslashes($grpCompany) }}', this)">+ Add</button>
    </div>
    <div style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;min-width:600px;white-space:nowrap;">
        <thead><tr style="background:#f8fafc;">
            <th style="padding:9px 16px;text-align:left;font-size:10px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.6px;border-bottom:1px solid #f1f5f9;">Name</th>
            <th style="padding:9px 16px;text-align:left;font-size:10px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.6px;border-bottom:1px solid #f1f5f9;">Contact No.</th>
            <th style="padding:9px 16px;text-align:left;font-size:10px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.6px;border-bottom:1px solid #f1f5f9;">Email</th>
            <th style="padding:9px 16px;text-align:left;font-size:10px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.6px;border-bottom:1px solid #f1f5f9;">Facebook</th>
            <th style="padding:9px 16px;text-align:left;font-size:10px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.6px;border-bottom:1px solid #f1f5f9;">Actions</th>
        </tr></thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr style="border-bottom:1px solid #f8fafc;">
                <td style="padding:11px 16px;font-size:13px;font-weight:600;color:#0f172a;">{{ $contact->name }}</td>
                <td style="padding:11px 16px;font-size:13px;color:#374151;">{{ $contact->phone ?: '—' }}</td>
                <td style="padding:11px 16px;font-size:13px;">@if($contact->email)<a href="https://mail.google.com/mail/?view=cm&to={{ urlencode($contact->email) }}" target="_blank" style="color:#1e4575;text-decoration:none;">{{ $contact->email }}</a>@else —@endif</td>
                <td style="padding:11px 16px;font-size:13px;">@if($contact->facebook)
                    @php $fbUrl = str_starts_with($contact->facebook, 'http') ? $contact->facebook : 'https://facebook.com/' . $contact->facebook; @endphp
                    <a href="{{ $fbUrl }}" target="_blank" style="color:#1877f2;text-decoration:none;">{{ $contact->facebook }}</a>
                @else —@endif</td>
                <td style="padding:11px 16px;white-space:nowrap;">
                    @if($isAdmin)
                    <button type="button" class="st-btn st-btn-primary st-btn-sm" onclick="openContactModal({{ $contact->id }}, '{{ addslashes($contact->name) }}', '{{ addslashes($contact->company) }}', '{{ addslashes($contact->phone) }}', '{{ addslashes($contact->email) }}', '{{ addslashes($contact->facebook) }}', this)">Edit</button>
                    <form method="POST" action="{{ route('settings.personnel-contacts.destroy', $contact->id) }}" style="display:inline;" onsubmit="return confirm('Remove this contact?')">@csrf @method('DELETE')
                        <button type="submit" class="st-btn st-btn-danger st-btn-sm">Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@endforeach
</div>
@endif

{{-- Add Contact Modal --}}
<div id="contactAddModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:9999;align-items:center;justify-content:center;padding:20px;" onclick="if(event.target===this)closeAddContactModal();">
    <div style="background:white;border-radius:12px;padding:20px 24px;width:460px;max-width:95vw;max-height:85vh;overflow-y:auto;box-shadow:0 8px 32px rgba(0,0,0,.2);border:1px solid #e2e8f0;margin:auto;">
        <div style="font-size:14px;font-weight:700;color:#0f172a;margin-bottom:14px;padding-bottom:10px;border-bottom:1px solid #f1f5f9;">Add New Contact</div>
        <form method="POST" action="{{ route('settings.personnel-contacts.store') }}">@csrf
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px;">
                <div class="st-form-group"><label class="st-label">Name <span style="color:#ef4444;">*</span></label><input class="st-input" type="text" name="name" required placeholder="Full name"></div>
                <div class="st-form-group"><label class="st-label">Company / Group</label><input class="st-input" id="addModalCompany" type="text" name="company" placeholder="e.g. Executives, Broker"></div>
                <div class="st-form-group"><label class="st-label">Contact No.</label><input class="st-input" type="text" name="phone" placeholder="+63 9XX XXX XXXX"></div>
                <div class="st-form-group"><label class="st-label">Email</label><input class="st-input" type="email" name="email" placeholder="email@example.com"></div>
            </div>
            <div class="st-form-group" style="margin-bottom:16px;"><label class="st-label">Facebook</label><input class="st-input" type="text" name="facebook" placeholder="Facebook name or URL"></div>
            <div style="display:flex;gap:10px;">
                <button type="submit" class="st-btn st-btn-primary" style="flex:1;">Add Contact</button>
                <button type="button" onclick="closeAddContactModal()" style="flex:1;padding:9px 20px;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;background:#f1f5f9;color:#374151;border:none;">Cancel</button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Contact Modal --}}
<div id="contactEditModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:9999;align-items:center;justify-content:center;" onclick="if(event.target===this)closeContactModal();">
    <div style="background:white;border-radius:12px;padding:20px 24px;width:460px;max-width:95vw;box-shadow:0 8px 32px rgba(0,0,0,.2);border:1px solid #e2e8f0;">
        <div style="font-size:14px;font-weight:700;color:#0f172a;margin-bottom:14px;padding-bottom:10px;border-bottom:1px solid #f1f5f9;">Edit Contact</div>
        <form id="contactEditForm" method="POST">@csrf @method('PUT')
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px;">
                <div class="st-form-group"><label class="st-label">Name <span style="color:#ef4444;">*</span></label><input class="st-input" type="text" id="edit_name" name="name" required></div>
                <div class="st-form-group"><label class="st-label">Company</label><input class="st-input" type="text" id="edit_company" name="company"></div>
                <div class="st-form-group"><label class="st-label">Contact No.</label><input class="st-input" type="text" id="edit_phone" name="phone"></div>
                <div class="st-form-group"><label class="st-label">Email</label><input class="st-input" type="email" id="edit_email" name="email"></div>
            </div>
            <div class="st-form-group" style="margin-bottom:14px;"><label class="st-label">Facebook</label><input class="st-input" type="text" id="edit_facebook" name="facebook"></div>
            <div style="display:flex;gap:10px;">
                <button type="submit" class="st-btn st-btn-primary" style="flex:1;">Save Changes</button>
                <button type="button" onclick="closeContactModal()" style="flex:1;padding:9px 20px;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;background:#f1f5f9;color:#374151;border:none;">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function openAddContactModal(company, btn) {
    var modal = document.getElementById('contactAddModal');
    var f = document.getElementById('addModalCompany');
    if(f) f.value = company || '';
    modal.style.display = 'flex';
}
function closeAddContactModal() { document.getElementById('contactAddModal').style.display = 'none'; }
function openContactModal(id, name, company, phone, email, facebook, btn) {
    document.getElementById('contactEditForm').action = '/settings/personnel-contacts/' + id;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_company').value = company;
    document.getElementById('edit_phone').value = phone;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_facebook').value = facebook;
    document.getElementById('contactEditModal').style.display = 'flex';
}
function closeContactModal() { document.getElementById('contactEditModal').style.display = 'none'; }
</script>

@endsection
