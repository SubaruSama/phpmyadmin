I`ve update the files in src/Plugins/ExportPlugin.php and src/Plugins/Export/*.php minus ExportExcel.php

In the page to export the table, it loads, but when I select some format (excluding Excel), it crashes on the following route:

POST /public/index.php?route=/export