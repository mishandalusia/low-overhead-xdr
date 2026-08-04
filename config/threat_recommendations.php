<?php

return [
    'default' => [
        'Review the alert details and validate whether the activity is legitimate.',
        'Monitor the source and agent for further suspicious activity.',
    ],

    'Reconnaissance' => [
        'Block attacker IP',
        'Review firewall log',
        'Monitor suspicious activity',
    ],

    'Behaviour Anomaly' => [
        'Investigate user activity',
        'Review transaction logs',
        'Escalate if pattern repeats',
    ],

    'Authentication Attack' => [
        'Lock or reset the affected account',
        'Block the source IP after repeated failures',
        'Enable/verify multi-factor authentication',
    ],

    'Malware' => [
        'Isolate the affected endpoint from the network',
        'Run a full antivirus/EDR scan on the agent',
        'Block outbound communication to the suspicious destination',
    ],

    'Web Attack' => [
        'Review application/web server logs',
        'Patch or strengthen input validation on the affected endpoint',
        'Block the source IP if the attempt is confirmed malicious',
    ],
];
