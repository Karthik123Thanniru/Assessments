###ETA-16hours###
**Step1:-Create a Custom Module:**
Starting by creating a custom module. This module will contain all the necessary code for the customer import functionality.

**step2:-Define CLI Command:**
-In the module,will  define a CLI command. This command will be responsible for handling the import process. we can do this by creating the necessary files:
-etc/di.xml: Register the CLI command.
-Console/Command/CustomerImportCommand.php: Define the CLI command. This command will accept the --profile and <source> arguments.

**step3:-Profile Handling:**
-In the CustomerImportCommand.php, implement logic to handle different profiles (csv, json, etc.). Depending on the profile, you'll need to implement specific logic to handle the respective file format.

**step4:-Read Data from CSV/JSON:**
-Create functions to read data from CSV and JSON files. Magento provides CSV and JSON parsing utilities that you can utilize.
Validate and Process Data:
-After reading the data, implement validation to ensure it meets the required criteria (e.g., mandatory fields, valid email addresses). Process the data accordingly.

**step5:-Create Customer Records:**
-Using Magento's customer management functions will push the data customer records based on the imported data.

**step6:-Save Customer Data:**
-Save the customer data to the Magento database.
