const { readdir: readDir, readFile, writeFile, readdir } = require('fs')

readDir('./intro/files', (err, names) => {
    let output = []
    for (const idx in names){
        const name = names[idx]
        readFile(`./intro/files/${name}`, { encoding: 'utf-8'}, (err, file) => {
            output[idx] = file
            if (output.filter(x => x !== undefined).length === names.length){
                writeFile('./intro/concat.txt', output.join('\n'), () => {
                    console.log('Vége.')
                    // CALLBACK HELL!!!
                })
            }
        })
    }
})
