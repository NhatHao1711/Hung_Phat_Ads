@echo off
chcp 65001 >nul
title KHOI DONG TEN MIEN TAM THOI (CLOUDFLARE TUNNEL) - HUNG PHAT ADS
echo =========================================================================
echo    HUNG PHAT ADS - CAP TEN MIEN TAM THOI (HO TRO CA TRANG ADMIN)
echo =========================================================================
echo Dang ket noi mang Cloudflare...
echo Hay tim dong co link dang: https://xxxxxx.trycloudflare.com
echo Va truy cap:
echo  - Trang chu: https://xxxxxx.trycloudflare.com/Hung_Phat_Ads/
echo  - Trang Admin: https://xxxxxx.trycloudflare.com/Hung_Phat_Ads/wp-admin/
echo =========================================================================
echo.
"%USERPROFILE%\cloudflared.exe" tunnel --url http://localhost:80
pause
