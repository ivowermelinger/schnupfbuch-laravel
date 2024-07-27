import fs from 'fs';
import path from 'path';

const directoryPath = './public'; // Specify your directory path here

fs.readdir(directoryPath, (err, files) => {
    if (err) {
        return console.log('Unable to scan directory: ' + err);
    }

    // Loop through all the files in the directory
    files.forEach((file) => {
        // Check if the file starts with "workbox-"
        if (file.startsWith('workbox-')) {
            // Construct the full path of the file
            const filePath = path.join(directoryPath, file);

            fs.unlinkSync(filePath);
            console.log(`\ndeleted ${filePath}\n`);
        }
    });
});
