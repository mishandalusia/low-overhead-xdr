import { ShieldAlert, Siren, Ban, CheckCircle2 } from 'lucide-react';

const CARDS = [
    {
        key: 'totalThreats',
        label: 'Total Threats',
        hint: 'Detected threat-level alerts',
        icon: ShieldAlert,
        bg: 'radial-gradient(circle at top right, rgba(139, 92, 246, 0.25), transparent 36%), linear-gradient(135deg, #ffffff, #f3e8ff)',
        iconColor: '#7c3aed',
    },
    {
        key: 'activeAlerts',
        label: 'Active Alerts',
        hint: 'Alerts need attention',
        icon: Siren,
        bg: 'radial-gradient(circle at top right, rgba(236, 72, 153, 0.22), transparent 36%), linear-gradient(135deg, #ffffff, #fce7f3)',
        iconColor: '#db2777',
    },
    {
        key: 'activeBlocks',
        label: 'Active Blocks',
        hint: 'IPs currently blocked by Wazuh',
        icon: Ban,
        bg: 'radial-gradient(circle at top right, rgba(251, 146, 60, 0.25), transparent 36%), linear-gradient(135deg, #ffffff, #fef3c7)',
        iconColor: '#dc2626',
    },
    {
        key: 'resolvedIncidents',
        label: 'Resolved Incidents',
        hint: 'Auto-remediated by Wazuh',
        icon: CheckCircle2,
        bg: 'radial-gradient(circle at top right, rgba(59, 130, 246, 0.22), transparent 36%), linear-gradient(135deg, #ffffff, #dbeafe)',
        iconColor: '#2563eb',
    },
];

export default function StatCards({ summary }) {
    return (
        <div className="grid w-full min-w-0 grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
            {CARDS.map(({ key, label, hint, icon: Icon, bg, iconColor }) => (
                <div
                    key={key}
                    className="relative flex min-h-[128px] min-w-0 items-center gap-5 rounded-[26px] border px-8 py-7"
                    style={{
                        background: bg,
                        borderColor: 'rgba(168, 85, 247, 0.18)',
                        boxShadow: '0 18px 42px rgba(168, 85, 247, 0.10)',
                    }}
                >
                    <div className="pointer-events-none absolute inset-0 overflow-hidden rounded-[26px]">
                        <div
                            className="absolute -right-11 -top-12 h-[135px] w-[135px] rounded-full"
                            style={{ background: 'rgba(168, 85, 247, 0.18)' }}
                        />
                        <div
                            className="absolute -bottom-11 right-7 h-[95px] w-[95px] rounded-full"
                            style={{ background: 'rgba(236, 72, 153, 0.15)' }}
                        />
                    </div>

                    <div
                        className="relative z-10 flex h-[52px] w-[52px] shrink-0 items-center justify-center rounded-2xl border bg-white shadow-md"
                        style={{ borderColor: 'rgba(168, 85, 247, 0.18)', color: iconColor }}
                    >
                        <Icon size={22} strokeWidth={2.25} />
                    </div>

                    <div className="relative z-10 min-w-0">
                        <span className="block text-[13px] font-black text-slate-500">{label}</span>
                        <p className="mt-[7px] text-[32px] font-black leading-none text-slate-900">
                            {Number(summary?.[key] ?? 0).toLocaleString()}
                        </p>
                        <p className="mt-1 text-[13px] font-semibold text-slate-500">{hint}</p>
                    </div>
                </div>
            ))}
        </div>
    );
}
