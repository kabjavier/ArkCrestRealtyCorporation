@extends('layouts.dashboard')
@section('title', 'Human Resource')
@section('content')

<div class="welcome-banner" style="background:linear-gradient(135deg,#1e4575 0%,#2563eb 60%,#1e4575 100%);border-radius:20px;padding:36px 40px;margin-bottom:28px;position:relative;overflow:hidden;box-shadow:0 8px 32px rgba(30,69,117,.25);">
    <div style="position:relative;z-index:2;">
        <div style="font-size:12px;font-weight:700;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:1.5px;margin-bottom:8px;">Human Resource</div>
        <h1 style="font-size:28px;font-weight:700;color:white;margin:0 0 8px;">Happy ArkCrest Morning, {{ auth()->user()->preferred_address ? auth()->user()->preferred_address.' '.auth()->user()->name : auth()->user()->name }}! 👥</h1>
        <p style="font-size:14px;color:rgba(255,255,255,.75);margin:0;display:flex;align-items:center;gap:8px;">
            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            HR Overview — {{ date('F Y') }}
        </p>
    </div>
    <div style="position:absolute;top:0;right:0;width:300px;height:100%;pointer-events:none;">
        <div style="position:absolute;width:200px;height:200px;border-radius:50%;background:rgba(255,255,255,.05);top:-60px;right:-40px;"></div>
        <div style="position:absolute;width:150px;height:150px;border-radius:50%;background:rgba(255,255,255,.05);bottom:-30px;right:80px;"></div>
    </div>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:20px;margin-bottom:28px;">

    {{-- Total Employees --}}
    <div style="background:white;border-radius:12px;padding:28px 24px;display:flex;align-items:center;gap:20px;box-shadow:0 2px 8px rgba(0,0,0,.08);border-left:5px solid #1e4575;">
        <div style="width:52px;height:52px;border-radius:12px;background:linear-gradient(135deg,#1e4575,#2563eb);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg width="24" height="24" fill="none" stroke="white" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
        <div>
            <div style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Total Employees</div>
            <div style="font-size:32px;font-weight:800;color:#0f172a;line-height:1;">{{ $totalEmployees }}</div>
            <div style="font-size:12px;color:#94a3b8;margin-top:4px;">Active staff members</div>
        </div>
    </div>

    {{-- Total Agents --}}
    <div style="background:white;border-radius:12px;padding:28px 24px;display:flex;align-items:center;gap:20px;box-shadow:0 2px 8px rgba(0,0,0,.08);border-left:5px solid #A37929;">
        <div style="width:52px;height:52px;border-radius:12px;background:linear-gradient(135deg,#A37929,#d4a03a);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg width="24" height="24" fill="none" stroke="white" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </div>
        <div>
            <div style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Total Agents</div>
            <div style="font-size:32px;font-weight:800;color:#0f172a;line-height:1;">{{ $totalAgents }}</div>
            <div style="font-size:12px;color:#94a3b8;margin-top:4px;">Users with sales-related positions</div>
        </div>
    </div>

</div>

