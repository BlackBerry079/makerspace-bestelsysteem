@echo off
echo.
echo ========================================
echo Installing Node.js...
echo ========================================
echo.

winget install OpenJS.NodeJS

echo.
echo ========================================
echo Verifying installation...
echo ========================================
echo.

node --version
npm --version

echo.
echo Node.js and npm are ready!
echo.
pause
