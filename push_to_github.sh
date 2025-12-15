#!/bin/bash
echo "Menyimpan perubahan ke GitHub..."
git add .
git commit -m "Auto update: $(date)"
git push origin main
echo "Selesai! Perubahan telah tersimpan."
