@echo off
rem START or STOP Services
rem ----------------------------------
rem Check if argument is STOP or START

if not ""%1"" == ""START"" goto stop

if exist D:\php\hypersonic\scripts\ctl.bat (start /MIN /B D:\php\server\hsql-sample-database\scripts\ctl.bat START)
if exist D:\php\ingres\scripts\ctl.bat (start /MIN /B D:\php\ingres\scripts\ctl.bat START)
if exist D:\php\mysql\scripts\ctl.bat (start /MIN /B D:\php\mysql\scripts\ctl.bat START)
if exist D:\php\postgresql\scripts\ctl.bat (start /MIN /B D:\php\postgresql\scripts\ctl.bat START)
if exist D:\php\apache\scripts\ctl.bat (start /MIN /B D:\php\apache\scripts\ctl.bat START)
if exist D:\php\openoffice\scripts\ctl.bat (start /MIN /B D:\php\openoffice\scripts\ctl.bat START)
if exist D:\php\apache-tomcat\scripts\ctl.bat (start /MIN /B D:\php\apache-tomcat\scripts\ctl.bat START)
if exist D:\php\resin\scripts\ctl.bat (start /MIN /B D:\php\resin\scripts\ctl.bat START)
if exist D:\php\jetty\scripts\ctl.bat (start /MIN /B D:\php\jetty\scripts\ctl.bat START)
if exist D:\php\subversion\scripts\ctl.bat (start /MIN /B D:\php\subversion\scripts\ctl.bat START)
rem RUBY_APPLICATION_START
if exist D:\php\lucene\scripts\ctl.bat (start /MIN /B D:\php\lucene\scripts\ctl.bat START)
if exist D:\php\third_application\scripts\ctl.bat (start /MIN /B D:\php\third_application\scripts\ctl.bat START)
goto end

:stop
echo "Stopping services ..."
if exist D:\php\third_application\scripts\ctl.bat (start /MIN /B D:\php\third_application\scripts\ctl.bat STOP)
if exist D:\php\lucene\scripts\ctl.bat (start /MIN /B D:\php\lucene\scripts\ctl.bat STOP)
rem RUBY_APPLICATION_STOP
if exist D:\php\subversion\scripts\ctl.bat (start /MIN /B D:\php\subversion\scripts\ctl.bat STOP)
if exist D:\php\jetty\scripts\ctl.bat (start /MIN /B D:\php\jetty\scripts\ctl.bat STOP)
if exist D:\php\hypersonic\scripts\ctl.bat (start /MIN /B D:\php\server\hsql-sample-database\scripts\ctl.bat STOP)
if exist D:\php\resin\scripts\ctl.bat (start /MIN /B D:\php\resin\scripts\ctl.bat STOP)
if exist D:\php\apache-tomcat\scripts\ctl.bat (start /MIN /B /WAIT D:\php\apache-tomcat\scripts\ctl.bat STOP)
if exist D:\php\openoffice\scripts\ctl.bat (start /MIN /B D:\php\openoffice\scripts\ctl.bat STOP)
if exist D:\php\apache\scripts\ctl.bat (start /MIN /B D:\php\apache\scripts\ctl.bat STOP)
if exist D:\php\ingres\scripts\ctl.bat (start /MIN /B D:\php\ingres\scripts\ctl.bat STOP)
if exist D:\php\mysql\scripts\ctl.bat (start /MIN /B D:\php\mysql\scripts\ctl.bat STOP)
if exist D:\php\postgresql\scripts\ctl.bat (start /MIN /B D:\php\postgresql\scripts\ctl.bat STOP)

:end