{{-- HR Forms Section --}}
<div style="margin-bottom:12px;">
    <div style="font-size:13px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin-bottom:20px;display:flex;align-items:center;gap:8px;">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        HR Forms
    </div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:32px;align-items:start;">

        {{-- Form 1: Change Day-Off --}}
        <div style="display:flex;flex-direction:column;align-items:center;gap:10px;cursor:pointer;" onclick="openHrForm('dayoff')"
            onmouseover="this.querySelector('.doc-card').style.transform='scale(1.04) translateY(-4px)';this.querySelector('.doc-card').style.boxShadow='0 16px 48px rgba(0,0,0,.22)'"
            onmouseout="this.querySelector('.doc-card').style.transform='scale(1) translateY(0)';this.querySelector('.doc-card').style.boxShadow='4px 4px 0 #d1d5db,0 4px 16px rgba(0,0,0,.12)'">
            <div class="doc-card" style="width:100%;background:white;border:1px solid #e2e8f0;border-radius:4px;box-shadow:4px 4px 0 #d1d5db,0 4px 16px rgba(0,0,0,.12);transition:all .25s;padding:18px 16px;min-height:220px;position:relative;overflow:hidden;">
                {{-- Top accent bar --}}
                <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#1e4575,#2563eb);"></div>
                {{-- Mini form preview --}}
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:10px;margin-top:4px;">
                    <img src="{{ asset('images/ArkCrest_Logo.png') }}" style="width:22px;height:22px;object-fit:contain;opacity:.7;">
                    <div style="font-size:9px;font-weight:800;color:#1e4575;text-transform:uppercase;letter-spacing:.5px;">Change Day-Off Form</div>
                </div>
                <div style="height:1px;background:#e2e8f0;margin-bottom:8px;"></div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:4px;margin-bottom:6px;">
                    @foreach(['Name','Position','Prev. Day-Off','Department','New Day-Off','Date (Week)'] as $f)
                    <div style="font-size:7px;color:#94a3b8;">{{ $f }}: <span style="display:inline-block;width:50px;border-bottom:1px solid #cbd5e1;">&nbsp;</span></div>
                    @endforeach
                </div>
                <div style="font-size:7px;color:#94a3b8;margin-bottom:3px;">Reason:</div>
                <div style="border:1px solid #e2e8f0;height:36px;border-radius:2px;margin-bottom:8px;"></div>
                <div style="display:flex;justify-content:space-between;">
                    <div style="font-size:6px;color:#64748b;">Approved by:<br><span style="font-weight:700;text-decoration:underline;">Mr. Edwin Mojica</span></div>
                    <div style="font-size:6px;color:#64748b;">Acknowledged by:<br><span style="font-weight:700;text-decoration:underline;">Mr. Jossen Fernandez</span></div>
                </div>
            </div>
            <div style="font-size:13px;font-weight:600;color:#374151;text-align:center;">Change Day-Off Form</div>
            <div style="font-size:11px;color:#94a3b8;text-align:center;">Click to open &amp; print</div>
        </div>

        {{-- Form 2: Absences Report --}}
        <div style="display:flex;flex-direction:column;align-items:center;gap:10px;cursor:pointer;" onclick="openHrForm('absences')"
            onmouseover="this.querySelector('.doc-card').style.transform='scale(1.04) translateY(-4px)';this.querySelector('.doc-card').style.boxShadow='0 16px 48px rgba(0,0,0,.22)'"
            onmouseout="this.querySelector('.doc-card').style.transform='scale(1) translateY(0)';this.querySelector('.doc-card').style.boxShadow='4px 4px 0 #d1d5db,0 4px 16px rgba(0,0,0,.12)'">
            <div class="doc-card" style="width:100%;background:white;border:1px solid #e2e8f0;border-radius:4px;box-shadow:4px 4px 0 #d1d5db,0 4px 16px rgba(0,0,0,.12);transition:all .25s;padding:18px 16px;min-height:220px;position:relative;overflow:hidden;">
                <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#A37929,#d4a03a);"></div>
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:10px;margin-top:4px;">
                    <img src="{{ asset('images/ArkCrest_Logo.png') }}" style="width:22px;height:22px;object-fit:contain;opacity:.7;">
                    <div style="font-size:9px;font-weight:800;color:#A37929;text-transform:uppercase;letter-spacing:.5px;">Absences Report Form</div>
                </div>
                <div style="height:1px;background:#e2e8f0;margin-bottom:8px;"></div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:4px;margin-bottom:6px;">
                    @foreach(['Name','Department','Date Today','&nbsp;'] as $f)
                    <div style="font-size:7px;color:#94a3b8;">{{ $f }}: <span style="display:inline-block;width:50px;border-bottom:1px solid #cbd5e1;">&nbsp;</span></div>
                    @endforeach
                </div>
                <div style="font-size:7px;color:#94a3b8;margin-bottom:3px;">Explanation:</div>
                <div style="border:1px solid #e2e8f0;height:60px;border-radius:2px;margin-bottom:8px;"></div>
                <div style="display:flex;justify-content:space-between;">
                    <div style="font-size:6px;color:#64748b;">Assessed by:<br><span style="display:inline-block;width:60px;border-bottom:1px solid #94a3b8;">&nbsp;</span></div>
                    <div style="font-size:6px;color:#64748b;">Acknowledged by:<br><span style="display:inline-block;width:60px;border-bottom:1px solid #94a3b8;">&nbsp;</span></div>
                </div>
            </div>
            <div style="font-size:13px;font-weight:600;color:#374151;text-align:center;">Absences Report Form</div>
            <div style="font-size:11px;color:#94a3b8;text-align:center;">Click to open &amp; print</div>
        </div>

        {{-- Form 3: Allowance Voucher --}}
        <div style="display:flex;flex-direction:column;align-items:center;gap:10px;cursor:pointer;" onclick="openHrForm('voucher')"
            onmouseover="this.querySelector('.doc-card').style.transform='scale(1.04) translateY(-4px)';this.querySelector('.doc-card').style.boxShadow='0 16px 48px rgba(0,0,0,.22)'"
            onmouseout="this.querySelector('.doc-card').style.transform='scale(1) translateY(0)';this.querySelector('.doc-card').style.boxShadow='4px 4px 0 #d1d5db,0 4px 16px rgba(0,0,0,.12)'">
            <div class="doc-card" style="width:100%;background:white;border:1px solid #e2e8f0;border-radius:4px;box-shadow:4px 4px 0 #d1d5db,0 4px 16px rgba(0,0,0,.12);transition:all .25s;padding:18px 16px;min-height:220px;position:relative;overflow:hidden;">
                <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#0f2444,#1e4575);"></div>
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:10px;margin-top:4px;">
                    <img src="{{ asset('images/ArkCrest_Logo.png') }}" style="width:22px;height:22px;object-fit:contain;opacity:.7;">
                    <div style="font-size:9px;font-weight:800;color:#0f2444;text-transform:uppercase;letter-spacing:.5px;">Allowance Voucher ARCS</div>
                </div>
                <div style="height:1px;background:#e2e8f0;margin-bottom:6px;"></div>
                {{-- Mini table --}}
                <table style="width:100%;border-collapse:collapse;font-size:6px;margin-bottom:6px;">
                    <tr style="background:#f1f5f9;"><td style="border:1px solid #e2e8f0;padding:2px 4px;">Employee Name</td><td style="border:1px solid #e2e8f0;padding:2px 4px;"></td><td style="border:1px solid #e2e8f0;padding:2px 4px;">Designation</td><td style="border:1px solid #e2e8f0;padding:2px 4px;"></td></tr>
                    <tr><td style="border:1px solid #e2e8f0;padding:2px 4px;">Pay Period</td><td style="border:1px solid #e2e8f0;padding:2px 4px;"></td><td style="border:1px solid #e2e8f0;padding:2px 4px;">Department</td><td style="border:1px solid #e2e8f0;padding:2px 4px;"></td></tr>
                    <tr style="background:#f1f5f9;"><td style="border:1px solid #e2e8f0;padding:2px 4px;font-weight:700;">Earnings</td><td style="border:1px solid #e2e8f0;padding:2px 4px;font-weight:700;">Amt</td><td style="border:1px solid #e2e8f0;padding:2px 4px;font-weight:700;">Deductions</td><td style="border:1px solid #e2e8f0;padding:2px 4px;font-weight:700;">Amt</td></tr>
                    <tr><td style="border:1px solid #e2e8f0;padding:2px 4px;">Basic Pay</td><td style="border:1px solid #e2e8f0;padding:2px 4px;"></td><td style="border:1px solid #e2e8f0;padding:2px 4px;">Absences</td><td style="border:1px solid #e2e8f0;padding:2px 4px;"></td></tr>
                    <tr><td style="border:1px solid #e2e8f0;padding:2px 4px;font-weight:700;text-align:right;" colspan="2">Total:</td><td style="border:1px solid #e2e8f0;padding:2px 4px;font-weight:700;text-align:right;" colspan="2">Net Pay: ₱</td></tr>
                </table>
                <div style="display:flex;justify-content:space-between;">
                    <div style="font-size:6px;color:#64748b;">Prepared by</div>
                    <div style="font-size:6px;color:#64748b;">Approved by</div>
                    <div style="font-size:6px;color:#64748b;">Received by</div>
                </div>
            </div>
            <div style="font-size:13px;font-weight:600;color:#374151;text-align:center;">Allowance Voucher ARCS</div>
            <div style="font-size:11px;color:#94a3b8;text-align:center;">Click to open &amp; print</div>
        </div>

    </div>
