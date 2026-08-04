#!/bin/bash
# Jalankan script ini di server Wazuh (Ubuntu) via SSH.
# Ganti USER dan PASS di bawah sesuai kredensial Wazuh API kalian.

USER="wazuh-wui"
PASS='z*4VAEV4sFm2ZQ.5cUe7e5WL1jpdlqbQ'

echo "=================================================="
echo "1. Ambil token dari Manager API (port 55000)"
echo "=================================================="
AUTH_RESPONSE=$(curl -sk -u "$USER:$PASS" -X POST "https://localhost:55000/security/user/authenticate")
echo "RAW RESPONSE: $AUTH_RESPONSE"
TOKEN=$(echo "$AUTH_RESPONSE" | grep -o '"token":"[^"]*"' | cut -d'"' -f4)
echo "TOKEN (panjang): ${#TOKEN} karakter"
echo ""

echo "=================================================="
echo "2. Coba /security/events (yang dipakai Laravel sekarang)"
echo "=================================================="
curl -sk -H "Authorization: Bearer $TOKEN" "https://localhost:55000/security/events?limit=2" -w "\nHTTP_STATUS:%{http_code}\n"
echo ""

echo "=================================================="
echo "3. Coba /alerts"
echo "=================================================="
curl -sk -H "Authorization: Bearer $TOKEN" "https://localhost:55000/alerts?limit=2" -w "\nHTTP_STATUS:%{http_code}\n"
echo ""

echo "=================================================="
echo "4. Coba /security/alerts"
echo "=================================================="
curl -sk -H "Authorization: Bearer $TOKEN" "https://localhost:55000/security/alerts?limit=2" -w "\nHTTP_STATUS:%{http_code}\n"
echo ""

echo "=================================================="
echo "5. Lihat versi & info dasar Manager API (buat tau versi Wazuh)"
echo "=================================================="
curl -sk -H "Authorization: Bearer $TOKEN" "https://localhost:55000/manager/info" -w "\nHTTP_STATUS:%{http_code}\n"
echo ""

echo "=================================================="
echo "6. Cek apakah Wazuh Indexer (OpenSearch) hidup di port 9200"
echo "=================================================="
curl -sk "https://localhost:9200/" -w "\nHTTP_STATUS:%{http_code}\n" --connect-timeout 5
echo ""
echo "(Kalau step 6 keluar HTTP_STATUS 401, itu BAGUS - artinya Indexer hidup,"
echo " cuma butuh kredensial indexer terpisah buat lanjut ke pengecekan alert.)"
