const { readdir: readDir, readFile, writeFile } = require('fs')
readDir('./intro/files', (err, names) => {
    let output = []
    for (const idx in names){
        const name = names[idx]
        readFile(`./intro/files/${name}`, (err, file) => {
            output[idx] = file
            if (output.filter(x => x !== undefined).length === names.length){
                writeFile('./intro/concat.txt', output.join('\n'), (err) => {
                    console.log('Vége.')
                    // CALLBACK HELL!!!
                })
            }
        })
    }
})