</div>

        {{-- Form 1: Change Day-Off --}}
        <div onclick="openHrForm('dayoff')" style="background:white;border-radius:14px;box-shadow:0 2px 12px rgba(0,0,0,.08);cursor:pointer;transition:transform .2s,box-shadow .2s;overflow:hidden;border:1.5px solid #e2e8f0;"
            onmouseover="this.style.transform='scale(1.03)';this.style.boxShadow='0 8px 32px rgba(30,69,117,.18)'"
            onmouseout="this.style.transform='scale(1)';this.style.boxShadow='0 2px 12px rgba(0,0,0,.08)'">
            <div style="background:linear-gradient(135deg,#1e4575,#2563eb);padding:14px 18px;display:flex;align-items:center;gap:10px;">
                <svg width="20" height="20" fill="none" stroke="white" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span style="font-size:13px;font-weight:700;color:white;">Change Day-Off Form</span>
            </div>
            <div style="padding:16px 18px;">
                <div style="font-size:11px;color:#64748b;margin-bottom:10px;">For requesting a change in scheduled day-off</div>
                <div style="background:#f8fafc;border-radius:8px;padding:10px 12px;font-size:10px;color:#94a3b8;line-height:1.8;">
                    Name · Position · Department<br>Previous Day-Off · New Day-Off<br>Date (Week) · Reason<br>Approved by · Acknowledged by
                </div>
                <div style="margin-top:12px;text-align:right;">
                    <span style="font-size:11px;font-weight:700;color:#1e4575;background:#eff6ff;padding:4px 10px;border-radius:20px;">Click to Open →</span>
                </div>
            </div>
        </div>

        {{-- Form 2: Absences Report --}}
        <div onclick="openHrForm('absences')" style="background:white;border-radius:14px;box-shadow:0 2px 12px rgba(0,0,0,.08);cursor:pointer;transition:transform .2s,box-shadow .2s;overflow:hidden;border:1.5px solid #e2e8f0;"
            onmouseover="this.style.transform='scale(1.03)';this.style.boxShadow='0 8px 32px rgba(30,69,117,.18)'"
            onmouseout="this.style.transform='scale(1)';this.style.boxShadow='0 2px 12px rgba(0,0,0,.08)'">
            <div style="background:linear-gradient(135deg,#A37929,#d4a03a);padding:14px 18px;display:flex;align-items:center;gap:10px;">
                <svg width="20" height="20" fill="none" stroke="white" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <span style="font-size:13px;font-weight:700;color:white;">Absences Report Form</span>
            </div>
            <div style="padding:16px 18px;">
                <div style="font-size:11px;color:#64748b;margin-bottom:10px;">For reporting and explaining employee absences</div>
                <div style="background:#f8fafc;border-radius:8px;padding:10px 12px;font-size:10px;color:#94a3b8;line-height:1.8;">
                    Name · Department<br>Date Today · Explanation<br>Assessed by · Acknowledged by
                </div>
                <div style="margin-top:12px;text-align:right;">
                    <span style="font-size:11px;font-weight:700;color:#A37929;background:#fef9ec;padding:4px 10px;border-radius:20px;">Click to Open →</span>
                </div>
            </div>
        </div>

        {{-- Form 3: Allowance Voucher --}}
        <div onclick="openHrForm('voucher')" style="background:white;border-radius:14px;box-shadow:0 2px 12px rgba(0,0,0,.08);cursor:pointer;transition:transform .2s,box-shadow .2s;overflow:hidden;border:1.5px solid #e2e8f0;"
            onmouseover="this.style.transform='scale(1.03)';this.style.boxShadow='0 8px 32px rgba(30,69,117,.18)'"
            onmouseout="this.style.transform='scale(1)';this.style.boxShadow='0 2px 12px rgba(0,0,0,.08)'">
            <div style="background:linear-gradient(135deg,#0f2444,#1e4575);padding:14px 18px;display:flex;align-items:center;gap:10px;">
                <svg width="20" height="20" fill="none" stroke="white" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <span style="font-size:13px;font-weight:700;color:white;">Allowance Voucher ARCS</span>
            </div>
            <div style="padding:16px 18px;">
                <div style="font-size:11px;color:#64748b;margin-bottom:10px;">Employee allowance voucher with employer & employee copy</div>
                <div style="background:#f8fafc;border-radius:8px;padding:10px 12px;font-size:10px;color:#94a3b8;line-height:1.8;">
                    Employee Name · Designation<br>Pay Period · Department<br>Earnings · Deductions · Net Pay<br>Prepared · Approved · Received
                </div>
                <div style="margin-top:12px;text-align:right;">
                    <span style="font-size:11px;font-weight:700;color:#0f2444;background:#f0f4ff;padding:4px 10px;border-radius:20px;">Click to Open →</span>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- HR Form Modals --}}
