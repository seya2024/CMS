<x-filament-panels::page>
@push('styles')
<style>
.cl-dash{--c-bg:#f0f4f8;--c-card:#fff;--c-border:#e2e8f0;--c-teal:#0d9488;--c-teal-dim:rgba(13,148,136,.08);--c-green:#16a34a;--c-green-dim:rgba(22,163,74,.08);--c-red:#dc2626;--c-red-dim:rgba(220,38,38,.08);--c-amber:#d97706;--c-amber-dim:rgba(217,119,6,.08);--c-blue:#2563eb;--c-blue-dim:rgba(37,99,235,.08);--c-purple:#7c3aed;--c-purple-dim:rgba(124,58,237,.08);--c-rose:#e11d48;--c-rose-dim:rgba(225,29,72,.08);--c-indigo:#4f46e5;--c-indigo-dim:rgba(79,70,229,.08);--c-t1:#0f172a;--c-t2:#475569;--c-t3:#94a3b8;font-family:'Inter',-apple-system,sans-serif;background:var(--c-bg);color:var(--c-t1);min-height:calc(100vh - 120px);padding:0;margin:-20px -24px}
.cl-dash *{box-sizing:border-box}
.cl-load{position:fixed;top:0;left:0;right:0;height:3px;z-index:9999;overflow:hidden;pointer-events:none;opacity:0;transition:opacity .2s}
.cl-load.on{opacity:1}
.cl-load-in{height:100%;width:40%;background:linear-gradient(90deg,transparent,var(--c-teal),var(--c-green),transparent);animation:clsl 1s ease-in-out infinite}
@keyframes clsl{0%{transform:translateX(-100%)}100%{transform:translateX(350%)}}
.cl-flash{animation:clfl .5s ease}
@keyframes clfl{0%{opacity:1}20%{opacity:.3}100%{opacity:1}}

.cl-hdr {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 28px;
    background: linear-gradient(135deg, #06569F 0%, #EEF4FA 100%);
    position: relative;
}

.cl-hdr::after{content:'';position:absolute;bottom:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--c-teal),var(--c-green),var(--c-teal))}
.cl-hdr-left{display:flex;align-items:center;gap:16px}
.cl-logo{width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg,var(--c-teal),#14b8a6);display:flex;align-items:center;justify-content:center;box-shadow:0 4px 16px rgba(13,148,136,.3)}
.cl-logo svg{width:24px;height:24px;color:#fff}
.cl-logo-text h1{font-size:18px;font-weight:800;color:#fff;letter-spacing:.5px;line-height:1.2}
.cl-logo-sub{font-size:11px;color:var(--c-t3);letter-spacing:.3px;margin-top:2px}
.cl-hdr-sep{width:1px;height:36px;background:linear-gradient(180deg,transparent,rgba(255,255,255,.1),transparent)}
.cl-hdr-right{display:flex;align-items:center;gap:20px}
.cl-clock{text-align:right}
.cl-clock-t{font-size:24px;font-weight:800;font-family:'JetBrains Mono',monospace;color:#fff;letter-spacing:1px;line-height:1}
.cl-clock-t .cl-sec{font-size:13px;color:#5eead4;font-weight:600}
.cl-clock-d{font-size:11px;color:var(--c-t3);margin-top:2px}
.cl-ref-info{display:flex;flex-direction:column;align-items:flex-end;gap:4px}
.cl-last-upd{display:flex;align-items:center;gap:6px;font-size:10px;color:var(--c-t3)}
.cl-upd-t{font-family:'JetBrains Mono',monospace;color:#5eead4;font-weight:600}
.cl-cd-bar{width:80px;height:3px;border-radius:2px;background:rgba(13,148,136,.15);overflow:hidden}
.cl-cd-fill{height:100%;border-radius:2px;background:var(--c-teal);transition:width 1s linear}
.cl-hdr-mid{display:flex;align-items:center;gap:24px}
.cl-hdr-stat{display:flex;flex-direction:column;align-items:center;gap:2px}
.cl-hdr-stat-l{font-size:9px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:var(--c-t3)}
.cl-hdr-stat-v{font-size:13px;font-weight:700}
.cl-hdr-stat-v.teal{color:#5eead4}.cl-hdr-stat-v.green{color:#86efac}.cl-hdr-stat-v.amber{color:#fcd34d}.cl-hdr-stat-v.red{color:#fca5a5}
.cl-hdr-pill{display:flex;align-items:center;gap:8px;padding:7px 16px;border-radius:8px;background:rgba(13,148,136,.12);border:1px solid rgba(13,148,136,.25)}
.cl-hdr-dot{width:8px;height:8px;border-radius:50%;background:#5eead4;box-shadow:0 0 10px rgba(94,234,212,.5);animation:chdp 2.5s ease-in-out infinite;position:relative}
.cl-hdr-dot::after{content:'';position:absolute;inset:-3px;border-radius:50%;border:1.5px solid rgba(94,234,212,.3);animation:chpr 2.5s ease-in-out infinite}
@keyframes chdp{0%,100%{opacity:1}50%{opacity:.6}}
@keyframes chpr{0%{transform:scale(1);opacity:.6}100%{transform:scale(2.5);opacity:0}}
.cl-hdr-pill-txt{font-size:12px;font-weight:700;color:#5eead4;letter-spacing:.5px}
.cl-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;padding:20px 28px 0}
@media(min-width:1200px){.cl-stats{grid-template-columns:repeat(8,1fr)}}
.cl-sc{background:var(--c-card);border:1px solid var(--c-border);border-radius:10px;padding:16px;position:relative;overflow:hidden;transition:transform .2s,box-shadow .2s}
.cl-sc:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(0,0,0,.06)}
.cl-sc::before{content:'';position:absolute;top:0;left:0;width:4px;height:100%;border-radius:4px 0 0 4px}
.cl-sc.sc-teal::before{background:var(--c-teal)}.cl-sc.sc-green::before{background:var(--c-green)}.cl-sc.sc-amber::before{background:var(--c-amber)}.cl-sc.sc-red::before{background:var(--c-red)}.cl-sc.sc-blue::before{background:var(--c-blue)}.cl-sc.sc-purple::before{background:var(--c-purple)}.cl-sc.sc-rose::before{background:var(--c-rose)}.cl-sc.sc-indigo::before{background:var(--c-indigo)}
.cl-sc-l{font-size:10px;color:var(--c-t3);text-transform:uppercase;letter-spacing:.8px;font-weight:600}
.cl-sc-v{font-size:28px;font-weight:900;margin:4px 0 2px;line-height:1;font-family:'JetBrains Mono',monospace}
.cl-sc.sc-teal .cl-sc-v{color:var(--c-teal)}.cl-sc.sc-green .cl-sc-v{color:var(--c-green)}.cl-sc.sc-amber .cl-sc-v{color:var(--c-amber)}.cl-sc.sc-red .cl-sc-v{color:var(--c-red)}.cl-sc.sc-blue .cl-sc-v{color:var(--c-blue)}.cl-sc.sc-purple .cl-sc-v{color:var(--c-purple)}.cl-sc.sc-rose .cl-sc-v{color:var(--c-rose)}.cl-sc.sc-indigo .cl-sc-v{color:var(--c-indigo)}
.cl-sc-s{font-size:11px;color:var(--c-t2)}.cl-sc-s span{font-weight:700}
.cl-grid{display:grid;grid-template-columns:1fr;gap:14px;padding:16px 28px 0}
@media(min-width:1200px){.cl-grid{grid-template-columns:1fr 340px 300px}}
.cl-pnl{background:var(--c-card);border:1px solid var(--c-border);border-radius:14px;overflow:hidden}
.cl-pnl-h{display:flex;align-items:center;justify-content:space-between;padding:14px 18px;border-bottom:1px solid var(--c-border);background:#f8fafc}
.cl-pnl-t{font-size:13px;font-weight:700;color:var(--c-t1)}
.cl-pnl-c{font-size:10px;font-weight:700;padding:3px 10px;border-radius:6px;font-family:'JetBrains Mono',monospace}
.cl-tbl{width:100%;border-collapse:collapse}
.cl-tbl thead th{font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.7px;color:var(--c-t3);padding:10px 14px;text-align:left;border-bottom:1px solid var(--c-border);background:#f8fafc}
.cl-tbl tbody tr{border-bottom:1px solid #f1f5f9}.cl-tbl tbody tr:last-child{border-bottom:none}.cl-tbl tbody tr:hover{background:#f8fafc}
.cl-tbl td{padding:10px 14px;font-size:12px;color:var(--c-t2);white-space:nowrap}
.cl-tbl td:nth-child(1){color:var(--c-teal);font-weight:700;font-family:'JetBrains Mono',monospace;font-size:11px}
.cl-tbl td:nth-child(2){color:var(--c-t1);font-weight:600}
.cl-st-chip{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:5px;font-size:10px;font-weight:700;letter-spacing:.3px}
.cl-st-chip.completed{background:var(--c-green-dim);color:var(--c-green)}.cl-st-chip.in-progress{background:var(--c-blue-dim);color:var(--c-blue)}.cl-st-chip.waiting{background:var(--c-amber-dim);color:var(--c-amber)}.cl-st-chip.scheduled{background:rgba(148,163,184,.08);color:var(--c-t3)}
.cl-st-chip .cd{width:5px;height:5px;border-radius:50%;background:currentColor}
.cl-type-chip{display:inline-flex;padding:2px 8px;border-radius:4px;font-size:10px;font-weight:600;background:var(--c-teal-dim);color:var(--c-teal)}
.cl-doc{display:flex;align-items:center;gap:12px;padding:12px 18px;border-bottom:1px solid #f1f5f9}.cl-doc:last-child{border-bottom:none}.cl-doc:hover{background:#f8fafc}
.cl-doc-avatar{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;color:#fff;flex-shrink:0}
.cl-doc-info{flex:1;min-width:0}.cl-doc-name{font-size:12px;font-weight:600;color:var(--c-t1);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.cl-doc-spec{font-size:10px;color:var(--c-t3);margin-top:1px}
.cl-doc-right{display:flex;flex-direction:column;align-items:flex-end;gap:4px}.cl-doc-pat{font-size:10px;color:var(--c-t2);font-family:'JetBrains Mono',monospace}
.cl-doc-st{display:flex;align-items:center;gap:4px;padding:2px 8px;border-radius:4px;font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:.5px}
.cl-doc-st.consulting{background:var(--c-blue-dim);color:var(--c-blue)}.cl-doc-st.available{background:var(--c-green-dim);color:var(--c-green)}.cl-doc-st.break{background:var(--c-amber-dim);color:var(--c-amber)}.cl-doc-st.in-surgery{background:var(--c-red-dim);color:var(--c-red)}
.cl-q{display:flex;align-items:center;gap:12px;padding:11px 18px;border-bottom:1px solid #f1f5f9}.cl-q:last-child{border-bottom:none}
.cl-q-no{width:42px;height:42px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:800;font-family:'JetBrains Mono',monospace;flex-shrink:0;background:#f1f5f9;color:var(--c-t2)}
.cl-q-no.q-urgent{background:var(--c-amber-dim);color:var(--c-amber)}.cl-q-no.q-emergency{background:var(--c-red-dim);color:var(--c-red);animation:clpulse 1.5s ease-in-out infinite}
@keyframes clpulse{0%,100%{box-shadow:0 0 0 0 rgba(220,38,38,.2)}50%{box-shadow:0 0 0 6px rgba(220,38,38,0)}}
.cl-q-info{flex:1;min-width:0}.cl-q-pat{font-size:12px;font-weight:600;color:var(--c-t1)}.cl-q-dept{font-size:10px;color:var(--c-t3);margin-top:1px}
.cl-q-wait{font-size:11px;font-weight:700;font-family:'JetBrains Mono',monospace;color:var(--c-t3);text-align:right}.cl-q-wait span{font-size:9px;font-weight:500;display:block;color:var(--c-t3)}
.cl-lab{display:flex;align-items:center;gap:12px;padding:11px 18px;border-bottom:1px solid #f1f5f9}.cl-lab:last-child{border-bottom:none}
.cl-lab-dot{width:8px;height:8px;border-radius:50%;flex-shrink:0}.cl-lab-dot.normal{background:var(--c-green)}.cl-lab-dot.review{background:var(--c-amber)}.cl-lab-dot.critical{background:var(--c-red);box-shadow:0 0 8px rgba(220,38,38,.3)}
.cl-lab-info{flex:1}.cl-lab-pat{font-size:12px;font-weight:600;color:var(--c-t1)}.cl-lab-test{font-size:10px;color:var(--c-t3);margin-top:1px}
.cl-lab-st{font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.5px}.cl-lab-st.normal{color:var(--c-green)}.cl-lab-st.review{color:var(--c-amber)}.cl-lab-st.critical{color:var(--c-red)}
.cl-lab-time{font-size:10px;color:var(--c-t3);text-align:right;white-space:nowrap}
.cl-bot{display:grid;grid-template-columns:1fr;gap:14px;padding:14px 28px 24px}
@media(min-width:1200px){.cl-bot{grid-template-columns:1fr 1fr 1fr}}
.cl-dept{display:flex;align-items:center;gap:12px;padding:10px 18px;border-bottom:1px solid #f1f5f9}.cl-dept:last-child{border-bottom:none}
.cl-dept-info{flex:1}.cl-dept-name{font-size:12px;font-weight:600;color:var(--c-t1)}.cl-dept-rev{font-size:10px;color:var(--c-t3);font-family:'JetBrains Mono',monospace;margin-top:1px}
.cl-dept-right{text-align:right}.cl-dept-pat{font-size:14px;font-weight:800;color:var(--c-t1);font-family:'JetBrains Mono',monospace}.cl-dept-pat span{font-size:10px;font-weight:500;color:var(--c-t3)}
.cl-dept-trend{font-size:10px;font-weight:700;font-family:'JetBrains Mono',monospace;margin-top:2px}.cl-dept-trend.up{color:var(--c-green)}.cl-dept-trend.down{color:var(--c-red)}
.cl-ward{display:flex;align-items:center;gap:12px;padding:10px 18px;border-bottom:1px solid #f1f5f9}.cl-ward:last-child{border-bottom:none}
.cl-ward-name{flex:1;font-size:12px;font-weight:600;color:var(--c-t1)}
.cl-ward-bar{width:80px;height:6px;border-radius:3px;background:#f1f5f9;overflow:hidden}
.cl-ward-bar-f{height:100%;border-radius:3px;transition:width .8s ease}
.w-teal{background:var(--c-teal)}.w-red{background:var(--c-red)}.w-amber{background:var(--c-amber)}.w-purple{background:var(--c-purple)}
.cl-ward-pct{font-size:12px;font-weight:700;font-family:'JetBrains Mono',monospace;color:var(--c-t2);width:40px;text-align:right}
.cl-flow-bars{display:flex;align-items:flex-end;gap:4px;height:80px;margin-top:14px}
.cl-flow-bar{flex:1;border-radius:3px 3px 0 0;background:linear-gradient(180deg,var(--c-teal),rgba(13,148,136,.15));transition:height .5s ease}
.cl-flow-bar.peak{background:linear-gradient(180deg,var(--c-green),rgba(22,163,74,.15))}
@media(max-width:1200px){.cl-hdr-mid{display:none}}
</style>
@endpush

<div class="cl-load" id="clLoadBar"><div class="cl-load-in"></div></div>

<div class="cl-dash" x-data="{ lastRefreshed:'{{ $lastRefreshed }}', refreshSec:30, countdown:30, init(){ this.startCountdown(); window.addEventListener('livewire:update',()=>{ this.lastRefreshed='{{ $lastRefreshed }}'; this.countdown=this.refreshSec; }); }, startCountdown(){ setInterval(()=>{ this.countdown--; if(this.countdown<=0) this.countdown=this.refreshSec; },1000); } }" wire:poll.30s="refreshData">

    <div class="cl-hdr">
        <div class="cl-hdr-left">
            <div class="cl-logo"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17l-5.1-3.026a.75.75 0 01-.02-1.29l5.1-2.928a.75.75 0 01.74 0l5.1 2.928a.75.75 0 01-.02 1.29l-5.1 3.026a.75.75 0 01-.74 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 10.5c0 .87-.55 1.63-1.33 1.92"/><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 10.5c0 .87.55 1.63 1.33 1.92"/></svg></div>
            <div><div class="cl-logo-text"><h1>Higher Clinic</h1></div><div class="cl-logo-sub">Comprehensive Clinic Management System</div></div>
        </div>
        <div class="cl-hdr-sep"></div>
        <div class="cl-hdr-mid">
            <div class="cl-hdr-stat"><span class="cl-hdr-stat-l">Today</span><span class="cl-hdr-stat-v teal">{{ $this->getOverviewStats()['today_appointments'] }}</span></div>
            <div class="cl-hdr-stat"><span class="cl-hdr-stat-l">Done</span><span class="cl-hdr-stat-v green">{{ $this->getOverviewStats()['completed_today'] }}</span></div>
            <div class="cl-hdr-stat"><span class="cl-hdr-stat-l">Waiting</span><span class="cl-hdr-stat-v amber">{{ $this->getOverviewStats()['pending_today'] }}</span></div>
            <div class="cl-hdr-stat"><span class="cl-hdr-stat-l">Emergency</span><span class="cl-hdr-stat-v red">{{ $this->getOverviewStats()['emergency_cases'] }}</span></div>
            <div class="cl-hdr-pill"><span class="cl-hdr-dot"></span><span class="cl-hdr-pill-txt">LIVE</span></div>
        </div>
        <div class="cl-hdr-sep"></div>
        <div class="cl-hdr-right">
            <div class="cl-ref-info"><div class="cl-last-upd">Updated <span class="cl-upd-t" x-text="lastRefreshed"></span></div><div class="cl-cd-bar"><div class="cl-cd-fill" :style="'width:'+(countdown/refreshSec*100)+'%'"></div></div></div>
            <div class="cl-hdr-sep"></div>
            <div class="cl-clock"><div class="cl-clock-t" id="clClock">--:--<span class="cl-sec">:--</span></div><div class="cl-clock-d" id="clDate">---</div></div>
        </div>
    </div>

    <div class="cl-stats">
        <div class="cl-sc sc-teal"><div class="cl-sc-l">Total Patients</div><div class="cl-sc-v">{{ number_format($this->getOverviewStats()['total_patients']) }}</div><div class="cl-sc-s">Registered</div></div>
        <div class="cl-sc sc-blue"><div class="cl-sc-l">Today Reg.</div><div class="cl-sc-v">{{ $this->getOverviewStats()['today_registered'] }}</div><div class="cl-sc-s"><span>+12%</span> vs yesterday</div></div>
        <div class="cl-sc sc-green"><div class="cl-sc-l">Completed</div><div class="cl-sc-v">{{ $this->getOverviewStats()['completed_today'] }}</div><div class="cl-sc-s">{{ $this->getOverviewStats()['today_appointments'] }} total</div></div>
        <div class="cl-sc sc-amber"><div class="cl-sc-l">Avg Wait</div><div class="cl-sc-v">{{ $this->getOverviewStats()['avg_wait_time'] }}<span style="font-size:14px;font-weight:500">m</span></div><div class="cl-sc-s">Target less than 20m</div></div>
        <div class="cl-sc sc-rose"><div class="cl-sc-l">Revenue</div><div class="cl-sc-v" style="font-size:22px">{{ $this->getOverviewStats()['revenue_today'] }}</div><div class="cl-sc-s">{{ $this->getOverviewStats()['revenue_month'] }} mo</div></div>
        <div class="cl-sc sc-purple"><div class="cl-sc-l">Doctors</div><div class="cl-sc-v">{{ $this->getOverviewStats()['active_doctors'] }}</div><div class="cl-sc-s">of 16 on roster</div></div>
        <div class="cl-sc sc-indigo"><div class="cl-sc-l">Beds</div><div class="cl-sc-v">{{ $this->getOverviewStats()['occupancy_pct'] }}%</div><div class="cl-sc-s">{{ $this->getOverviewStats()['available_beds'] }}/{{ $this->getOverviewStats()['total_beds'] }} free</div></div>
        <div class="cl-sc sc-teal"><div class="cl-sc-l">Satisfaction</div><div class="cl-sc-v">{{ $this->getOverviewStats()['patient_satisfaction'] }}%</div><div class="cl-sc-s">Feedback score</div></div>
    </div>

    <div class="cl-grid">
        <div class="cl-pnl">
            <div class="cl-pnl-h"><span class="cl-pnl-t">Appointments</span><span class="cl-pnl-c" style="background:var(--c-teal-dim);color:var(--c-teal)">{{ count($this->getTodayAppointments()) }}</span></div>
            <div style="overflow-x:auto">
                <table class="cl-tbl">
                    <thead><tr><th>ID</th><th>Patient</th><th>Doctor</th><th>Dept</th><th>Time</th><th>Type</th><th>Status</th></tr></thead>
                    <tbody>
                        @foreach($this->getTodayAppointments() as $apt)
                        <tr>
                            <td>{{ $apt['id'] }}</td>
                            <td>{{ $apt['patient'] }}</td>
                            <td>{{ $apt['doctor'] }}</td>
                            <td>{{ $apt['dept'] }}</td>
                            <td>{{ $apt['time'] }}</td>
                            <td><span class="cl-type-chip">{{ $apt['type'] }}</span></td>
                            <td><span class="cl-st-chip {{ $apt['status'] }}"><span class="cd"></span>{{ str_replace('-', ' ', ucfirst($apt['status'])) }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="cl-pnl">
            <div class="cl-pnl-h"><span class="cl-pnl-t">Doctors on Duty</span><span class="cl-pnl-c" style="background:var(--c-green-dim);color:var(--c-green)">{{ $this->getOverviewStats()['active_doctors'] }}</span></div>
            <div style="max-height:440px;overflow-y:auto">
                @foreach($this->getDoctorsOnDuty() as $doc)
                <div class="cl-doc">
                    <div class="cl-doc-avatar" style="background:var(--c-{{ $doc['color'] }})">{{ $doc['avatar'] }}</div>
                    <div class="cl-doc-info"><div class="cl-doc-name">{{ $doc['name'] }}</div><div class="cl-doc-spec">{{ $doc['specialty'] }}</div></div>
                    <div class="cl-doc-right"><span class="cl-doc-pat">{{ $doc['patients'] }} pts</span><span class="cl-doc-st {{ $doc['status'] }}"><span class="cd"></span>{{ ucfirst(str_replace('-', ' ', $doc['status'])) }}</span></div>
                </div>
                @endforeach
            </div>
        </div>

        <div style="display:flex;flex-direction:column;gap:14px">
            <div class="cl-pnl" style="flex:1">
                <div class="cl-pnl-h"><span class="cl-pnl-t">Patient Queue</span><span class="cl-pnl-c" style="background:var(--c-amber-dim);color:var(--c-amber)">{{ count($this->getPatientQueue()) }}</span></div>
                <div>
                    @foreach($this->getPatientQueue() as $q)
                    <div class="cl-q">
                        <div class="cl-q-no {{ $q['priority'] === 'urgent' ? 'q-urgent' : ($q['priority'] === 'emergency' ? 'q-emergency' : '') }}">{{ $q['queue_no'] }}</div>
                        <div class="cl-q-info"><div class="cl-q-pat">{{ $q['patient'] }}</div><div class="cl-q-dept">{{ $q['dept'] }}</div></div>
                        <div class="cl-q-wait">{{ $q['wait_min'] }}<span>min</span></div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="cl-pnl" style="flex:1">
                <div class="cl-pnl-h"><span class="cl-pnl-t">Lab Results</span></div>
                <div>
                    @foreach($this->getRecentLabResults() as $lab)
                    <div class="cl-lab">
                        <span class="cl-lab-dot {{ $lab['status'] }}"></span>
                        <div class="cl-lab-info"><div class="cl-lab-pat">{{ $lab['patient'] }}</div><div class="cl-lab-test">{{ $lab['test'] }}</div></div>
                        <div style="text-align:right"><div class="cl-lab-st {{ $lab['status'] }}">{{ ucfirst($lab['status']) }}</div><div class="cl-lab-time">{{ $lab['time'] }}</div></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="cl-bot">
        <div class="cl-pnl">
            <div class="cl-pnl-h"><span class="cl-pnl-t">Departments</span></div>
            <div>
                @foreach($this->getDepartmentStats() as $dept)
                <div class="cl-dept">
                    <div class="cl-dept-info"><div class="cl-dept-name">{{ $dept['name'] }}</div><div class="cl-dept-rev">{{ $dept['revenue'] }}</div></div>
                    <div class="cl-dept-right"><div class="cl-dept-pat">{{ $dept['patients'] }} <span>pts</span></div><div class="cl-dept-trend {{ $dept['trend'] > 0 ? 'up' : 'down' }}">{{ $dept['trend'] > 0 ? '↑' : '↓' }}{{ abs($dept['trend']) }}%</div></div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="cl-pnl">
            <div class="cl-pnl-h"><span class="cl-pnl-t">Ward Occupancy</span><span class="cl-pnl-c" style="background:var(--c-amber-dim);color:var(--c-amber)">{{ $this->getOverviewStats()['available_beds'] }} free</span></div>
            <div>
                @foreach($this->getWardStats() as $w)
                <div class="cl-ward">
                    <span class="cl-ward-name">{{ $w['ward'] }}</span>
                    <div class="cl-ward-bar"><div class="cl-ward-bar-f w-{{ $w['color'] }}" style="width:{{ round($w['occupied']/$w['total']*100) }}%"></div></div>
                    <span class="cl-ward-pct">{{ $w['occupied'] }}/{{ $w['total'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
        <div class="cl-pnl">
            <div class="cl-pnl-h"><span class="cl-pnl-t">Hourly Flow</span></div>
            <div style="padding:0 18px 16px">
                @php $maxFlow = max($this->getHourlyFlow()); @endphp
                <div class="cl-flow-bars">
                    @foreach($this->getHourlyFlow() as $v)
                    @php $h = $maxFlow > 0 ? ($v / $maxFlow * 100) : 0; @endphp
                    <div class="cl-flow-bar {{ $v >= 28 ? 'peak' : '' }}" style="height:{{ max($h, 2) }}%"></div>
                    @endforeach
                </div>
                <div style="display:flex;justify-content:space-between;margin-top:6px"><span style="font-size:10px;color:var(--c-t3)">12 AM</span><span style="font-size:10px;color:var(--c-t3)">Now</span></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function updClClock(){const n=new Date();const h=String(n.getHours()).padStart(2,'0'),m=String(n.getMinutes()).padStart(2,'0'),s=String(n.getSeconds()).padStart(2,'0');const ce=document.getElementById('clClock');if(ce)ce.innerHTML=h+':'+m+'<span class="cl-sec">:'+s+'</span>';const ds=['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];const ms=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];const de=document.getElementById('clDate');if(de)de.textContent=ds[n.getDay()]+', '+ms[n.getMonth()]+' '+n.getDate()+', '+n.getFullYear()}
updClClock();setInterval(updClClock,1000);
const lb=document.getElementById('clLoadBar');document.addEventListener('livewire:dispatch',e=>{if(e.detail.method==='refreshData'&&lb)lb.classList.add('on')});document.addEventListener('livewire:update',()=>{setTimeout(()=>{if(lb)lb.classList.remove('on')},300);document.querySelectorAll('.cl-sc-v').forEach(el=>{el.classList.remove('cl-flash');void el.offsetWidth;el.classList.add('cl-flash')})});
document.addEventListener('DOMContentLoaded',()=>{document.querySelectorAll('.cl-flow-bar').forEach((el,i)=>{const h=el.style.height;el.style.height='0%';setTimeout(()=>requestAnimationFrame(()=>requestAnimationFrame(()=>{el.style.height=h})),i*15)});document.querySelectorAll('.cl-ward-bar-f').forEach(el=>{const w=el.style.width;el.style.width='0%';requestAnimationFrame(()=>requestAnimationFrame(()=>{el.style.width=w}))})});
</script>
@endpush
</x-filament-panels::page>