# Low-Overhead XDR (Extended Detection and Response)

Low-Overhead XDR is a cross-layer security monitoring system designed to provide real-time threat detection, behavioral anomaly analysis, and automated response with minimal system overhead.

The system integrates host monitoring, network analysis, and application log correlation to detect both signature-based and behavior-based cyber threats.

## 🚀 Project Objective

To deliver a lightweight XDR system that provides:
- Cross-layer visibility (host, network, application)
- Behavioral anomaly detection
- Automated incident response
without degrading endpoint performance.


## 🏗️ System Architecture

This project is built using a distributed multi-device architecture:

- **Wazuh Server (Ubuntu)**
  - Wazuh Manager
  - Wazuh Indexer
  - Wazuh Dashboard
  - Python Detection Service

- **Target Server (Ubuntu)**
  - Wazuh Agent
  - Osquery
  - Apache2 (or application services)

- **Attacker Machine (Kali Linux)**
  - Nmap
  - Hydra
  - SQLMap
  - Nikto

- **Web Dashboard**
  - Authentication system
  - Security monitoring UI
  - Analytics & reporting system


## 🧠 Core Features

### 🔐 Authentication Module
- Secure login/logout
- Session management
- Role-based access control

### 📊 Dashboard Overview
- Total events
- Active alerts
- Blocked IPs
- Open incidents
- Threat severity distribution

### 🖥️ Agent Monitoring
- Agent status tracking
- Connected devices overview
- Last seen activity
- Agent health monitoring

### 📡 Event Monitoring
- Host, network, and application logs
- Real-time event filtering and search

### 🚨 Alert & Threat Management
- Alert classification by severity
- Threat detection history
- Anomaly scoring

### ⚙️ Incident & Response
- Incident tracking lifecycle
- Automated IP blocking
- Response history logs

### 📈 Analytics & Reporting
- Attack trends visualization
- Severity distribution
- Security reports export (PDF)


## 🛡️ Security Capabilities

- Cross-layer correlation (host + network + application)
- Behavioral anomaly detection (Python + ML)
- Automated remediation playbooks
- MITRE ATT&CK mapping (planned/optional)
- eBPF-based packet filtering (advanced feature)


## 👥 Team Roles

- Project Lead & ML Engineer: anomaly detection, scoring model
- Frontend Developer: dashboard UI/UX
- Security Engineer: Wazuh configuration & detection rules
- Backend Engineer: data pipeline & API integration
- DevOps & QA: deployment, Osquery, automation


## 📦 Tech Stack

- Wazuh (SIEM/XDR Engine)
- Osquery (Host Monitoring)
- Python (Scikit-learn anomaly detection)
- Laravel / Web Dashboard
- Ubuntu Server
- Kali Linux (penetration testing)


## ⚙️ Installation (Basic Flow)

1. Install Wazuh Manager (Server)
2. Deploy Wazuh Agent (Target Machine)
3. Connect agent to manager
4. Install Osquery on endpoint
5. Run Python detection microservice
6. Connect dashboard to Wazuh API


## 📊 Backlog Overview

- Environment Setup (Wazuh + Agents)
- Log Collection & Normalization
- Cross-layer Correlation Engine
- Threat Detection Rules
- Dashboard Development
- Automated Response System


## 📁 Project Reference

Based on system design documentation:
- Multi-device architecture (Ubuntu + Kali + Web Dashboard)
- Distributed security monitoring system :contentReference[oaicite:0]{index=0}

## 📌 Future Improvements

- Real-time streaming alerts (WebSocket)
- AI-based threat prediction
- eBPF kernel-level blocking
- Cloud deployment (Docker/Kubernetes)


## 📜 License

For educational and research purposes.