<div id="hrFormModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.6);z-index:9999;align-items:flex-start;justify-content:center;overflow-y:auto;padding:30px 20px;" onclick="if(event.target===this)closeHrForm()">
    <div style="background:white;border-radius:16px;width:700px;max-width:96vw;box-shadow:0 20px 60px rgba(0,0,0,.3);overflow:hidden;">
        <div style="background:linear-gradient(135deg,#1e4575,#2563eb);padding:14px 20px;display:flex;align-items:center;justify-content:space-between;">
            <span id="hrFormTitle" style="font-size:14px;font-weight:700;color:white;"></span>
            <div style="display:flex;gap:8px;">
                <button onclick="printHrForm()" style="padding:6px 14px;background:rgba(255,255,255,.2);color:white;border:1px solid rgba(255,255,255,.3);border-radius:8px;font-size:12px;font-weight:600;cursor:pointer;">🖨 Print</button>
                <button onclick="closeHrForm()" style="padding:6px 12px;background:rgba(255,255,255,.15);color:white;border:none;border-radius:8px;font-size:16px;cursor:pointer;">&times;</button>
            </div>
        </div>
        <div id="hrFormContent" style="padding:32px 40px;font-family:'Times New Roman',serif;font-size:13px;color:#111;"></div>
    </div>
