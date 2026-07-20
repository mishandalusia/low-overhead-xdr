import { PieChart, Pie, Cell, ResponsiveContainer, Tooltip } from 'recharts';

const SEVERITY_COLORS = {
    Critical: '#dc2626',
    High: '#ea580c',
    Medium: '#d97706',
    Low: '#059669',
};

const PANEL_STYLE = {
    background: 'radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 34%), radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.10), transparent 35%), rgba(255, 255, 255, 0.92)',
    borderColor: 'rgba(168, 85, 247, 0.18)',
    boxShadow: '0 24px 55px rgba(168, 85, 247, 0.13)',
};

export default function SeverityChart({ severity, topThreats }) {
    const pieData = [
        { name: 'Critical', value: severity?.critical ?? 0 },
        { name: 'High', value: severity?.high ?? 0 },
        { name: 'Medium', value: severity?.medium ?? 0 },
        { name: 'Low', value: severity?.low ?? 0 },
    ];

    const total = pieData.reduce((sum, item) => sum + item.value, 0);
    const threats = topThreats ?? [];
    const maxCount = Math.max(1, ...threats.map((t) => t.count));

    return (
        <div className="grid w-full min-w-0 grid-cols-1 gap-5 lg:grid-cols-2">
            <div className="relative min-w-0 rounded-3xl border px-8 py-7" style={PANEL_STYLE}>
                <h3 className="text-lg font-black tracking-tight text-slate-900 after:mt-2.5 after:block after:h-1 after:w-[50px] after:rounded-full after:bg-gradient-to-r after:from-[#8b5cf6] after:to-[#ec4899] after:content-['']">Threat Severity Distribution</h3>
                <p className="mt-1 text-sm font-semibold text-slate-500">Threat distribution based on severity level.</p>

                <div className="mt-5 flex items-center gap-6">
                    <div className="flex h-40 w-40 shrink-0 items-center justify-center">
                        {total > 0 ? (
                            <ResponsiveContainer width="100%" height="100%">
                                <PieChart>
                                    <Pie
                                        data={pieData}
                                        dataKey="value"
                                        nameKey="name"
                                        innerRadius={48}
                                        outerRadius={72}
                                        paddingAngle={2}
                                        strokeWidth={0}
                                    >
                                        {pieData.map((entry) => (
                                            <Cell key={entry.name} fill={SEVERITY_COLORS[entry.name]} />
                                        ))}
                                    </Pie>
                                    <Tooltip />
                                </PieChart>
                            </ResponsiveContainer>
                        ) : (
                            <div className="flex h-32 w-32 items-center justify-center rounded-full border-4 border-dashed border-purple-200 text-center text-xs font-bold text-slate-400">
                                No data yet
                            </div>
                        )}
                    </div>

                    <div className="flex-1 space-y-2">
                        {pieData.map((item) => (
                            <div key={item.name} className="flex items-center justify-between text-sm">
                                <span className="flex items-center gap-2 font-semibold text-slate-600">
                                    <span
                                        className="h-2.5 w-2.5 rounded-full"
                                        style={{ backgroundColor: SEVERITY_COLORS[item.name] }}
                                    />
                                    {item.name}
                                </span>
                                <span className="font-black text-slate-900">{item.value}</span>
                            </div>
                        ))}
                        <div className="mt-3 border-t border-purple-100 pt-2 text-sm font-bold text-slate-500">
                            Total: {total}
                        </div>
                    </div>
                </div>
            </div>

            <div className="relative min-w-0 rounded-3xl border px-8 py-7" style={PANEL_STYLE}>
                <h3 className="text-lg font-black tracking-tight text-slate-900 after:mt-2.5 after:block after:h-1 after:w-[50px] after:rounded-full after:bg-gradient-to-r after:from-[#8b5cf6] after:to-[#ec4899] after:content-['']">Top Threat Types</h3>
                <p className="mt-1 text-sm font-semibold text-slate-500">Most detected threat categories from monitored endpoints.</p>

                <div className="mt-5 space-y-4">
                    {threats.length === 0 && (
                        <p className="text-sm font-semibold text-slate-400">No threat data available yet.</p>
                    )}

                    {threats.map((threat) => (
                        <div key={threat.name}>
                            <div className="flex items-center justify-between text-sm">
                                <span className="font-bold text-slate-700">{threat.name}</span>
                                <span className="font-semibold text-slate-500">{threat.percentage}%</span>
                            </div>
                            <div className="mt-1.5 h-2.5 w-full overflow-hidden rounded-full bg-purple-50">
                                <div
                                    className="h-full rounded-full"
                                    style={{
                                        width: `${Math.max(4, (threat.count / maxCount) * 100)}%`,
                                        background: 'linear-gradient(90deg, #8b5cf6, #d946ef)',
                                    }}
                                />
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
}
