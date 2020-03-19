@echo off
if not exist report md report

SET ROOT=../../
SET EXCLUDE="%ROOT%controllers/admin/order/*"

:call phpmd "%ROOT%" html codesize, design, unusedcode > report/phpmd_all.html

call phpmd "%ROOT%" html "oxid_ruleset_cyclo.xml" > "report/oxidphpmd_cyclo.html"

call phpmd "%ROOT%" html "oxid_ruleset_npath.xml" > "report/oxidphpmd_npath.html"
call phpmd "%ROOT%" html "oxid_ruleset_lines.xml" > "report/oxidphpmd_lines.html"
