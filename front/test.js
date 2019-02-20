const express = require('express')
const app = express()
const port = 4000;
var phantom = require('phantom');
const HTML5ToPDF = require("lib");
const path = require("path")
app.get('/', (request, response) => {

    const run = async () => {
        const html5ToPDF = new HTML5ToPDF({
            inputPath: path.join(__dirname, "assets", "basic.html"),
            outputPath: path.join(__dirname, "..", "tmp", "output.pdf"),
            templatePath: path.join(__dirname, "templates", "basic"),
            include: [
                // path.join(__dirname, "assets", "basic.css"),
                // path.join(__dirname, "assets", "custom-margin.css"),
            ],
        })
// debugger
        console.log(html5ToPDF.start());
        await html5ToPDF.start();
        console.log(21);
        await html5ToPDF.build();
        console.log(31);
        await html5ToPDF.close();
        console.log("DONE");
        process.exit(0)
    }


// Use the function in an existing promise chain
//     Promise.resolve( 'something' )
//         .then( result => {
//             return result;
//         } )
//         .then( result => {
//             // Because async functions are promises under the hood we can treat the run function as a promise
//             return run()
//         } )
//         .catch(err => console.log(err))

// Usage in try/catch block
//     try {
//         run()
//     } catch (error) {
//         console.error(error)
//     }

});
app.listen(port, (err) => {
    if (err) {
        return console.log('something bad happened', err)
    }
    console.log(`server is listening on ${port}`)
});