</div>

<script>
var _hrLogo = "{{ asset('images/ArkCrest_Logo.png') }}";

function openHrForm(type) {
    var modal = document.getElementById('hrFormModal');
    var content = document.getElementById('hrFormContent');
    var title = document.getElementById('hrFormTitle');
    modal.style.display = 'flex';

    if (type === 'dayoff') {
        title.textContent = 'Change Day-Off Form';
        content.innerHTML = hrFormDayOff();
    } else if (type === 'absences') {
        title.textContent = 'Absences Report Form';
        content.innerHTML = hrFormAbsences();
    } else if (type === 'voucher') {
        title.textContent = 'Allowance Voucher ARCS';
        content.innerHTML = hrFormVoucher();
    }
}

function closeHrForm() {
    document.getElementById('hrFormModal').style.display = 'none';
}

function printHrForm() {
    var content = document.getElementById('hrFormContent').innerHTML;
    var win = window.open('', '_blank');
    win.document.write('<html><head><title>HR Form</title><style>@page{size:letter;margin:0.75in} body{font-family:"Times New Roman",serif;font-size:13px;color:#111;margin:0;} table{border-collapse:collapse;width:100%;} td,th{border:1px solid #111;padding:4px 8px;} .no-border td,.no-border th{border:none;} @media print{body{margin:0;}}</style></head><body>' + content + '</body></html>');
    win.document.close();
    win.focus();
    setTimeout(function(){ win.print(); }, 400);
}

