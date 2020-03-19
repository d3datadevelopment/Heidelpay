# Generic test folder 

### Usage:

* Copy the folder "tests" directly into your module directory, for example: **"eshop/modules/oxps/mymodule/"**
* Add new tests by adding files to **"tests/unit/module"** folder
* To run all the tests just run the script **"tests/runtests.sh"**
* To run a particular test class, just run the same script but add a path to the file: **EXAMPLE:** ./runtests.sh ./unit/module/somefileTest.php
* To run code coverage run the "runcoverage.sh" script. **IMPORTANT:** Activate the module in the ADMIN before running the coverage.
* If needs exclude some directorys or files, for that needs edit phpunit.xml file. 
For example if needs remove directory with content named testFiles needs in bracket add new line like: 
	
	< whitelist addUncoveredFilesFromWhitelist="true">	 
    < directory suffix=".php">../</directory>
	< exclude>
		....
		< directory suffix=".php">../testFiles/</directory>
		....
	< /exclude>
		
* If module does not have vendor directory and is stored modules/moduleName, then needs edit phpunit.xml file and change path where can be found all shop original files and directorys:
	List for module with vendor directory:
	< blacklist>
        < directory suffix=".php">../../../../</directory>
    < /blacklist>
	
	List for module without vendor directory:
	
	< blacklist>
        < directory suffix=".php">../../../</directory>
    </ blacklist>
	
* To run metrics first needs install pDepend(PHP depend - tool for metrics generation, default which was in PHPUNIT 3.4.* was removed in newest versions). how to do it is wrote there http://pdepend.org/download/index.html.
* To run metrics is just enough execute file ./runmetrics.sh with root user right(required for writing)