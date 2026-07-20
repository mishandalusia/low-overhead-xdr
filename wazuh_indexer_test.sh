#!/bin/bash
# Jalankan di server Wazuh (Ubuntu), lihat apakah Wazuh Indexer hidup di port 9200
# dan cek apakah data alert (dari Python/Nmap detection) benar ada di sana.

echo "=================================================="
echo "1. Cek apakah port 9200 (Wazuh Indexer) hidup"
echo "=================================================="
curl -sk "https://localhost:9200/" -w "\nHTTP_STATUS:%{http_code}\n" --connect-timeout 5

echo ""
echo "=================================================="
echo "2. Cari kredensial indexer (kalau ada file install)"
echo "=================================================="
find / -iname "wazuh-passwords.txt" 2>/dev/null
find / -iname "wazuh-install-files.tar" 2>/dev/null

echo ""
echo "=================================================="
echo "3. Kalau sudah dapat password admin indexer, jalankan manual:"
echo "curl -k -u admin:'PASSWORD_INDEXER' \"https://localhost:9200/wazuh-alerts-*/_search?size=2&pretty\""
echo "=================================================="
