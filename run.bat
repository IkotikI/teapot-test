@echo off
chcp 65001
for /f "tokens=3" %%a in ('sc query "MySQL80" ^| find "STATE"') do set state=%%a
if %state%=="" for /f "tokens=3" %%a in ('sc query "MySQL80" ^| find "Состояние"') do set state=%%a

if %state%==1 goto runMySQL

if %state%==4 goto runservers

echo "query state %state%"
pause


sc query "MySQL80" | findstr /i "STATE"
sc query MySQL80 | FIND "STATE" | find "Состояние"
sc query MySQL80 | find "Состояние"
echo "Ищем state или состояние"
pause

:runMySQL
sc start MySQL80
echo "ERRORLEVEL is %ERRORLEVEL%"
if %ERRORLEVEL% == 0 goto runservers
if %ERRORLEVEL% == 1056 goto runservers
if %ERRORLEVEL% == 5 ( 
	echo "Need to run MySQL Service. Please, restart run.bat as administrator."
	pause
	exit
) ELSE (
	echo "Starting MySQL service error: %ERRORLEVEL%"
	pause
)

:runservers
echo "Running servers..."
pushd "C:\Development\Web\Setup\phpmyadmin\current\phpMyAdmin-5.2.1-all-languages"
start cmd.exe /k "php -S localhost:8080"
pushd "%~dp0"
start cmd.exe /k "php -S localhost:4000"
popd