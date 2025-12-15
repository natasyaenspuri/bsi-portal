#!/bin/bash

# Auto-sync script for BSI Portal
# This script watches for file changes and automatically pushes to GitHub

echo "🚀 Auto-Sync ke GitHub AKTIF"
echo "📁 Monitoring folder: $(pwd)"
echo "⏳ Menunggu perubahan file..."
echo "   (Tekan Ctrl+C untuk berhenti)"
echo ""

# Watch for changes, excluding .git, vendor, node_modules, storage/logs
fswatch -o -e "\.git" -e "vendor" -e "node_modules" -e "storage/logs" -e "storage/framework" . | while read change; do
    echo ""
    echo "📝 Perubahan terdeteksi! Menyimpan ke GitHub..."
    
    git add .
    
    # Check if there are changes to commit
    if git diff --cached --quiet; then
        echo "ℹ️  Tidak ada perubahan baru untuk di-commit."
    else
        git commit -m "Auto-sync: $(date '+%Y-%m-%d %H:%M:%S')"
        git push origin main
        echo "✅ Berhasil disimpan ke GitHub!"
    fi
    
    echo ""
    echo "⏳ Menunggu perubahan selanjutnya..."
done
