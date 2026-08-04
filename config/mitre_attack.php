<?php

return [
    // Keyed by Wazuh rule ID — checked first.
    'by_rule_id' => [
        '100200' => [
            'technique_id' => 'T1046',
            'technique_name' => 'Network Service Scanning',
            'tactic' => 'Discovery',
        ],
        '100500' => [
            'technique_id' => 'T1078',
            'technique_name' => 'Valid Accounts',
            'tactic' => 'Initial Access',
        ],
    ],

    // Fallback by alert category (rule.groups[0]) when the rule ID has no explicit mapping above.
    'by_category' => [
        'Reconnaissance' => [
            'technique_id' => 'T1046',
            'technique_name' => 'Network Service Scanning',
            'tactic' => 'Discovery',
        ],
        'Behaviour Anomaly' => [
            'technique_id' => 'T1078',
            'technique_name' => 'Valid Accounts',
            'tactic' => 'Initial Access',
        ],
        'Authentication Attack' => [
            'technique_id' => 'T1110',
            'technique_name' => 'Brute Force',
            'tactic' => 'Credential Access',
        ],
        'Malware' => [
            'technique_id' => 'T1071',
            'technique_name' => 'Application Layer Protocol',
            'tactic' => 'Command and Control',
        ],
        'Web Attack' => [
            'technique_id' => 'T1190',
            'technique_name' => 'Exploit Public-Facing Application',
            'tactic' => 'Initial Access',
        ],
    ],
];