function _line(label, w) {
    return '<span style="display:inline-block;min-width:'+(w||180)+'px;border-bottom:1px solid #111;margin-left:4px;">&nbsp;</span>';
}

function hrFormDayOff() {
    return '<div style="display:flex;align-items:center;margin-bottom:20px;gap:16px;">' +
        '<img src="'+_hrLogo+'" style="width:60px;height:60px;object-fit:contain;">' +
        '<h2 style="font-size:22px;font-weight:bold;margin:0;flex:1;text-align:center;">Change Day-Off Form</h2></div>' +
        '<table style="border:none;width:100%;margin-bottom:12px;" class="no-border"><tr>' +
        '<td style="border:none;padding:6px 0;">Name:'+_line('',220)+'</td>' +
        '<td style="border:none;padding:6px 0;">Position:'+_line('',160)+'</td></tr><tr>' +
        '<td style="border:none;padding:6px 0;">Previous Day-Off Schedule:'+_line('',140)+'</td>' +
        '<td style="border:none;padding:6px 0;">Department:'+_line('',160)+'</td></tr><tr>' +
        '<td style="border:none;padding:6px 0;">New Day-Off Schedule:'+_line('',150)+'</td>' +
        '<td style="border:none;padding:6px 0;">Date (Week):'+_line('',160)+'</td></tr></table>' +
        '<div style="margin-bottom:6px;">Reason:</div>' +
        '<div style="border:1px solid #111;height:100px;margin-bottom:24px;"></div>' +
        '<table style="border:none;width:100%;" class="no-border"><tr>' +
        '<td style="border:none;width:50%;padding-top:8px;">Approved by : <strong><u>Mr. Edwin Mojica</u></strong><br><span style="font-size:11px;">(Chief Operating Officer)</span></td>' +
        '<td style="border:none;width:50%;padding-top:8px;">Acknowledged by : <strong><u>Mr. Jossen Fernandez</u></strong><br><span style="font-size:11px;">(President)</span></td>' +
        '</tr></table>';
}

function hrFormAbsences() {
    return '<div style="display:flex;align-items:center;margin-bottom:20px;gap:16px;">' +
        '<img src="'+_hrLogo+'" style="width:60px;height:60px;object-fit:contain;">' +
        '<h2 style="font-size:22px;font-weight:bold;margin:0;flex:1;text-align:center;">Absences Report Form</h2></div>' +
        '<table style="border:none;width:100%;margin-bottom:12px;" class="no-border"><tr>' +
        '<td style="border:none;padding:6px 0;">Name:'+_line('',220)+'</td>' +
        '<td style="border:none;padding:6px 0;">Department:'+_line('',180)+'</td></tr><tr>' +
        '<td style="border:none;padding:6px 0;">Date today:'+_line('',200)+'</td>' +
        '<td style="border:none;"></td></tr></table>' +
        '<div style="margin-bottom:6px;margin-top:10px;">Explanation:</div>' +
        '<div style="border:1px solid #111;height:220px;margin-bottom:24px;"></div>' +
        '<table style="border:none;width:100%;" class="no-border"><tr>' +
        '<td style="border:none;width:50%;padding-top:8px;">Assessed by:'+_line('',160)+'</td>' +
        '<td style="border:none;width:50%;padding-top:8px;">Acknowledged by:'+_line('',160)+'</td>' +
        '</tr></table>';
}

