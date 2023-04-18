const { readdir: readDir, readFile, writeFile } = require('fs')
readDir('./intro/files', (err, data) => {
    const output = []
    for (const idx in data){
        const name = data[idx]
        readFile(`./intro/files/${name}`, { encoding: 'utf-8' }, (err, data) => {
            output[idx] = data
            if (output.filter(x => x !== undefined).length === 4){
                writeFile('./intro/concat.txt', output.join('\n'), (err) => {
                    console.log('Vége.')
                    // CALLBACK HELL!!!
                })
            }
        })
    }
})