function hrFormVoucher() {
    var copy = function(label) {
        return '<p style="font-style:italic;margin:0 0 4px;">'+label+'</p>' +
        '<table style="width:100%;border-collapse:collapse;font-size:12px;margin-bottom:16px;">' +
        '<tr><td colspan="4" style="text-align:center;padding:6px;border:1px solid #111;">' +
        '<div style="display:flex;align-items:center;justify-content:center;gap:8px;">' +
        '<img src="'+_hrLogo+'" style="width:28px;height:28px;object-fit:contain;">' +
        '<div><strong>ArkCrest Realty Corporation</strong><br>Allowance Voucher ARCS &nbsp;&nbsp;&nbsp; (36-2026)</div></div></td></tr>' +
        '<tr><td style="border:1px solid #111;padding:4px 8px;">Employee Name:</td><td style="border:1px solid #111;padding:4px 8px;">'+_line('',120)+'</td>' +
        '<td style="border:1px solid #111;padding:4px 8px;">Designation:</td><td style="border:1px solid #111;padding:4px 8px;">'+_line('',100)+'</td></tr>' +
        '<tr><td style="border:1px solid #111;padding:4px 8px;">Pay Period:</td><td style="border:1px solid #111;padding:4px 8px;">'+_line('',120)+'</td>' +
        '<td style="border:1px solid #111;padding:4px 8px;">Department:</td><td style="border:1px solid #111;padding:4px 8px;">'+_line('',100)+'</td></tr>' +
        '<tr><td style="border:1px solid #111;padding:4px 8px;font-weight:bold;">Earnings</td><td style="border:1px solid #111;padding:4px 8px;font-weight:bold;">Amount</td>' +
        '<td style="border:1px solid #111;padding:4px 8px;font-weight:bold;">Deductions</td><td style="border:1px solid #111;padding:4px 8px;font-weight:bold;">Amount</td></tr>' +
        '<tr><td style="border:1px solid #111;padding:4px 8px;">Basic Pay:</td><td style="border:1px solid #111;padding:4px 8px;"></td>' +
        '<td style="border:1px solid #111;padding:4px 8px;">Number of Absences:</td><td style="border:1px solid #111;padding:4px 8px;"></td></tr>' +
        '<tr><td style="border:1px solid #111;padding:4px 8px;"></td><td style="border:1px solid #111;padding:4px 8px;"></td><td style="border:1px solid #111;padding:4px 8px;"></td><td style="border:1px solid #111;padding:4px 8px;"></td></tr>' +
        '<tr><td style="border:1px solid #111;padding:4px 8px;"></td><td style="border:1px solid #111;padding:4px 8px;"></td><td style="border:1px solid #111;padding:4px 8px;"></td><td style="border:1px solid #111;padding:4px 8px;"></td></tr>' +
        '<tr><td style="border:1px solid #111;padding:4px 8px;font-weight:bold;text-align:right;" colspan="2">Total Earnings:</td><td style="border:1px solid #111;padding:4px 8px;font-weight:bold;text-align:right;" colspan="2">Total Deductions: &nbsp;&nbsp; Net Pay: ₱</td></tr>' +
        '</table>' +
        '<table style="border:none;width:100%;font-size:12px;" class="no-border"><tr>' +
        '<td style="border:none;width:33%;">Prepared by:<br><br><u>Mr. Lourd Thristan Lobendino</u><br><span style="font-size:10px;">Human Resource Associate</span></td>' +
        '<td style="border:none;width:33%;">Approved by:<br><br><u>Mr. Edwin Mojica</u><br><span style="font-size:10px;">Chief Operating Officer</span></td>' +
        '<td style="border:none;width:33%;">Received by:<br><br><u>'+_line('',120)+'</u><br><span style="font-size:10px;">&nbsp;</span></td>' +
        '</tr></table>';
    };
    return copy("Employer's Copy") + '<hr style="margin:20px 0;border:1px dashed #999;">' + copy("Employee's Copy");
}
</script>

@endsection
